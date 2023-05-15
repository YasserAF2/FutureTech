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
    <div>
        <p><?php echo $mensaje; ?></p>
    </div>
<?php else : ?>
    <div class="container carrito">
        <div>
            <h2>Tu carrito</h2>
            <?php foreach ($productos_agrupados as $producto) : ?>
                <div class="divcarrito">
                    <div class="divimagen">
                        <img class="carritoimg" src="data:image/jpeg;base64,<?php echo $producto['imagen']; ?>" alt="Imagen del producto">
                    </div>
                    <div><?php echo $producto['nombre']; ?></div>
                    <div><?php echo $producto['precio']; ?>€</div>
                    <div> <i class="fas fa-trash-alt"></i> Borrar
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div>
            <h2>Resumen de la compra</h2>
            <p class="precio-total">Precio total: <?php echo $precio_total; ?> euros.</p>
            <button type="button" class="btn">Continuar con la compra</button>
        </div>
    </div>
<?php endif; ?>