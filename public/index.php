<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router();

$router->get('/', [ PaginasController::class, 'index' ]);
$router->get('/404', [ PaginasController::class, 'notFound'] );

$router->get('/admin', [ PropiedadController::class, 'index' ]);
$router->get('/propiedad/crear', [ PropiedadController::class, 'crear' ]);
$router->post('/propiedad/crear', [ PropiedadController::class, 'crear' ]);
$router->get('/propiedad/actualizar', [ PropiedadController::class, 'actualizar' ]);
$router->post('/propiedad/actualizar', [ PropiedadController::class, 'actualizar' ]);
$router->post('/propiedad/eliminar', [ PropiedadController::class, 'eliminar' ]);
// Vendedores
$router->get('/vendedor/crear', [VendedorController::class, 'crear']);
$router->post('/vendedor/crear', [VendedorController::class, 'crear']);
$router->get('/vendedor/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedor/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedor/eliminar', [VendedorController::class, 'eliminar']);
// Paginas
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);
// Login y Autenticación
$router->get('/login', [ LoginController::class, 'login']);
$router->post('/login', [ LoginController::class, 'login']);
$router->get('/logout', [ LoginController::class, 'logout']);

$router->comprobarRutas();