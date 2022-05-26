<?php

define('TEMPLATES_URL', __DIR__ . '/templates');

define('FUNCIONES_URL', __DIR__ . '/funciones.php');

// Creacion de la funcion carpeta imagenes para instanciar
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

// Podemos tipar el codigo para mayor especificacion

function incluirTemplate(string $nombre, bool $inicio = false, bool $h1 = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

// Para no repetir codigo a la hora de estar autenticado el usuario
function estaAutenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

function debuguear($variable)
{

    echo '<pre>';
    var_dump($variable);
    echo '</pre>';

    exit;
}

// Escapa / Sanitizar el HTMl 
// Haremos esto para que la informacion que estemos enviando por parte del cliente no sea insegura, para eso se usa la sanitizacion
function s($html): string
{
    $s = htmlspecialchars($html);

    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo)
{
    // Si al propiedad que buscamos no se encuentra en este arreglo el codigo no se ejecutara
    $tipos = ['vendedor', 'propiedad'];

    // Retornamos lo que se va a buscar
    //  1. La propiedad que se buscara
    //  2. El arreglo donde se buscara 
    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje =  false;
    }

    return $mensaje;
}

// Esta funcion nos servira para mandar el ID validado a nuestro metoda Clase PropiedadControler
function validarORedireccionar(string $url)
{
    $id = $_GET['id'];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url}");
    }

    return $id;
}
