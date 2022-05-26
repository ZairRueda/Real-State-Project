<?php 

namespace Controllers;
use MVC\Router;
use Model\Blog;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController {
    // == Blogs ==

    public static function crear(Router $router)
    {

        $blog = new Blog();
        $vendedores = Vendedor::all();
        $errores = Blog::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {

            $blog = new Blog($_POST['blog']);

            // debuguear($_FILES);

            // === SUBIR IMAGENES ===


            // Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['blog']['tmp_name']['imagen']) {

                $image = Image::make($_FILES['blog']['tmp_name']['imagen']); // <- Crea o abre el archivo

                // Reasignacion de tamaño
                $image->fit(800, 600);

                $blog->setImagen($nombreImagen);
            }

            $errores = $blog->validar();

            if (empty($errores)) {

                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                };

                if ($_FILES['blog']['tmp_name']['imagen']) {
                    // Metodo SAVE(); guarda en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                

                $blog->guardar();
            }
        }

        $router->render('blogs/crear', [
            'blog' => $blog,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarORedireccionar('/admin');
        // $id = 2;

        $blog = Blog::find($id);
        $vendedores = Vendedor::all();
        $errores = Blog::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {

            $args = $_POST['blog'];

            $blog->sincronizar($args);

            $errores = $blog->validar();

            // Genera nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Validacion subida de archivos
            if ($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen']);
                $image->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                // Almacenar la imagen 
                if ($_FILES['blog']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $blog->guardar();
            }
        }

        $router->render('blogs/actualizar', [
            'blog' => $blog,
            'errores' => $errores,
            'vendedores' => $vendedores
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

                    $blog = Blog::find($id);
                    $blog->eliminar();
                }
            }
        }
    }
}