<?php
$comentarios = $dataToView['comentarios'];
?>

<div class="usuarios-lista">
    <h2>Lista y administración de los comentarios.</h2>
    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>Comentario</th>
                <th>Fecha</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comentarios as $comentario) : ?>
            <tr>
                <td><?php echo $comentario->getTexto(); ?></td>
                <td><?php echo $comentario->getFecha(); ?></td>
                <td>
                    <button type="button" class="brr btn btn-link"
                        onclick="confirmarBorradoComentario(<?php echo $comentario->getIdComentario(); ?>)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>