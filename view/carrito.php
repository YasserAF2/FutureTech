<div>
    <h1> CARRITO DE COMPRA</h1>
    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['carrito'] as $idProducto => $cantidad) {
                    $producto = $tienda->obtenerProducto($idProducto);
                    $subtotal = $producto['precio'] * $cantidad;
                ?>
            <tr>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $cantidad; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $subtotal; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
    <p>El carrito está vacío.</p>
    <?php } ?>

</div>