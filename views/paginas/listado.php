<div class="contenedor-anuncios"> <!-- Contenedor Anuncios -->
    <?php foreach ($propiedades as $propiedad) : ?>
        <div class="anuncio"> <!-- Anuncio -->
            <picture>
                <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="<?php echo $propiedad->imagen; ?>">
            </picture>

            <div class="contenido-anuncio"> <!-- Contenido Anuncio -->
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>

                <a class="boton-amarillo-block" href="/propiedad?id=<?php echo $propiedad->id; ?>">Ver Propiedad</a>
            </div> <!-- End Contenido Anuncio -->
        </div> <!-- End Anuncio -->
    <?php endforeach ?>
</div>