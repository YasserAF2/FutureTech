<?php
$usuarios = $dataToView['usuarios'];
?>

<div class="usuarios-lista">
    <h2>Lista y administración de los usuarios.</h2>
    <table class="tabla-usuarios">
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