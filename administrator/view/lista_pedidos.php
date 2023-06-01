<?php
$pedidos = $dataToView['pedidos'];
?>

<div class="pedidos-lista">
    <h2>Lista y administración de pedidos.</h2>
    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Precio Total</th>
                <th>Nombre Usuario</th>
                <th>Correo Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido) : ?>
                <tr>
                    <td><?php echo $pedido['fecha']; ?></td>
                    <td><?php echo $pedido['precio_total']; ?></td>
                    <td><?php echo $pedido['nombre']; ?></td>
                    <td><?php echo $pedido['correo']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>