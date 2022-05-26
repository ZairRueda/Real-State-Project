document.addEventListener('DOMContentLoaded', function() {

    eventListeners();

    darkMode();

    alertaProductoCreado();
});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    // console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
        
    } else {
        document.body.classList.remove('dark-mode');
        
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales
    // Treremos los campos de Correo y Telefono para hacerlos condicionales, y ejecutar una funcion segun eso
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    // Al ser un elemento All no se puede instanciar con un addeventlistener

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}

function alertaProductoCreado() {
    
    const botonProducto = document.querySelector('#alertaCreado');

    console.log(botonProducto);
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero Teléfono</label>
            <input data-cy="input-telefono" type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input data-cy="input-hora" type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;

    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input data-cy="input-email" type="email" placeholder="Tu Email" id="email" name="contacto[email]">
        `;
    }
}