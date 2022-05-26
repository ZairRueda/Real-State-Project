<fieldset>
    <legend>Información General</legend>

    <!-- nombre -->
    <div>
        <?php if (isset($errores['nombre'])) { ?>
            <div class="alerta">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['nombre']; ?>
                </div>
            </div>

        <?php }; ?>
    </div>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedor->nombre) ?>">

    <!-- apellido -->

    <div>
        <?php if (isset($errores['apellido'])) { ?>

            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['apellido']; ?>
                </div>
            </div>

        <?php }; ?>
    </div>
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedor->apellido) ?>">

    

</fieldset>

<fieldset>
    <legend>Informasion Extra</legend>

    <!-- telefono -->
    <div>
        <?php if (isset($errores['telefono'])) { ?>
            <div class="alerta error">
                <i class='bx bx-error-circle'></i>

                <div class="texto">
                    <?php echo $errores['telefono']; ?>
                </div>
            </div>
        <?php }; ?>
    </div>
    <label for="telefono">Telefono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor(a)" value="<?php echo s($vendedor->telefono) ?>"></input>
    
</fieldset>