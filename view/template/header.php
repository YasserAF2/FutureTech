<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>INICIO</h1>
    <nav>
        <ul>
            <?php
            $tienda = new Tienda();

            $tienda->getCategorias();
            ?>
        </ul>
    </nav>