<?php 

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

if (!isset($inicio) || !isset($h1) ) {
    $inicio = false;
    $h1 = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../build/css/app.css">
    <!-- la diagonal antes del Build es para que tome como referencia
    el inicio del archivo y no haya fallos a la hora de llamarlo -->
</head>
<body>
    <!-- La funcion que agregamo evalua que la funcion exista
         si existe agrega la clase y si no agregrega basio.
         Es necesario agregar 
         isset : para verificar que la variable este definida
         *hemos borrado el isset por que esa funcion ya se esta logrando
         con las funciones-->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="../build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="../build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    
                    <nav data-cy="navegacion-header" class="navegacion">
                        
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth === true) { ?>
                            <a href="/admin">Admin</a>

                            <a href="/logout">Cerrar Sesión</a>
                        <?php } else {?>
                            <a href="/login">Iniciar Seción</a>
                        <?php }?>

                        <img class="dark-mode-boton" src="../build/img/sun-mode.svg">
                    </nav>
                </div>
   
                
            </div> <!--.barra-->

            <!-- Igual aqui como arriba, se comprueva que existe la variable
                 si existe agrega el contenido
                 Es necesario agregar 
                 isset : para verificar que la variable este definida -->
            <?php  echo $h1 ? '<h1 data-cy="heading-sitio">Venta de Casas y Departamentos  Exclusivos de Lujo</h1>' : '';?>

        </div>
    </header>

    <?php echo $contenido; ?>
        
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav data-cy="navegacion-footer" class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Propiedades</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

        <?php 
           $fecha = date('Y');
        ?>
        <p data-cy="copyright" class="copyright">Todos los derechos Reservados <?php echo $fecha; ?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>
</html>