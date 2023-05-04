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
        <h1>Mi carrusel de imágenes:</h1>
        <div class="carrusel-robots">
            <div>
                <img src="https://via.placeholder.com/400x200.png?text=Slide+1" alt="Slide 1">
                <div class="caption">Contenido del primer slide</div>
            </div>
            <div>
                <img src="https://via.placeholder.com/400x200.png?text=Slide+2" alt="Slide 2">
                <div class="caption">Contenido del segundo slide</div>
            </div>
            <div>
                <img src="https://via.placeholder.com/400x200.png?text=Slide+3" alt="Slide 3">
                <div class="caption">Contenido del tercer slide</div>
            </div>
        </div>







        <!--         <section class="destacados container">
            <h2>Productos Destacados</h2> -->
        <!-- Lista de productos destacados -->
        <!-- <ul class="row">
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
        </section> -->

        <!-- Sección de ofertas -->
        <section class="ofertas container">
            <h2>Ofertas</h2>
            <!-- Lista de productos en oferta -->
            <ul class="row">
                <?php

                // Recorrer el array de productos de la categoría actual
                foreach ($productos as $producto) {
                    if ($producto->getOferta() == 1) {
                        $id = $producto->getIdProducto();
                ?>
                        <li class="col-sm-6 col-md-4 col-lg-3">
                            <a href="index.php?action=producto_individual&id_producto=<?php echo $id; ?>">
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
    </div>

</main>