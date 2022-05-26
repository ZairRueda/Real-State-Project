<main data-cy="pagina-login" class="contenedor seccion contenido-centrado">
    <h1 data-cy="title-login">Iniciar Sesion</h1>

    <div>
        <?php if (isset($errores['notExist'])) { ?>
            <div class="alerta">
                <div data-cy="texto-error" class="texto error">
                    <?php echo $errores['notExist']; ?>
                </div>
            </div>

        <?php }; ?>
    </div>

    <form method="POST" class="formulario"  action="/login" >
        <fieldset>
            <legend>Email y Password</legend>

            <div>
                <?php if (isset($errores['email'])) { ?>
                    <div class="alerta">
                        <i class='bx bx-error-circle'></i>


                        <div data-cy="texto-error" class="texto">
                            <?php echo $errores['email']; ?>
                        </div>
                    </div>

                <?php }; ?>
            </div>
            <label for="email">E-mail</label>
            <input data-cy="type-email" type="email" name="email" placeholder="Tu Email" id="email" autocomplete="username" >

            <div>
                <?php if (isset($errores['password'])) { ?>
                    <div class="alerta">
                        <i class='bx bx-error-circle'></i>


                        <div data-cy="texto-error" class="texto">
                            <?php echo $errores['password']; ?>
                        </div>
                    </div>

                <?php }; ?>
            </div>
            <label for="password">Password</label>
            <input data-cy="type-password" type="password" name="password" placeholder="Tu Password" id="password" autocomplete="new-password">
            
            <div>
                <?php if (isset($errores['incorrecto'])) { ?>
                    <div class="alerta">
                        <i class='bx bx-error-circle'></i>


                        <div data-cy="texto-error" class="texto">
                            <?php echo $errores['incorrecto']; ?>
                        </div>
                    </div>

                <?php }; ?>
            </div>
            
        </fieldset>

        <input data-cy="boton-login" type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>