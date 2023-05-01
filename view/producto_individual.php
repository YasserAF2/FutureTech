<?php
$id_producto = $_GET['id_producto'];
$producto = $dataToView['producto'];
$comentarios = $dataToView['comentarios'];
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
                        <input type="hidden" name="idProducto" id="idProducto" value="<?php echo $_GET['id_producto'] ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                </form>
            </div>
        </div>
        <div class="comentarios">
            <h3>Comentarios</h3>
            <h3>Déjanos un comentario</h3>
            <form action="index.php?action=guardarComentario" method="POST" class="comentarios-form">
                <textarea class="comentarios-textarea" placeholder="Escribe aquí tu comentario"></textarea>
                <input type="submit" class="comentarios-boton" value="Enviar comentario">
            </form>
            <!--             <?php foreach ($comentarios as $comentario) : ?>
                <div class="comentario">
                    <p class="nombre"><?php echo $comentario['nombre']; ?></p>
                    <p class="fecha"><?php echo $comentario['fecha']; ?></p>
                    <p class="mensaje"><?php echo $comentario['mensaje']; ?></p>
                </div>
            <?php endforeach; ?> -->
        </div>

    </div>
</main>