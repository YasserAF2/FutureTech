<div>
    <h1> CARRITO DE COMPRA</h1>
    <?php
    if (isset($mensaje)) {
        echo $mensaje;
    } else {
    ?>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) { ?>
            <tr>
                <td><?php echo $producto['nombre_producto']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td><?php echo $producto['subtotal']; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Precio total:</td>
                <td><?php echo $precio_total; ?></td>
            </tr>
        </tbody>
    </table>
    <?php } ?>
</div>