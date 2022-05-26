<main class="contenedor seccion">
    <h1>Administrador de Bienes Raises</h1>

    <?php

    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));

        if ($mensaje) { ?>

            <div class="alerta">
                <p class="texto exito"><?php echo s($mensaje) ?></p>
            </div>

    <?php }
    } ?>



    <div class='justific'>
        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>

        <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>

        <a href="/blogs/crear" class="boton boton-amarillo">Nuevo Blog</a>
    </div>




    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <!-- Foreach es especial para iterar sobre arreglos -->
            <?php foreach ($propiedades as $propiedad) : ?>

                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo ?></td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <!-- Pasaremos el Id para que el get toma el Id de la propiedad -->
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <!-- Foreach es especial para iterar sobre arreglos -->
            <?php foreach ($vendedores as $vendedor) : ?>

                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <!-- Pasaremos el Id para que el get toma el Id de la propiedad -->
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Blogs -->

    <h2>Blogs</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Mensaje</th>
                <th>Imagen</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($blogs as $blog) : ?>
            <tr>
                <td><?php echo $blog->id; ?></td>
                <td><?php echo $blog->titulo; ?></td>
                <td><?php echo $blog->mensaje; ?></td>
                <td><img class="imagen-tabla" src="/imagenes/<?php echo $blog->imagen; ?>"></td>
                <td> Aun no definido </td>
                <td>
                    <form method="POST" class="w-100" action="/bloges/eliminar">
                        <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                        <input type="hidden" name="tipo" value="blog">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>

                    <!-- Pasaremos el Id para que el get toma el Id de la propiedad -->
                    <a href="/blogs/actualizar?id=<?php echo $blog->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>