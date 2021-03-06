

<div class="contenedor-anuncios" data-cy="seccion-anuncios">


<?php foreach ($propiedades as $propiedad) { ?>
    <!-- Antes era un While pero al ser un arreglo ahora sera un Foreach -->
    <div class="anuncio" data-cy="anuncio">
        <picture>
            <!-- <source srcset="build/img/anuncio1.webp" type="image/webp">
        <source srcset="build/img/anuncio1.jpg" type="image/jpeg"> -->
            <img loading="lazy" class="imagen-anuncio" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">
        </picture>

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p><?php echo $propiedad->descripcion; ?></p>
            <p class="precio"> $ <?php echo $propiedad->precio; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>

            <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block" data-cy="enlace-propiedad">Ver Propiedad</a>

        </div>
        <!--.contenido-anuncio-->
    </div>
    <!--anuncio-->
<?php } ?>


</div>