<!DOCTYPE html>

<head>
    <title>FutureTech - Tu tienda de tecnología</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="view/css/index.css">

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/abdf042606.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <a href="index.php">
        <h1>FUTURE TECH</h1>
    </a>
    <p>juanperez@gmail.com</p>
    <div class="header">
        <?php
        session_start();

        if (isset($_SESSION['usuario'])) { ?>
            <p>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</p>
            <a href="index.php?action=carrito">
                <i class="fas fa-shopping-cart"></i> Carrito de la compra
            </a>

            <a href="index.php?action=logout">Cerrar sesión</a>
        <?php } else { ?>
            <form method="post" action="index.php?action=logeado">
                <label for="username">Usuario:</label>
                <input type="text" name="username" required>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" required>
                <label for="recordar">Recordarme</label>
                <input type="checkbox" id="recordar" name="recordar">
                <input type="submit" value="Iniciar sesión">
            </form>
        <?php } ?>
    </div>

    <nav>
        <ul class="list-unstyled d-flex">
            <?php
            $categorias = $dataToView['categorias'];
            foreach ($categorias as $categoria) {
                $id = $categoria->getIdCategoria();
            ?>
                <li class="flex-row"><a href="categoria.php?id=<?php echo $id; ?>"><?php echo $categoria->getNombre(); ?></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>