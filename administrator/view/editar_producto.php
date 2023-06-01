<?php
include 'view/template/header.php';
$id_producto = $dataToView['id_producto'];
$nombre = $dataToView['nombre'];
$precio = $dataToView['precio'];
$cantidad = $dataToView['cantidad'];
$oferta = $_POST['oferta'];
$porcentaje_oferta = $_POST['porcentaje_oferta'];
$destacado = $_POST['destacado'];
$descripcion = $dataToView['descripcion'];
$id_categoria = $dataToView['id_categoria'];

?>
<main>
    <section class="formularioEditar">
        <article class="container mt-2 mb-2">
            <h2 class="mt-4 text-center">Editar Producto</h2>
            <form action="index.php?action=guardar_producto" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="oferta">Oferta:</label>
                    <div class="form-check">
                        <input type="radio" id="oferta" name="oferta" value="1" class="form-check-input" <?php if ($oferta == 1) echo " checked"; ?>> En oferta
                    </div>
                    <div class="form-check">
                        <input type="radio" id="oferta" name="oferta" value="0" class="form-check-input" <?php if ($oferta == 0) echo " checked"; ?>> Sin oferta
                    </div>
                </div>

                <div class="form-group">
                    <label for="porcentaje_oferta">Porcentaje de Oferta:</label>
                    <input type="number" id="porcentaje_oferta" name="porcentaje_oferta" value="<?php echo $porcentaje_oferta; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="destacado">Destacado:</label>
                    <div class="form-check">
                        <input type="radio" id="destacado" name="destacado" value="1" class="form-check-input" <?php if ($destacado == 1) echo " checked"; ?>>
                        Destacado
                    </div>
                    <div class="form-check">
                        <input type="radio" id="destacado" name="destacado" value="0" class="form-check-input" <?php if ($destacado == 0) echo " checked"; ?>> Sin destacar
                    </div>
                </div>


                <div class="form-group">
                    <label for="id_categoria">Categoría:</label>
                    <select id="id_categoria" name="id_categoria" class="form-control">
                        <option value="1" <?php if ($id_categoria == 1) echo "selected"; ?>>Sobremesa</option>
                        <option value="2" <?php if ($id_categoria == 2) echo "selected"; ?>>Portátiles</option>
                        <option value="3" <?php if ($id_categoria == 3) echo "selected"; ?>>Móviles</option>
                        <option value="4" <?php if ($id_categoria == 4) echo "selected"; ?>>Periféricos</option>
                        <option value="5" <?php if ($id_categoria == 5) echo "selected"; ?>>Hardware</option>
                        <option value="6" <?php if ($id_categoria == 6) echo "selected"; ?>>Cámaras</option>
                    </select>
                </div>

                <div>
                    <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver atrás</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </article>
    </section>
</main>
<?php
include 'view/template/footer.php';
?>