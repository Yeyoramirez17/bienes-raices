<?php 
namespace Model;

class ActiveRecord {
    protected static $conexion;
    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $errores = [];
    public function crear() 
    {
        $atributos = $this->sanitizarAtributos();
        
        $query = "INSERT INTO ". static::$tabla ." ( ";
        $query .=  join(", ", array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ');";

        $resultado = self::$conexion->query($query);
        
        if( $resultado ) {
            // Redireccionar
            header('Location: /admin?result=1');
        }
    }
    public function actualizar() 
    {
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE ". static::$tabla ." SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$conexion->escape_string($this->id) ."' ";
        $query .= " LIMIT 1 ";
        
        $resultado = self::$conexion->query($query);

        if( $resultado ) {
            // Redireccionar
            header('Location: /admin?result=2');
        }
    }
    public function guardar()
    {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }
    public function eliminar() 
    {
        $query = "DELETE FROM ". static::$tabla ." WHERE id = " . self::$conexion->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$conexion->query($query);
        
        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?result=3');
        }
    }
    // Definir la conexion a la DB
    public static function setDB( \mysqli $database ) {
        self::$conexion = $database;
    }
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if( $columna === 'id' ) continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitazado = [];

        foreach( $atributos as $key => $value ) {
            $sanitazado[$key] = self::$conexion->escape_string($value);
        }
        return $sanitazado;
    }
    // Validación
    public static function getErrores() {
        return static::$errores;
    }
    public function validar() {
        static::$errores = [];
        return static::$errores;
    }
    // Subida de archivos
    public function setImage( $imagen ) 
    {
        // Eliminar imagen previa
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        // Asignar al atributoo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }
    public function borrarImagen() 
    {
        $existeArchivo = file_exists(CARPETA_IMAGES . $this->imagen);
        
        if($existeArchivo) {
            unlink(CARPETA_IMAGES . $this->imagen);
        }
    }
    // Listar todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;

    }
    public static function get( $cantidad ) 
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // Buscar un registro por su ID
    public static function find( $id )
    {
        $query = "SELECT * FROM ". static::$tabla ." WHERE id = {$id};";
        $resultado = self::consultarSQL( $query );
        return array_shift($resultado);
    }
    public static function consultarSQL( $query )
    {
        // Consulta la base de datos
        $resultado = self::$conexion->query($query);
        // Iterar los resultados
        $array = [];
        while( $registro = $resultado->fetch_assoc() ) {
            $array[] = static::crearObjeto( $registro );
        }
        // Liberar la memoria
        $resultado->free();
        // Retornar los resultados
        return $array;
    }
    protected static function crearObjeto( $registro ) 
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if ( property_exists($objeto, $key) ) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( array $data )
    {
        foreach ($data as $key => $value) {
            if (property_exists( $this, $key) && !is_null($value) ) {
                $this->$key  = $value;
            }
        }
    }
}