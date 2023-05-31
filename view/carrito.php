<?php
$tienda = new Tienda();
$productos = $dataToView['productos'];
$precio_total = $dataToView['precio_total'];
$mensaje = $dataToView['mensaje'];

// Agrupar los productos por id_producto y llevar un registro de la cantidad
$productos_agrupados = [];
foreach ($productos as $producto) {
    $id_producto = $producto['id_producto'];
    if (isset($productos_agrupados[$id_producto])) {
        $productos_agrupados[$id_producto]['cantidad'] += $producto['cantidad'];
    } else {
        $imagen_base64 = $tienda->obtenerImagenProducto($id_producto);
        $productos_agrupados[$id_producto] = [
            'id' => $id_producto,
            'nombre' => $tienda->obtenerNombreProducto($id_producto),
            'imagen' => base64_encode($imagen_base64),
            'precio' => $producto['precio'],
            'cantidad' => $producto['cantidad']
        ];
    }
}
?>

<?php if (empty($productos)) : ?>
<main class="mensajecarrito">
    <div><i class="fas fa-shopping-cart"></i></div>
    <div>
        <h1>¡Tu carrito esta vacío!</h1>
    </div>
</main>
<?php else : ?>
<main>
    <div class="container carrito">
        <div>
            <h2>Tu carrito</h2>
            <?php foreach ($productos_agrupados as $producto) : ?>
            <div class="divcarrito">
                <div class="divimagen">
                    <a href="index.php?action=producto_individual&id_producto=<?php echo $producto['id'] ?>">
                        <img class="carritoimg" src="data:image/jpeg;base64,<?php echo $producto['imagen']; ?>"
                            alt="Imagen del producto">
                    </a>
                </div>
                <div class="datosCarrito">
                    <p><?php echo $producto['nombre']; ?></p>
                    <p>Precio: <?php echo $producto['precio']; ?>€</p>
                    <p>Cantidad: <?php echo $producto['cantidad']; ?></p>
                </div>
                <div class="carritoBorrar">
                    <a href="index.php?action=eliminarProductoCarrito&id=<?php echo $producto['id']; ?>"
                        class="btn-eliminar"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="resumen">
            <h2>Resumen de la compra</h2>
            <div>
                <p class="precio-total">Precio total: <?php echo $precio_total; ?> euros.</p>
            </div>
            <div>
                <h2>Pagar con Paypal</h2>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="VCW9P9F7DEJSC">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0"
                        name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1"
                        height="1">
                </form>
            </div>
            <div>
                <h2>Realizar el pedido</h2>
                <form action="index.php?action=compra" method="POST">
                    <input type="hidden" name="precio_total" value="<?php echo $precio_total; ?>">
                    <input type="hidden" name="correo" value="<?php echo $_SESSION['usuario']; ?>" />
                    <input type="submit" value="Proceder con el pago" />
                </form>
            </div>
        </div>
    </div>
</main>
<?php endif; ?>