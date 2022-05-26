<?php 

namespace MVC;

class Router {
    
    // Areglos donde seguardan las URL como ID y las funciones como valor
    public $rutasGET = [];

    
    public $rutasPOST = [];

    // Esta funcion nos permitira obtener la url en la que estamos posados en el momento y su funcion, dicha URL se esta trallendo del index.php y agregandoce a un arreglo
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        // Inisiamos la sesion
        session_start();

        // Si la sesion esta logiada
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/vendedores/crear', '/vendedores/actualizar', '/propiedades/eliminar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        // Esta funcion se ajecuta en forma de filtro en el arreglo
        // Toma la ruta actual y la compara con la ruta creada por el get y manda a la pantalla su valor
        if ($metodo === 'GET') {
            // fn es igual a la ruta actual
            $fn = $this->rutasGET[$urlActual] ?? null;

            // debuguear($this->rutasGET);
        } else if ($metodo === 'POST'){
            // debuguear($_POST);
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Que sea una ruta protegida y no este autenticada
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: / ');
        }

        if ($fn) {
            // comprueva si la URL existe y hay una funcion asociada

            // call_user_func : Es una funcion que nos va a permitir llamar una funcion que no savemos como se llamara
            // debuguear($fn);

            // $fn : Leemos la funcion asociada
            // $this : contiene la demas informacion del arreglo y de la clase router

            call_user_func($fn, $this);

            // debuguear($fn, $this);
             
        } else {
            echo "Pagina No encontrada";
        }

        
    }

    // Muestra una Ruta
    // Para hacerlo reutilizable lo hacemos construible
    // View es la direccion y Datos son datos extraidos ya sea de BDD o de otro lado ( algun POST o GET )
    public function render($view, $datos = []) {

        // debuguear($datos);

        // Iteramos sobre los datos
        foreach ($datos as $key => $valor) {
            // Lo que hace esta sintaxis es, en la vista mostrar el valor de la llave
            // Mostrar los datos con la variable y mostrara el valor
            // $$ : variable de variable
            // transformara el texto del KEY en variable
            // Para poder irerar en ella

            // De manera pracica, hace una copia o espejo de la variable 
            $$key = $valor;
        }

        // Almacena y guarda en memoria el valor que recibe
        ob_start();

        // Le decimos que incluiremos el archivo
        // E instanciamos prebiamente .PHP
        // Buscara en la carpeta view el archivo view seleccionado
        include __DIR__ . "/views/$view.php";

        // Limpiamos el archivo en memoria, para que el servidor deje de consumir memoria
        $contenido = ob_get_clean();

        // Todo lo que hayamos limpiado se colocara en la direccion dada aqui
        // Esta biene siendo la plantilla que contiene el header y el footer
        include __DIR__ . "/views/layout.php";
    }
}