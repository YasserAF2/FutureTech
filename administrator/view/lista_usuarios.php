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
                <td>
                    <form action="index.php?action=editar_usuario" method="post">
                        <input type="hidden" name="id_usuario" value="<?php echo $usuario->getIdUsuario(); ?>" />
                        <input type="hidden" name="nombre" value="<?php echo $usuario->getNombre(); ?>" />
                        <input type="hidden" name="direccion" value="<?php echo $usuario->getDireccion(); ?>" />
                        <input type="hidden" name="correo" value="<?php echo $usuario->getCorreo(); ?>" />
                        <input type="hidden" name="tipo" value="<?php echo $usuario->getTipo(); ?>" />
                        <button type="submit" class="btn btn-link">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <button type="button" class="brr btn btn-link"
                        onclick="confirmarBorrado(<?php echo $usuario->getIdUsuario(); ?>)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>