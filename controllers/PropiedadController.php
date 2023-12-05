<?php 
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController 
{
    public static function index( Router $router ) 
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        
        $result = $_GET['result'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'result' => $result
        ]);
    }
    public static function crear( Router $router ) 
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Arreglo de errores
        $errores = Propiedad::getErrores();

        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una nueva Instancia
            $propiedad = new Propiedad($_POST['propiedad']);
            // Generar nombre unico
            $nombreImagen = md5( uniqid( rand(), true )) . '.jpg';
            // Realiza un resize a la imagen con Intervention
            if($_FILES['propiedad']['tmp_name']['imagen']) {
            
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit( 800, 600 );
                $propiedad->setImage($nombreImagen);
            }

        // Validar
        $errores = $propiedad->validar();

        if( empty($errores) ) {
            // Crear Carpeta
            if( is_dir(CARPETA_IMAGES)) {
                mkdir(CARPETA_IMAGES);
            }
            // Guardar la imagen en el servidor
            $image->save( CARPETA_IMAGES . $nombreImagen);
            // Guardar en la Base de Datos
            $propiedad->guardar();
        }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores'  => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router) 
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            $errores = $propiedad->validar();
    
            $nombreImagen = md5( uniqid( rand(), true )) . '.jpg';
    
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit( 800, 600 );
                $propiedad->setImage($nombreImagen);
            }
    
            if( empty($errores) ) {
                // Almacenar Imagen
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGES . $nombreImagen);
                }
                // Insertar en la base de datos
                $propiedad->guardar();
            }
        }
        
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores,
        ]);
    }
    public static function eliminar() 
    {
        if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $id = $_POST['id'];
            $id = filter_var( $id, FILTER_VALIDATE_INT);
    
            if($id) {
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}