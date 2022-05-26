<fieldset>
    <legend>Información General</legend>

    <!-- Titulo -->
    <div>
        <?php if (isset($errores['titulo'])) { ?>
            <div class="alerta">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['titulo']; ?>
                </div>
            </div>

        <?php }; ?>
    </div>
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo) ?>">

    <!-- Precio -->

    <div>
        <?php if (isset($errores['precio'])) { ?>

            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['precio']; ?>
                </div>
            </div>

        <?php }; ?>
    </div>
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio) ?>">


    <!-- Imagen -->
    <div>
        <?php if (isset($errores['imagen'])) { ?>
            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['imagen']; ?>
                </div>
            </div>

        <?php }; ?>
    </div>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">
    <?php if ($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php } ?>

    <!-- Descripcion -->
    <div>
        <?php if (isset($errores['descripcion'])) { ?>
            <div class="alerta error">
                <i class='bx bx-error-circle'></i>

                <div class="texto">
                    <?php echo $errores['descripcion']; ?>
                </div>
            </div>
        <?php }; ?>
    </div>
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion) ?></textarea>

</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <!-- Habitaciones -->
    <div>
        <?php if (isset($errores['habitaciones'])) { ?>
            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['habitaciones']; ?>
                </div>
            </div>
        <?php }; ?>
    </div>
    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" value="<?php echo s($propiedad->habitaciones) ?>" placeholder="Ej: 3" min="1" max="9">

    <!-- Baños -->
    <div>
        <?php if (isset($errores['wc'])) { ?>
            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['wc']; ?>
                </div>
            </div>
        <?php }; ?>
    </div>
    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" value="<?php echo s($propiedad->wc) ?>" placeholder="Ej: 3" min="1" max="9">

    <!-- Estacionamiento -->
    <div>
        <?php if (isset($errores['estacionamiento'])) { ?>
            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['estacionamiento']; ?>
                </div>
            </div>
        <?php }; ?>
    </div>
    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" value="<?php echo s($propiedad->estacionamiento) ?>" placeholder="Ej: 3" min="1" max="9">



</fieldset>

<fieldset>

    <legend>Vendedor</legend>
    
    <div>
        <!-- Error -->
        <?php if (isset($errores['vendedor'])) { ?>
            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['vendedor']; ?>
                </div>
            </div>
        <?php }; ?>
    </div> <!-- Error -->

    <label for="vendedor">Vendedor</label>

    <select name="propiedad[vendedorId]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach ($vendedores as $vendedor) { ?>
            <!-- Inicia el bucle -->

            <!--Aqui comprovamos que el id sea igual al de la tabla 
                    de propiedades servira para asigar la propiedad al vendedor
                    si existe un id entonses se presenta selected -->
            <option 
                <?php echo s($propiedad->vendedorId) === s($vendedor->id) ? 'selected' : ''; ?>
                value="<?php echo s($vendedor->id); ?>">
                <!-- Aqui termina el option a value le asigamos el id del vendedor -->
                <!-- 
                    Creamos la coneccion al nombre y el apellido del usaurio
                    -->
                <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option>

        <?php }; ?>
        <!-- Fin del bucle -->
    </select>
    
</fieldset>