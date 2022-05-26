<main class="contenedor seccion">
    <h1>Reguistrar Vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" action="/vendedores/crear">

        <?php include __DIR__ . '/formularioVendedores.php'; ?>

        <input type="submit" value="Generar Vendedor" class="boton boton-verde">
    </form>

</main>