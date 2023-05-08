<?php
$tienda = new Tienda();
$productos = $dataToView['productos'];
$precio_total = $dataToView['precio_total'];
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
                    <!--                 
                        <th>Subtotal</th>
                    -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) : ?>
                    <tr>
                        <td><?php echo $tienda->obtenerNombreProducto($producto['id_producto']); ?></td>
                        <td><?php echo $producto['precio']; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="precio-total">Precio total: <?php echo $precio_total; ?> euros.</p>
    <?php endif; ?>


</div>