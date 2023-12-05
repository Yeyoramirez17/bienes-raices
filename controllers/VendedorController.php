<?php 
namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController 
{
    public static function crear( Router $router )
    {
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor = new Vendedor($_POST['vendedor']);
            $errores = $vendedor->validar();
    
            if(empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor,
        ]);
    }
    public static function actualizar( Router $router )
    {
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');

        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['vendedor'];
            // Sincronizar el objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);
            // Validar
            $vendedor->validar();
            if(empty($errores)) {
                $vendedor->guardar();
            }
    
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor,
        ]);
    }
    public static function eliminar()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}