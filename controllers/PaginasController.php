<?php 

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;

use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use MVC\Router;

class PaginasController {
    public static function index( Router $router ) {
        
        $propiedades = Propiedad::get(3);
        $blogs = Blog::get(2);
        $vendedores = Vendedor::get(2);
        $h1 = true;
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'h1' => $h1,
            'inicio' => $inicio,
            'blogs' => $blogs,
            'vendedores' => $vendedores
        ]);

    }
    public static function nosotros( Router $router ) {
        

        $router->render('paginas/nosotros', [

        ]);

    }
    public static function propiedades( Router $router ) {
        
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);

    }
    public static function propiedad( Router $router ) {
        
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);
        $vendedor = Vendedor::find($propiedad->vendedorId);
        ;

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad,
            'vendedor' => $vendedor
        ]);

    }
    public static function blog( Router $router ) {

        $blogs = Blog::all();
        
        
        $router->render('paginas/blog', [
                'blogs' => $blogs
        ]);

    }
    public static function entrada( Router $router ) {

        $id = validarORedireccionar('/blog');
        $blog = $blogs = Blog::find($id);
        $vendedor = Vendedor::find($blog->vendedor);
        ;
        
        $router->render('paginas/entrada', [
            'blog' => $blog,
            'vendedor' => $vendedor
        ]);

    }
    public static function contacto( Router $router ) {

        $mensaje = null;
        $color = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
            $respuestas = $_POST['contacto'];

            // debuguear($_POST['contacto']);

            if (
                $_POST['contacto']['nombre'] !== "" || 
                $_POST['contacto']['mensaje'] !== "" || 
                $_POST['contacto']['precio'] !== "") {

                
            // Crearemos una instancia de PHP Mailer
            $mail = new PHPMailer();

            // Configurar SMTP
            // Es el parametro usado para el envio de imails
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'e658c4d138f0d9';
            $mail->Password = 'cdd6813a888d74';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del Email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes Un Nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // debuguear($respuestas);
            
            // Definir el contenido
            // Usamos la concatenacion
            $contenido = ' <html> ';
            $contenido .= '<p style="color: red"> Tienes un nuevo mensaje </p>' ;
            $contenido .= '<p>Nombre: '. $respuestas['nombre'] . '</p>' ;
            

            // Enviar de forma condicional algunos campos de email o telefono
            if ($respuestas['contacto'] === 'telefono') {

                $contenido .= '<p> Eligio ser contactado por telefono </p>';
                $contenido .= '<p>Telefono: '. $respuestas['telefono'] . '</p>' ;
                $contenido .= '<p>Fecha Contacto: '. $respuestas['fecha'] . '</p>' ;
                $contenido .= '<p>Hora: '. $respuestas['hora'] . '</p>' ;

            } else {

                // Es email, entonces agregamos el campo de email
                $contenido .= '<p> Eligio ser contactado por email: </p>';
                $contenido .= '<p>Email: '. $respuestas['email'] . '</p>' ;

            }

            $contenido .= '<p>Mensaje: '. $respuestas['mensaje'] . '</p>' ;
            $contenido .= '<p>Tipo: '. $respuestas['tipo'] . '</p>' ;
            $contenido .= '<p>Precio: '. $respuestas['precio'] . '</p>' ;
            $contenido .= '<p>Contacto: '. $respuestas['contacto'] . '</p>' ;            

            $contenido .= '</html> ';

            // Integracion al cuerpo
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el Email
            if ($mail->send()) {
                $mensaje = "Mensaje Enviado Correctamente";
                $color = "exito";
            } else {
                $mensaje =  "El mensaje no se pudo enviar";
                $color = "error";
            }

            } else {

                $mensaje = "El mensaje no se pudo enviar, rellena todos los datos";
                $color = "error";

            }


        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje,
            'color' => $color
        ]);

    }
}