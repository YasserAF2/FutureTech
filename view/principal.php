<main>
    <?php

    // Obtener el array de categorías de la tienda
    $categorias = $dataToView['categorias'];
    ?>

    <main>
        <!-- Sección de destacados -->
        <section class="destacados">
            <h2>Productos Destacados</h2>
            <!-- Lista de productos destacados -->
            <ul>
                <?php
                // Recorrer el array de categorías
                foreach ($categorias as $categoria) {
                    // Obtener el array de productos de la categoría actual
                    $productos = $categoria->getProductos(1);

                    // Recorrer el array de productos de la categoría actual
                    foreach ($productos as $producto) {
                ?>
                        <li>
                            <a href="#">
                                <img src="<?php echo $producto->getImagen(); ?>" alt="<?php echo $producto->getNombre(); ?>">
                                <h3><?php echo $producto->getNombre(); ?></h3>
                                <p><?php echo $producto->getDescripcion(); ?></p>
                                <span class="precio"><?php echo $producto->getPrecio(); ?> €</span>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </section>

        <!-- Sección de ofertas -->
        <section class="ofertas">
            <h2>Ofertas</h2>
            <!-- Lista de productos en oferta -->
            <ul>
                <?php
                // Recorrer el array de categorías
                foreach ($categorias as $categoria) {
                    // Obtener el array de productos de la categoría actual
                    $productos = $categoria->getProductos(3);

                    // Recorrer el array de productos de la categoría actual
                    foreach ($productos as $producto) {
                        if ($producto->getOferta()) {
                ?>
                            <li>
                                <a href="#">
                                    <img src="<?php echo $producto->getImagen(); ?>" alt="<?php echo $producto->getNombre(); ?>">
                                    <h3><?php echo $producto->getNombre(); ?></h3>
                                    <p><?php echo $producto->getDescripcion(); ?></p>
                                    <span class="precio-original"><?php echo $producto->getPrecio(); ?> €</span>
                                    <span class="precio-oferta"><?php echo $producto->getPorcentajeOferta(); ?> €</span>
                                </a>
                            </li>
                <?php
                        }
                    }
                }
                ?>
            </ul>
        </section>
    </main>

</main>