<?php 
// ==== Programacion Orientada a Objetos ====

// Se agregara el nombre de nuestro autoload
namespace Model;

// use App\ActiveRecord;

// Usaremos la sintaxis anterior a PHP 8
class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($argc = []) {
        
        // hemos cambiado el valor por Defould de ID por que nos estaba rellenandolo con un String vasio
        $this->id = $argc['id'] ?? null;
        $this->titulo = $argc['titulo'] ?? '';
        $this->precio = $argc['precio'] ?? '';
        $this->imagen = $argc['imagen'] ?? '';
        $this->descripcion = $argc['descripcion'] ?? '';
        $this->habitaciones = $argc['habitaciones'] ?? '';
        $this->wc = $argc['wc'] ?? '';
        $this->estacionamiento = $argc['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $argc['vendedorId'] ?? '';

    }

    // Este metodo se utiliza ya dentro del archivo destino para validar de la forma anterior
    // Revisando que no haya errores
    public function validar(){

        if (!$this->titulo) {
            self::$errores['titulo'] = "Debes añadir un titulo";
        }
    
        if (!$this->precio) {
            self::$errores['precio'] = "El Precio es Obligatorio";
        }
    
        if ( strlen($this->descripcion) < 50 ) {
            self::$errores['descripcion'] = "Deves añadir una descripcion que almenos tenga 50 caracteres";
        }
    
        if (!$this->habitaciones) {
            self::$errores['habitaciones'] = "El Número de habitaciones es obligatorio";
        }
    
        if (!$this->wc) {
            self::$errores['wc'] = "El Número de Baños es Obligatorio";
        }
    
        if (!$this->estacionamiento) {
            self::$errores['estacionamiento'] = "El Numero de Lugares de Estacionamiento es Obligatorio";
        }
    
        if (!$this->vendedorId) {
            self::$errores['vendedor'] = "Elige un Vendedor";
        }

        if(!$this->imagen) {
            self::$errores['imagen'] = "Falta agregar una imagen";
        }

        return self::$errores;
    }
    
}