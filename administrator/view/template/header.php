<!DOCTYPE html>

<head>
    <title>FutureTech - Tu tienda de tecnología</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="view/img/favicon-32x32.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="view/css/index.css">

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/abdf042606.js" crossorigin="anonymous"></script>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JAVASCRIPT -->
    <script src="js/admin.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>



<body>
    <?php session_start(); ?>
    <div class="header">
        <div>
            <img class="logo" src="view/img/FTLOGO.png" alt="Logo">
        </div>
        <div class="user-message">
            <p>Bienvenido, <?php echo $_SESSION['usuario']; ?></p>
            <a href="index.php?action=cerrar_sesion">Cerrar sesión</a>
        </div>
    </div>