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
    <div class="container">
        <div>
            <div>
                <img src="img/nombre_imagen.jpg" alt="IMAGEN DEL PRODUCTO" class="img-fluid">
            </div>
            <div>
                <h1><?php echo $producto['nombre'] ?></h1>
                <p class="lead"><?php echo $producto['descripcion'] ?></p>
                <hr>
                <h4 class="mb-3">Detalles del producto:</h4>
                <ul>
                    <li><strong>Precio:</strong> <?php echo $producto['precio'] ?> €</li>
                    <li><strong>Disponibilidad:</strong> <?php echo $producto['cantidad'] ?></li>
                    <li><strong>Categoría:</strong> Nombre de la categoría</li>
                </ul>
                <form action="index.php?action=agregarAlCarrito" method="POST">
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" max="<?php echo $producto['cantidad'] ?>">
                        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id_producto ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                </form>
            </div>
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
                <?php foreach ($comentarios as $comentario) : ?>
                    <div class="comentario">
                        <p><?php echo $tienda->obtenerNombreUser($comentario->getIdUsuario()); ?></p>
                        <p class="fecha"><?php echo $comentario->getFecha(); ?></p>
                        <p class="usuario"><?php echo $comentario->getTexto(); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</main>