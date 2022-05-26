<main class="contenedor seccion">
    <h1>Actualizar Blog</h1>

    <!-- ?php debuguear ( $_GET ); ?> -->
    <a href="/admin" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php include __DIR__ . '/formularioBlogs.php'; ?>
        
        <input type="submit" value="Actualizar Blog" class="boton boton-verde">
    </form>

</main>