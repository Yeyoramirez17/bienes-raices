<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="/login" method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" placeholder="Tu Contraseña" name="password" id="password">

            <input type="submit" value="Inisiar Sesión" class="boton boton-verde">
        </fieldset>
    </form>
</main>