<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="titulo-propiedad"><?php echo $propiedad->titulo ?></h1>

    <picture>
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen de la propiedad">

    </picture>

    <div class="resumen-propiedad">
        <p class="precio">$ <?php echo $propiedad->precio; ?></p>
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

        <p><?php echo $propiedad->descripcion; ?></p>

        <p class="vendedor"> <span>Vendedor: </span> <?php echo $vendedor->nombre . ' ' . $vendedor->apellido; ?></p>
    </div>
</main>