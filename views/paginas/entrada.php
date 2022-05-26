<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo; ?></h1>


    <picture>
        <img loading="lazy" src="imagenes/<?php echo $blog->imagen; ?>" alt="imagen de la propiedad">
    </picture>

    <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo $vendedor->nombre . ' ' . $vendedor->apellido; ?></span> </p>


    <div class="resumen-propiedad">
        <p><?php echo $blog->mensaje; ?></p>
    </div>
</main>