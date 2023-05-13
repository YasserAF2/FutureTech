<main>
    <?php


    // Obtener el array de categorías de la tienda
    $categorias = $dataToView['categorias'];
    ?>

    <div>
        <div>
            Bienvenido a FutureTech, la tienda en línea para tecnología de vanguardia. Ofrecemos una amplia selección
            de productos tecnológicos de alta calidad, desde portátiles y ordenadores de sobremesa hasta periféricos y
            accesorios
            para computadoras. Nuestros productos son cuidadosamente seleccionados para garantizar que nuestros clientes
            obtengan la mejor experiencia tecnológica posible. Ofrecemos precios competitivos y envío rápido para que
            pueda
            disfrutar de sus productos lo antes posible. En FutureTech, nos comprometemos a brindar productos y
            servicios de alta calidad a nuestros clientes, ¡ven y descubre el futuro de la tecnología con nosotros!
        </div>

        <!-- Sección de destacados -->
        <section class="container">
            <h2>Productos Destacados</h2>
            <!-- Lista de productos destacados -->
            <ul class="destacados row">
                <?php

                $productos = array(); // Inicializar el array de productos vacío
                for ($i = 1; $i <= 5; $i++) {
                    $productosPagina = $categoria->getProductos($i); // Obtener los productos de la página actual
                    $productos = array_merge($productos, $productosPagina); // Unir los productos obtenidos con el array de productos total
                }

                $productos = array_unique($productos, SORT_REGULAR);

                // Recorrer el array de productos de la categoría actual
                foreach ($productos as $producto) {
                    if ($producto->getDestacado() == 1) {
                        $id = $producto->getIdProducto();
                ?>
                        <li class="col-sm-6 col-md-4 col-lg-3">
                            <a href="index.php?action=producto_individual&id_producto=<?php echo $id; ?>">
                                <img class="imagen-principal" src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>" alt="<?php echo $producto->getNombre(); ?>">
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
        <section class="container">
            <h2>Ofertas</h2>
            <!-- Lista de productos en oferta -->
            <ul class="ofertas row">
                <?php
                // Recorrer el array de productos de la categoría actual
                foreach ($productos as $producto) {
                    if ($producto->getOferta() == 1) {
                        $id = $producto->getIdProducto();
                ?>
                        <li class="col-sm-6 col-md-4 col-lg-3">
                            <a href="index.php?action=producto_individual&id_producto=<?php echo $id; ?>">
                                <img class="imagen-principal" src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>" alt="<?php echo $producto->getNombre(); ?>">
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
    </div>

</main>