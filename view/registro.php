<main class="mainregistro">
    <div class="container registro">
        <h2>Formulario de registro</h2>
        <form id="registroForm" action="index.php?action=registrohecho" method="POST"
            onsubmit="return validarFormulario()">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre"
                    required>
                <div class="invalid-feedback">Ingrese un nombre válido.</div>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    placeholder="Ingrese su dirección" required>
                <div class="invalid-feedback">Ingrese una dirección válida.</div>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo"
                    placeholder="Ingrese su correo electrónico" required>
                <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena"
                    placeholder="Ingrese su contraseña" required>
                <div class="invalid-feedback">La contraseña debe tener al menos 6 caracteres.</div>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</main>