<main>
    <?php


    // Obtener el array de categorías de la tienda
    $categorias = $dataToView['categorias'];
    ?>

    <div>
        <!-- Sección de destacados -->
        <section class="destacados container">
            <h2>Productos Destacados</h2>
            <!-- Lista de productos destacados -->
            <ul class="row">
                <?php

                $productos = array(); // Inicializar el array de productos vacío
                for ($i = 1; $i <= 5; $i++) {
                    $productosPagina = $categoria->getProductos($i); // Obtener los productos de la página actual
                    $productos = array_merge($productos, $productosPagina); // Unir los productos obtenidos con el array de productos total
                }

                // Recorrer el array de categorías
                foreach ($categorias as $categoria) {
                    // Recorrer el array de productos de la categoría actual
                    echo $categoria->getNombre();
                    foreach ($productos as $producto) {
                ?>
                        <li class="col-sm-6 col-md-4 col-lg-3">
                            <a href="producto_individual.php">
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
        <section class="ofertas container">
            <h2>Ofertas</h2>
            <!-- Lista de productos en oferta -->
            <ul class="row">
                <?php
                // Recorrer el array de categorías
                foreach ($categorias as $categoria) {
                    // Obtener el array de productos de la categoría actual
                    $productos = $categoria->getProductos(3);

                    // Recorrer el array de productos de la categoría actual
                    foreach ($productos as $producto) {
                        if ($producto->getOferta()) {
                ?>
                            <li class="col-sm-6 col-md-4 col-lg-3">
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
    </div>

</main>