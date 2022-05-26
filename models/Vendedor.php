<?php 

namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];


    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($argc = []) {
        
        // hemos cambiado el valor por Defould de ID por que nos estaba rellenandolo con un String vasio
        $this->id = $argc['id'] ?? null;
        $this->nombre = $argc['nombre'] ?? '';
        $this->apellido = $argc['apellido'] ?? '';
        $this->telefono = $argc['telefono'] ?? '';

    }

    // Este metodo seutiliza ya dentro del archivo destino para validar de la forma anterior
    // Revisando que no haya erroes
    public function validar(){

        if (!$this->nombre) {
            self::$errores['nombre'] = "Debes añadir un nombre";
        }
    
        if (!$this->apellido) {
            self::$errores['apellido'] = "Debes añadir un apellido";
        }

        // Usaremos uaa exprecion regular par avalidar el telefono
        // Que es? busca un patron dentro de un texto
        // Esta, revisa que sean del 1 al 9 y de 10 digitos la / son para descirle que es el corr
        if (!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores['telefono'] = "Debes añadir un telefono y que sea valido";
        }

        return self::$errores;
    }
}