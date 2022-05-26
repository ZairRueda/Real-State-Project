<?php 

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', 'root', 'bienes_raices');

    if (!$db) {
        echo 'Error al intentar conectar';
        exit;
    }

    return $db;
}

