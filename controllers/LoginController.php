<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController {

    // Metodos
    public static function login(Router $router) {
        // Para ver si el llamado funciona
        // echo 'Desde login';

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_POST);

            // Esto creara una nueva instancia con lo que haya en post
            $auth = new Admin($_POST);

            // debuguear($auth->validar());

            $errores = $auth->validar();

            // debuguear($errores);

            // Si esta basio el arreglo entonces...
            if (empty($errores)){
                // Verificar si el usuario existe
                $resultado = $auth->exiteUsuario();

                // debuguear($resultado);

                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {


                    // debuguear($resultado);
                    // Verificar el password
                    // Le podemos pasar el resultado ya que no esta retornando el elemento que contenga el correo ingresado
                    // gracias a la funcion existeUsuario
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        // autenticar el usuario
                        $auth->autenticar();

                    } else {
                        // Password incorrecto
                        $errores = Admin::getErrores();

                    }

                    


                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function create(Router $router) {

        $router->render('auth/create', [
            
        ]);
    }

    public static function logout() {
        
        session_start();

        $_SESSION = [];

        header('Location: / ');
        
    }
}