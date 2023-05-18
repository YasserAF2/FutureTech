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
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario->getNombre(); ?></td>
                    <td><?php echo $usuario->getDireccion(); ?></td>
                    <td><?php echo $usuario->getCorreo(); ?></td>
                    <td><?php echo $usuario->getTipo(); ?></td>
                    <td><i class="fas fa-pencil-alt"></i></td>
                    <td><i class="fas fa-trash"></i></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>