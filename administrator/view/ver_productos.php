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
                        <form action="index.php?action=editar_producto" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $producto->getIdProducto(); ?>" />
                            <input type="hidden" name="nombre" value="<?php echo $producto->getNombre(); ?>" />
                            <input type="hidden" name="precio" value="<?php echo $producto->getPrecio(); ?>" />
                            <input type="hidden" name="cantidad" value="<?php echo $producto->getCantidad(); ?>" />
                            <input type="hidden" name="oferta" value="<?php echo $producto->getOferta(); ?>" />
                            <input type="hidden" name="porcentaje_oferta" value="<?php echo $producto->getPorcentajeOferta(); ?>" />
                            <input type="hidden" name="destacado" value="<?php echo $producto->getDestacado(); ?>" />
                            <input type="hidden" name="descripcion" value="<?php echo $producto->getDescripcion(); ?>" />
                            <input type="hidden" name="id_categoria" value="<?php echo $producto->getIdCategoria(); ?>" />
                            <button type="submit" class="btn btn-link">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </form>
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