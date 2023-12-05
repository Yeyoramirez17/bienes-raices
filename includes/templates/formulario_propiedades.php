<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la Propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>" />

    <label for="precio">Precio:</label>
    <input type="text" id="precio" name="propiedad[precio]" placeholder="Precio de la Propiedad" value="<?php echo sanitizar($propiedad->precio); ?>" />

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg,image/png" />

    <?php if($propiedad->imagen) : ?>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="" class="imagen-small">
    <?php endif ?>

    <label for="descripcion">Descripción:</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" value="<?php echo sanitizar($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" value="<?php echo sanitizar($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" value="<?php echo sanitizar($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor_id">Vendedor</label>

    <select name="propiedad[vendedor_id]" id="vendedor_id">
        <option value="">--Seleccione--</option>
        <?php foreach ($vendedores as $vendedor) : ?>
            <option <?php echo $propiedad->vendedor_id === $vendedor->id ? 'selected' : ''; ?> 
                value="<?php echo sanitizar($vendedor->id); ?>"
            >
                <?php echo sanitizar($vendedor->nombre) . ' ' . sanitizar($vendedor->apellido); ?>
            </option>
        <?php endforeach ?>
    </select>
</fieldset>