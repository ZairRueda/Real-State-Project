<main class="contenedor seccion">
    <h1>Crear Blog</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" action="/blogs/crear" enctype="multipart/form-data">

        <?php include __DIR__ . '/formularioBlogs.php'; ?>

        <input type="submit" value="Agregar Blog" class="boton boton-verde">
    </form>

</main>