<!DOCTYPE html>

<head>
    <title>FutureTech - Tu tienda de tecnología</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/abdf042606.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <h1>FUTURE TECH</h1>
    <nav>
        <ul>
            <?php
            $categorias = $dataToView['categorias'];
            foreach ($categorias as $categoria) {
            ?>
            <li><a href="#"><?php echo $categoria->getNombre(); ?></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>