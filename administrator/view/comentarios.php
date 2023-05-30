<?php
$productos = $dataToView['productos'];
?>
<div class="productos-lista">
    <h2>Nº de comentarios por producto.</h2>
    <table class="tabla-productos">
        <thead>
            <tr>
                <th>ID producto</th>
                <th>Nombre</th>
                <th>Nº de comentarios</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?php echo $producto['id_producto']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['total_comentarios']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>