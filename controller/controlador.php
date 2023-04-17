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
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
            $password = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

            if ($this->tienda->validarUsuario($usuario, $password)) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $this->view = 'principal';
                header('Location: index.php?action=' . $this->view);
                exit;
            } else {
                $_SESSION['mensaje_error'] = 'Usuario o contraseña incorrectos';
                $this->view = 'principal';
            }
        }
    }
}
