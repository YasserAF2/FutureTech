<?php
$id_producto = $_GET['id_producto'];
$producto = $dataToView['producto'];
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
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" max="XX">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                </form>
            </div>
        </div>
    </div>
</main>