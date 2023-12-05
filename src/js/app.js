document.addEventListener('DOMContentLoaded', () => {
    eventListeners();
    darkMode();
});

function eventListeners() {
    const mobilMenu = document.querySelector('.mobile-menu');
    
    mobilMenu.addEventListener('click', navegacionResponsive );

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach( input => input.addEventListener('click', mostrarMetodosContacto) );
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')
    
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
     
    prefiereDarkMode.addEventListener('change', () => {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
}

function mostrarMetodosContacto( event ) {
    const contactoDiv = document.querySelector('#contacto');

    if(event.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero de Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" name="contacto[telefono]" id="telefono">

            <p>Elija la fecha y la hora, de la llamada</p>

            <label for="fecha">Fecha</label>
            <input type="date" name="contacto[fecha]" id="fecha">

            <label for="hora">Hora</label>
            <input type="time" min="09:00" max="18:00" name="contacto[hora]" id="hora">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">Tu E-mail</label>
            <input type="email" placeholder="Tu Email" name="contacto[email]" id="email" required>
        `;
    }
}