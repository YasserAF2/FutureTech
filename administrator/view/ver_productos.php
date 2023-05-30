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
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><?php echo $producto->getPrecio(); ?></td>
                    <td><?php echo $producto->getCantidad(); ?></td>
                    <td><?php echo $producto->getDescripcion(); ?></td>
                    <td>
                        <i class="fas fa-pencil-alt"></i>
                    </td>
                    <td>
                        <button type="button" class="brr btn btn-link" onclick="confirmarBorradoProducto(<?php echo $producto->getIdProducto(); ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>