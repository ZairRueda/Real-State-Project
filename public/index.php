<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\BlogController;
use Controllers\LoginController;


// Cramos una intancia para poder extraer sus propiedades 
// En este caso GET function
$router = new Router();

// PropiedadController::class : nos servira para saver en que parte se encuentra el codigo, o en donde buscara el metodo
// Este es el codigo que manda al controlador los datos, le dice cual sera el archivo que revisara 
// e instanciara la direccion
$router->get('/admin', [PropiedadController::class, 'index']);

// Zona Privada
// Propiedad

$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);

$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

// Vendedor

$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);

$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);

$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

// Blog 

$router->get('/blogs/crear', [BlogController::class, 'crear']);
$router->post('/blogs/crear', [BlogController::class, 'crear']);

$router->get('/blogs/actualizar', [BlogController::class, 'actualizar']);
$router->post('/blogs/actualizar', [BlogController::class, 'actualizar']);

$router->post('/blogs/eliminar', [BlogController::class, 'eliminar']);


// Zona Publica

$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

// Login y autenticacion || Iniciar Sesion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);

// Crear Sesion
$router->get('/create', [LoginController::class, 'create']);
$router->post('/create', [LoginController::class, 'create']);

// Cerrar Sesion
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();