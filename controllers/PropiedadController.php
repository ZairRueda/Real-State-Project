<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    // Recordatorio static nos sirve para no tener que intanciar el codigo
    // Se intancia dentro de loq ue recibe la funcion
    public static function index(Router $router)
    {
        // SI iteramos de esta manera se pierden las propiedades de Router Class, por que las instancias cambian y se amoldan a los datos que le pasamos, se usan mas en lo que viene siendo un constructor
        // $router = new Router();

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $blogs = Blog::all();
        $resultado = $_GET['resultado'] ?? null;

        // debuguear($router);
        // render: 
        $router->render('propiedades/admin', [
            // Agregacion de datos hacia la vista
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores,
            'blogs' => $blogs
        ]);
    }

    // == Propiedades ==

    public static function crear(Router $router)
    {
        // Para revisar que este redireccionando correctamente
        // echo 'Crear Propiedad';

        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        // $resultado = null;

        // Para poder crear una propiedad nos traemos el metodo usado en el proyecto de POO
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // debuguear($_POST);

            // === Crea una nueva instancia ===
            $propiedad = new Propiedad($_POST['propiedad']);



            // === SUBIR IMAGENES ===


            // Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {

                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen']); // <- Crea o abre el archivo

                // Reasignacion de tamaño
                $image->fit(800, 600);

                $propiedad->setImagen($nombreImagen);
            }

            // == Validacion ==
            $errores = $propiedad->validar();

            if (empty($errores)) {

                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                };

                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Metodo SAVE(); guarda en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }


                // Guarda en la base de datos
                $propiedad->guardar();

                // debuguear($propiedad);
            }
        };

        // iteracion para el archivo crear
        $router->render('propiedades/crear', [

            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            // 'resultado' => $resultado,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        // echo 'Actualizar Propiedad';
        // verifica que contenga un id y que exista
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        // $resultado = null;

        // Para poder crear una propiedad nos traemos el metodo usado en el proyecto de POO
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {

            // Asignar los atributos
            $args = $_POST['propiedad'];

            // Lo que haremos es tomar unarreglo  y comprararlo con el objeto de la BDD 
            // Y los datos que han cambiado sean modificados
            $propiedad->sincronizar($args);

            // debuguear($propiedad);

            $errores = $propiedad->validar();

            // Genera nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Validacion subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen']);
                $image->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                // Almacenar la imagen 
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                // Para que el elemento tipo no pueda ser modificado 
                if (validarTipoContenido($tipo)) {
                    // debuguear('Es valido');

                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }

    
}
