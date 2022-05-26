<?php 

namespace Model;

class Blog extends ActiveRecord {

    protected static $tabla = 'blogs';

    protected static $columnasDB = ['id', 'titulo', 'mensaje', 'imagen', 'vendedor', 'creado'];

    public $id;
    public $titulo;
    public $mensaje;
    public $imagen;
    public $vendedor;
    public $creado;

    public function __construct($argc = []) {
        
        // hemos cambiado el valor por Defould de ID por que nos estaba rellenandolo con un String vasio
        $this->id = $argc['id'] ?? null;
        $this->titulo = $argc['titulo'] ?? '';
        $this->mensaje = $argc['mensaje'] ?? '';
        $this->imagen = $argc['imagen'] ?? '';
        $this->vendedor = $argc['vendedor'] ?? '';
        $this->creado = date('Y-m-d') ?? '';

    }

    // Este metodo se utiliza ya dentro del archivo destino para validar de la forma anterior
    // Revisando que no haya errores
    public function validar(){

        if (!$this->titulo) {
            self::$errores['titulo'] = "Debes añadir un titulo";
        }

        if (!$this->mensaje) {
            self::$errores['mensaje'] = "Debes añadir un mensaje";
        }

        if (!$this->imagen) {
            self::$errores['imagen'] = "Debes añadir un imagen";
        }

        if (!$this->vendedor) {
            self::$errores['vendedor'] = "Debes añadir un vendedor";
        }

        return self::$errores;
    }

}