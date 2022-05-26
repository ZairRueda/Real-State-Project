<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>

<?php foreach ($blogs as $blog) { ?>

    

    <article class="entrada-blog">
        <div class="imagen">
            <picture>
                <!-- <source srcset="build/img/blog1.webp" type="image/webp">
                <source srcset="build/img/blog1.jpg" type="image/jpeg"> -->
                <img 
                loading="lazy"
                src="imagenes/<?php echo $blog->imagen ?>" 
                alt="Imagen Entrada Blog"
                >
            </picture>
        </div>

        <div class="texto-entrada">
            <a href="/entrada">
                <h4><?php echo $blog->titulo ?></h4>
                <p>Escrito el: <span><?php echo $blog->creado ?></span> por: <span> No definido aun </span> </p>

                <p>
                <?php echo $blog->mensaje ?>
                </p>
            </a>
        </div>
    </article>
<?php }; ?>

    
</main>