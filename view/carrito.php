<?php
$tienda = new Tienda();
$productos = $dataToView['productos'];
$precio_total = $dataToView['precio_total'];

// Agrupar los productos por id_producto y llevar un registro de la cantidad
$productos_agrupados = [];
foreach ($productos as $producto) {
    $id_producto = $producto['id_producto'];
    if (isset($productos_agrupados[$id_producto])) {
        $productos_agrupados[$id_producto]['cantidad'] += $producto['cantidad'];
    } else {
        $productos_agrupados[$id_producto] = [
            'nombre' => $tienda->obtenerNombreProducto($id_producto),
            'precio' => $producto['precio'],
            'cantidad' => $producto['cantidad']
        ];
    }
}
?>
<div>
    <h1> CARRITO DE COMPRA</h1>
    <?php if (empty($productos)) : ?>
        <p><?php echo $mensaje; ?></p>
    <?php else : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos_agrupados as $producto) : ?>
                    <tr>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo $producto['precio']; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td><i class="fas fa-trash-alt"></i></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="precio-total">Precio total: <?php echo $precio_total; ?> euros.</p>
    <?php endif; ?>
</div>