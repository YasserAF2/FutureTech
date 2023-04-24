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

    public function vista_categoria()
    {
        $this->view = 'categoria_header';
        $id_categoria = $_GET['id'];
        $productos = $this->tienda->obtenerProductosPorCategoria($id_categoria);
        $categorias = $this->tienda->getCategorias();
        $categoria_actual = $this->tienda->obtenerCategoria($id_categoria);

        $datos = array(
            'productos' => $productos,
            'categorias' => $categorias,
            'categoria_actual' => $categoria_actual,
        );

        return $datos;
    }

    public function agregarAlCarrito()
    {
    }
}
