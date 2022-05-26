<?php foreach ($blogs as $blog) { ?>
<article class="entrada-blog" data-cy="entrada-blog">
    <div class="imagen">
        <picture>
            <img loading="lazy" 
            src="imagenes/<?php echo $blog->imagen; ?>" 
            alt="Texto Entrada Blog">
        </picture>
    </div>

    <div class="texto-entrada">
        <a href="/entrada?id=<?php echo $blog->id ?>">
            <h4><?php echo $blog->titulo; ?></h4>
            <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span>Aun no especificado</span></p>
            <p><?php echo $blog->mensaje; ?></p>
        </a>
    </div>
</article>
<?php }; ?>
