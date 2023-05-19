<?php
include 'view/template/header.php';
$id_usuario = $dataToView['id_usuario'];
$nombre = $dataToView['nombre'];
$direccion = $dataToView['direccion'];
$correo = $dataToView['correo'];
$tipo = $dataToView['tipo'];

?>
<main>
    <section class="formularioEditar">
        <article class="container mt-2 mb-2">
            <h2 class="mt-4">Editar Usuario</h2>
            <form class="f-editar" action="index.php?action=guardar_usuario" method="POST">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />
                <div class="form-group w-50">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" class="form-control" required>
                </div>

                <div class="form-group w-50">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>" class="form-control" required>
                </div>

                <div class="form-group w-50">
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" id="correo" value="<?php echo $correo; ?>" class="form-control" required>
                </div>

                <div class="form-group w-25">
                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo" class="form-control" required>
                        <option value="Administrador" <?php echo ($tipo == 'Administrador') ? 'selected' : ''; ?>>
                            Administrador
                        </option>
                        <option value="Usuario" <?php echo ($tipo == 'Usuario') ? 'selected' : ''; ?>>
                            Usuario
                        </option>
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