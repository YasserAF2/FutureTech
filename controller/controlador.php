<?php

class controlador
{

    public $view;
    public $header;
    private $tienda;

    public function __construct()
    {
        $this->view = 'principal';
        $this->tienda = new Tienda();
    }

    public function principal()
    {
        $this->view = 'principal';
        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    public function producto_individual()
    {
        $this->view = 'producto_individual';

        $id = $_GET['id_producto'];
        $categorias = $this->tienda->getCategorias();
        $producto = $this->tienda->getProductoId($id);

        $datos = array(
            'categorias' => $categorias,
            'producto' => $producto,
        );

        return $datos;
    }


    public function logeado()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            if (!empty($usuario) && !empty($password) && $this->tienda->validarUsuario($usuario, $password)) {
                session_start(); // Inicia la sesión
                $_SESSION['usuario'] = $usuario; // Guarda el usuario en la sesión
                header('Location: index.php'); // Redirecciona a la página principal
                exit;
            } else {
                $_SESSION['mensaje_error'] = 'Usuario o contraseña incorrectos';
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        setcookie('usuario', '', time() - 3600, '/');
        header('Location: index.php');
    }

    public function carrito()
    {
        $this->view = 'carrito';
        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    public function agregarAlCarrito()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idProducto = $_POST['idProducto'];
            $cantidad = $_POST['cantidad'];
            $producto = $this->tienda->obtenerProducto($idProducto);

            // Verificar si el carrito existe en la sesión
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = array();
            }

            $carrito = $_SESSION['carrito'];

            // Verificar si el producto ya está en el carrito
            if (array_key_exists($idProducto, $carrito)) {
                $carrito[$idProducto]['cantidad'] += $cantidad;
            } else {
                // Si el producto no está en el carrito, agregarlo
                $carrito[$idProducto] = array(
                    'producto' => $producto,
                    'cantidad' => $cantidad
                );
            }

            $_SESSION['carrito'] = $carrito;

            if (isset($_SESSION['usuario'])) {
                $idUsuario = $_SESSION['usuario']['idUsuario'];

                // Verificar si el carrito existe en la base de datos
                $carritoBD = $this->tienda->obtenerCarrito($idUsuario);

                if (!$carritoBD) {
                    // Si el carrito no existe en la base de datos, crearlo
                    $this->tienda->crearCarrito($idUsuario);
                    $carritoBD = $this->tienda->obtenerCarrito($idUsuario);
                }

                // Verificar si el producto ya está en el carrito de la base de datos
                $productoBD = $this->tienda->obtenerProductoCarrito($carritoBD['idCarrito'], $idProducto);

                if ($productoBD) {
                    // Si el producto ya está en el carrito de la base de datos, actualizar la cantidad
                    $this->tienda->actualizarProductoCarrito($carritoBD['idCarrito'], $idProducto, $cantidad + $productoBD['cantidad']);
                } else {
                    // Si el producto no está en el carrito de la base de datos, agregarlo
                    $this->tienda->agregarProductoCarrito($carritoBD['idCarrito'], $idProducto, $cantidad);
                }
            }

            header('Location: index.php?action=carrito');
            exit;
        }
    }
}
