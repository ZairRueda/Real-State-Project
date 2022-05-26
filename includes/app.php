<?php

// Ahora app sera el sentro de mando de funciones, bases de datos y clases 

require 'funciones.php';
require 'config/database.php';
// Estamos cargando Todo el Autoload por ende esta disponible en toda la aplicacion
require __DIR__ . '/../vendor/autoload.php';

// Conectar a la base de datos, para poder mandar a la clase
$db = conectarDB();

// Se agrega la clase para que aqui se pueda usar tambien

use Model\ActiveRecord;
// use App\Propiedad;


// Intancia para ver que funcione
// $propiedad = new Propiedad();
// var_dump($propiedad);

// Instacimos la base de datos para mandarla hacia la clase en Propiedade.php
ActiveRecord::setDB($db);