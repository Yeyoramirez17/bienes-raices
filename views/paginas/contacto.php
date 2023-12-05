<main class="contenedor"> <!-- Main -->
    <h1>Contacto</h1>

    <?php
        if( $mensaje ) {
            echo "<p class='alerta exito'>" . $mensaje . "</p>";
        }
    ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>

    <form action="/contacto" method="POST" class="formulario">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" name="contacto[nombre]" id="nombre" required>            

            <label for="mensaje">Mensaje</label>
            <textarea name="contacto[mensaje]" id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select name="contacto[tipo]" id="opciones">
                <option value="" disabled selected>-- Selecciona --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu Precio o Presupuesto" name="contacto[presupuesto]" id="presupuesto" required>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Como desea se contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" name="contacto[contacto]" id="contactar-email" required>
            </div>

            <div id="contacto"></div>
            
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main> <!-- End Main -->