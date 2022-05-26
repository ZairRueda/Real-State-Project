<fieldset>
    <legend>Información General</legend>

    <!-- titulo -->
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
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo blog" value="<?php echo s($blog->titulo) ?>">

    <!-- mensaje -->

    <div>
        <?php if (isset($errores['mensaje'])) { ?>

            <div class="alerta error">
                <i class='bx bx-error-circle'></i>


                <div class="texto">
                    <?php echo $errores['mensaje']; ?>
                </div>
            </div>

        <?php }; ?>
    </div>
    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="blog[mensaje]" placeholder="Descripcion" value="<?php echo s($blog->titulo) ?>"><?php echo s($blog->mensaje) ?></textarea>

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
    <input type="file" id="imagen" name="blog[imagen]" accept="image/jpeg, image/png">
    <?php if ($blog->imagen) { ?>
        <img src="/imagenes/<?php echo $blog->imagen ?>" class="imagen-small">
    <?php } ?>
    

</fieldset>

<fieldset>

    <legend>Autor</legend>
    
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

    <label for="vendedor">Autor</label>

    <select name="blog[vendedor]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach ($vendedores as $vendedor) { ?>
            
            <option 
                <?php echo s($blog->vendedor) === s($vendedor->id) ? 'selected' : ''; ?>
                value="<?php echo s($vendedor->id); ?>">
                <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option>

        <?php }; ?>
    </select>
    
</fieldset>