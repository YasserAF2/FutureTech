<?php

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];
} else {
    $id_producto = $dataToView['id_producto'];
}

$producto = $dataToView['producto'];
$comentarios = $dataToView['comentarios'];
$tienda = new Tienda();

?>
<main>
    <div class="container cm">
        <div class="row p-individual">
            <div id="img-container" class="img-p col-md-5">
                <img id="imagenPI" class="img-p-individual" src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']) ?>" alt="IMAGEN DEL PRODUCTO" data-toggle="modal" data-target="#imagenModal">
            </div>
            <div class="col-md-6">
                <h1><?php echo $producto['nombre'] ?></h1>
                <hr>
                <p class="lead"><?php echo $producto['descripcion'] ?></p>
                <ul>
                    <li>Precio: <?php echo $producto['precio'] ?> €</li>
                    <li>
                        <?php if ($producto['cantidad'] <= 0) : ?>
                            <i class="text-danger fas fa-times"></i> Sin stock
                        <?php else : ?>
                            <i class="text-success fas fa-check"></i> En stock
                        <?php endif; ?>
                    </li>
                </ul>
                <form action="index.php?action=agregarAlCarrito" method="POST">
                    <div class="form-group">
                        <div class="cantidadpi">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="w-25 form-control" value="1" min="1" max="<?php echo $producto['cantidad'] ?>">
                        </div>
                        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id_producto ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'] ?>">
                    </div>
                    <?php if ($producto['cantidad'] <= 0 || !isset($_SESSION['usuario'])) : ?>
                        <button type="submit" class="btn btn-primary bt-sesion" disabled title="Inicia sesión para añadir productos a tu carrito personal">Agregar al carrito</button>
                        <?php if (!isset($_SESSION['usuario'])) : ?>
                            <br>
                            <p class="piniciar">Inicia sesión para añadir productos a tu carrito personal</p>
                        <?php endif; ?>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="lupa mb-2 ml-2">
            <p><i class="fas fa-search"></i> Haz click con el ratón en la imagen para ampliarla.</p>
        </div>
        <div class="comentarios">
            <h3>Déjanos un comentario</h3>
            <form action="index.php?action=guardarComentario" method="POST" class="comentarios-form">
                <textarea name="texto" class="comentarios-textarea" placeholder="Escribe aquí tu comentario"></textarea>
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <?php
                if (isset($_SESSION['usuario'])) {
                ?>
                    <input type="hidden" name="correo_usuario" value="<?php echo $_SESSION['usuario']; ?>">
                <?php } ?>
                <input type="submit" class="comentarios-boton" value="Enviar comentario">
            </form>
            <h3>Comentarios</h3>
            <div>
                <?php if (empty($comentarios)) : ?>
                    <p>No hay comentarios.</p>
                <?php else : ?>
                    <?php foreach ($comentarios as $comentario) : ?>
                        <div class="comentario">
                            <p><?php echo $tienda->obtenerNombreUser($comentario->getIdUsuario()); ?></p>
                            <p class="fecha"><?php echo $comentario->getFecha(); ?></p>
                            <p class="usuario"><?php echo $comentario->getTexto(); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagenModalLabel"><?php echo $producto['nombre'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']) ?>" alt="IMAGEN DEL PRODUCTO" class="img-fluid imagen-grande">
            </div>
        </div>
    </div>
</div>