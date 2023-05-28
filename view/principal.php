<main>
    <?php


    // Obtener el array de categorías de la tienda
    $categorias = $dataToView['categorias'];
    ?>

    <div>
        <section class="highlight">
            <div class="hero-carousel">
                <div class="cs2 carousel-slide">
                    <h1>¡Nuevos móviles disponibles en nuestra tienda!</h1>
                    <div class="d-carrusel">
                        <p>Descubre los últimos modelos de teléfonos móviles con tecnología de vanguardia.</p>
                        <button type="button" class="btn btn-primary">Ver ahora</button>
                    </div>
                </div>
                <div class="cs1 carousel-slide">
                    <div>
                        <h1>Bienvenido a FutureTech, tu tienda en línea para tecnología de vanguardia.</h1>
                        <p class="container">
                            Ofrecemos una amplia selección de productos tecnológicos de alta calidad, desde portátiles y
                            ordenadores de sobremesa hasta periféricos y accesorios para computadoras.
                            Nuestros productos son cuidadosamente seleccionados para garantizar que nuestros clientes
                            obtengan la mejor experiencia tecnológica posible.
                            Ofrecemos precios competitivos y envío rápido para que puedas disfrutar de tus productos lo
                            antes posible.
                            En FutureTech, nos comprometemos a brindar productos y servicios de alta calidad a nuestros
                            clientes. ¡Ven y descubre el futuro de la tecnología con nosotros!
                        </p>
                    </div>
                </div>
                <div class="cs3 carousel-slide">
                    <h1>¡Nuevas ofertas de ordenadores de sobremesa!</h1>
                    <div class="d-carrusel">
                        <p>Aprovecha nuestras increíbles ofertas en ordenadores de sobremesa de última generación.</p>
                        <button type="button" class="btn btn-primary">Ver ahora</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de destacados -->
        <section class="container">
            <div class="titulo-d">
                <h2>Productos Destacados</h2>
            </div>
            <!-- Lista de productos destacados -->
            <ul class="destacados">
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
                        <li>
                            <a href="index.php?action=producto_individual&id_producto=<?php echo $id; ?>">
                                <img class="imagen-principal" src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>" alt="<?php echo $producto->getNombre(); ?>">
                                <p class="nproducto"><?php echo $producto->getNombre(); ?></p>
                                <!--<p><?php echo $producto->getDescripcion(); ?></p>-->
                                <span class="precio">Precio: <?php echo $producto->getPrecio(); ?> €</span>
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
            <div class="titulo-d">
                <h2>Ofertas</h2>
            </div>
            <!-- Lista de productos en oferta -->
            <ul class="ofertas">
                <?php
                // Recorrer el array de productos de la categoría actual
                foreach ($productos as $producto) {
                    if ($producto->getOferta() == 1) {
                        $id = $producto->getIdProducto();
                ?>
                        <li>
                            <a href="index.php?action=producto_individual&id_producto=<?php echo $id; ?>">
                                <img class="imagen-principal" src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>" alt="<?php echo $producto->getNombre(); ?>">
                                <h3 class="nproducto"><?php echo $producto->getNombre(); ?></h3>
                                <!--<p><?php echo $producto->getDescripcion(); ?></p>-->
                                <span class="precio">Precio: <?php echo $producto->getPrecio(); ?> €</span>
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