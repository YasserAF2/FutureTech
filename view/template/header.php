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

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SLICK CARRUSEL -->
    <!--     
    <link rel="stylesheet" type="text/css" href="view/slick/slick.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script> 
    -->

    <!-- JAVASCRIPT -->
    <script type="text/javascript" src="view/js/archivo.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container top">
        <a class="titulo" href="index.php">
            <h1>FUTURE TECH</h1>
        </a>
        <div class="buscador">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar" id="busqueda">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </form>
            <!-- <div id="resultados"></div> -->
        </div>
        <div class="botones">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                <i class="fas fa-user"></i> Login
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">
                <i class="fas fa-user"></i> Registrarse
            </button>
        </div>
    </div>
    <nav>
        <ul class="list-unstyled d-flex">
            <?php
            $categorias = $dataToView['categorias'];
            foreach ($categorias as $categoria) {
                $id = $categoria->getIdCategoria();
            ?>
                <li class="flex-row"><a href="index.php?action=vista_categoria&id=<?php echo $id; ?>"><?php echo $categoria->getNombre(); ?></a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>


    <!-- Modal LOGIN -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <?php
                    //session_start();

                    if (isset($_SESSION['usuario'])) { ?>
                        <p>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</p>
                        <a href="index.php?action=carrito">
                            <i class="fas fa-shopping-cart"></i> Carrito de la compra
                        </a>

                        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'Administrador') {
                            echo "<p>Tipo de usuario: " . $_SESSION['tipo_usuario'] . "</p>";
                            echo "<a href='administrator/index.php'>Ir al panel de administración<i class='fas fa-cog'></i></a><br>";
                        } ?>

                        <a href="index.php?action=logout">Cerrar sesión</a>
                    <?php } else { ?>
                        <form class="form-horizontal" method="post" action="index.php?action=logeado">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Usuario:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Contraseña:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="recordar" name="recordar"> Recordarme
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Registrarse -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Registrarse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form method="POST" action="index.php?action=procesar_registro" novalidate>
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña:</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de usuario:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required onblur="comprobarNombreUsuario()">
                            <small id="mensaje-error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>