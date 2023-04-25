<?php
$usuarios = $dataToView['usuarios'];
?>

<div class="usuarios-lista">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario->getNombre(); ?></td>
                    <td><?php echo $usuario->getDireccion(); ?></td>
                    <td><?php echo $usuario->getCorreo(); ?></td>
                    <td><?php echo $usuario->getTipo(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>