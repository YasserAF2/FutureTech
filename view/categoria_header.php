<?php
$productos = $dataToView['productos'];
$destacados = array();
$noDestacados = array();

// Separar los productos destacados y no destacados
foreach ($productos as $producto) {
    if ($producto['destacado'] == 1) {
        $destacados[] = $producto;
    } else {
        $noDestacados[] = $producto;
    }
}
?>

<main>
    <div class="container cat">
        <h2 class="titulocategoria"><?php echo $dataToView['categoria_actual']['nombre']; ?></h2>

        <?php foreach ($destacados as $producto) : ?>
            <div class="producto">
                <h2>
                    <a href="index.php?action=producto_individual&id_producto=<?php echo $producto['id_producto']; ?>">
                        <?php echo $producto['nombre']; ?>
                    </a>
                </h2>
                <img class="imagen-categoria" src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" alt="Imagen de <?php echo $producto['nombre']; ?>">
                <p class="producto-d"><?php echo $producto['descripcion']; ?></p>
                <p class="precio-destacado">Precio: <?php echo $producto['precio']; ?>€</p>
                <?php if ($producto['oferta'] == 1) : ?>
                    <p class="oferta">Oferta: <?php echo $producto['porcentaje_oferta']; ?>% de descuento</p>
                <?php endif; ?>
                <form action="index.php?action=agregarAlCarrito" method="POST">
                    <div class="form-group">
                        <div class="cantidadpi2">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" max="<?php echo $producto['cantidad'] ?>">
                        </div>
                        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $producto['id_producto'] ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'] ?>">
                    </div>
                    <?php if ($producto['cantidad'] <= 0 || !isset($_SESSION['usuario'])) : ?>
                        <button type="submit" class="btn btn-primary bt-sesion" disabled title="Inicia sesión para añadir productos a tu carrito personal">Agregar al carrito</button>
                        <?php if (!isset($_SESSION['usuario'])) : ?>
                            <br>
                            <p class="piniciar">Inicia sesión para añadir productos a tu carrito personal</p>
                        <?php endif; ?>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                    <?php endif; ?>
                </form>
                <div class="detalles-categoria">
                    <a class="btn btn-primary" href="index.php?action=producto_individual&id_producto=<?php echo $producto['id_producto']; ?>">
                        Click aquí para ver detalles
                    </a>
                </div>
                <?php if ($producto['destacado'] == 1) : ?>
                    <p class="destacado">¡Destacado!</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <?php foreach ($noDestacados as $producto) : ?>
            <div class="producto">
                <h2>
                    <a href="index.php?action=producto_individual&id_producto=<?php echo $producto['id_producto']; ?>">
                        <?php echo $producto['nombre']; ?>
                    </a>
                </h2>
                <img class="imagen-categoria" src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" alt="Imagen de <?php echo $producto['nombre']; ?>">
                <p class="producto-d"><?php echo $producto['descripcion']; ?></p>
                <p class="precio-destacado">Precio: <?php echo $producto['precio']; ?>€</p>
                <?php if ($producto['oferta'] == 1) : ?>
                    <p class="oferta">Oferta: <?php echo $producto['porcentaje_oferta']; ?>% de descuento</p>
                <?php endif; ?>
                <form action="index.php?action=agregarAlCarrito" method="POST">
                    <div class="form-group">
                        <div class="cantidadpi2">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" max="<?php echo $producto['cantidad'] ?>">
                        </div>
                        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $producto['id_producto'] ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'] ?>">
                    </div>
                    <?php if ($producto['cantidad'] <= 0 || !isset($_SESSION['usuario'])) : ?>
                        <button type="submit" class="btn btn-primary bt-sesion" disabled title="Inicia sesión para añadir productos a tu carrito personal">Agregar al carrito</button>
                        <?php if (!isset($_SESSION['usuario'])) : ?>
                            <br>
                            <p class="piniciar">Inicia sesión para añadir productos a tu carrito personal</p>
                        <?php endif; ?>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                    <?php endif; ?>
                </form>
                <div class="detalles-categoria">
                    <a class="btn btn-primary" href="index.php?action=producto_individual&id_producto=<?php echo $producto['id_producto']; ?>">
                        Click aquí para ver detalles
                    </a>
                </div>
                <?php if ($producto['destacado'] == 1) : ?>
                    <p class="destacado">¡Destacado!</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>