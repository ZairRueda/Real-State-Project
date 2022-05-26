<?php

namespace Model;

class Admin extends ActiveRecord {

    // Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';

    }    

    public function validar() {

        if (!$this->email) {
            self::$errores['email'] = "El email es obligatorio";
        }
    
        if (!$this->password) {
            self::$errores['password'] = "Password incorrecto";
        }

        return self::$errores;
    
    }

    public function exiteUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1 "; 

        // debuguear($query);

        $resultado = self::$db->query($query);

        // debuguear($resultado);

        // Si no existe un numero de tablas
        if (!$resultado->num_rows) {
            self::$errores['notExist'] = 'El email no existe';

            // Retornamos para que ya no se ejecute el codigo
            return;
        }

        // En caso de que si exista
        return $resultado;
    }

    public function comprobarPassword($resultado) {
        
        // Transforma nuestro query obtenido a un objetopara poder iterarlo
        $usuario = $resultado->fetch_object();

        // debuguear($resultado->fetch_object());

        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores['incorrecto'] = 'El password es incorrecto';
        }

        // debuguear($autenticado);

        return $autenticado;

    }

    public function autenticar() {

        session_start();
        
        // llenar el arreglo de session

        $_SESSION['usuario'] = $this->email;
        
        $_SESSION['login'] = true;

        header('Location: /admin');

    }
}