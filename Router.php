<?php 
namespace MVC;
class Router 
{
    public array $rutasGET = [];
    public array $rutasPOST = [];

    public function __construct() 
    { 
        
    }
    public function get( $url, $fn ) 
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post( $url, $fn ) 
    {
        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas() 
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas
        $rutas_protegidas = [
            '/admin', 
            '/propiedad/crear', 
            '/propiedad/actualizar', 
            '/propiedad/eliminar',
            '/vendedor/crear',
            '/vendedor/actualizar',
            '/vendedor/eliminar',
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        } else {
            if (($urlActual == "/login") && $auth) {
                header('Location: /');
            }
        }

        if($fn) {
            call_user_func($fn, $this);
        } else {
            header('Location: /404');
        }
    }
    public function render( string $view, array $data = [] ) 
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/{$view}.php";
        $contenido = ob_get_clean();
        include __DIR__ . '/views/layout.php';
    }
}