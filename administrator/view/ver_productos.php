<?php
$productos = $dataToView['productos'];
?>

<div class="productos-lista">
    <h2>Lista de productos disponibles</h2>
    <table class="tabla-productos">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><?php echo $producto->getPrecio(); ?></td>
                    <td><?php echo $producto->getCantidad(); ?></td>
                    <td><?php echo $producto->getDescripcion(); ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>