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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <a href="index.php">
        <h1>FUTURE TECH</h1>
    </a>
    <p>juanperez@gmail.com</p>
    <?php
    if (isset($_SESSION['username'])) {
        echo "<p>Bienvenido " . $_SESSION['username'] . "!</p>";
    } else {
    ?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Login
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <form action="index.php?action=logeado" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    <?php
    }
    ?>



    <nav>
        <ul class="list-unstyled d-flex">
            <?php
            $categorias = $dataToView['categorias'];
            foreach ($categorias as $categoria) {
                $id = $categoria->getIdCategoria();
            ?>
            <li class="flex-row"><a
                    href="categoria.php?id=<?php echo $id; ?>"><?php echo $categoria->getNombre(); ?></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>