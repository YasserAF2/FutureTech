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
    }

    public function lista_usuarios()
    {
        $this->view = 'lista_usuarios';
        $usuarios = $this->tienda->getUsuarios();

        $datos = array(
            'usuarios' => $usuarios,
        );

        return $datos;
    }

    public function ver_productos()
    {
        $this->view = 'ver_productos';
        $productos = $this->tienda->getProductos();

        $datos = array(
            'productos' => $productos,
        );

        return $datos;
    }

    public function cerrar_sesion()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../index.php');
    }

    public function editar_usuario()
    {
        $this->view = "editar_usuario";

        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $tipo = $_POST['tipo'];

        $datos = array(
            'id_usuario' => $id_usuario,
            'nombre' => $nombre,
            'direccion' => $direccion,
            'correo' => $correo,
            'tipo' => $tipo
        );

        return $datos;
    }

    public function guardar_usuario()
    {
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $tipo = $_POST['tipo'];

        $this->tienda->editarUsuario($id_usuario, $nombre, $direccion, $correo, $tipo);

        header('Location: index.php');
    }

    public function borrar_usuario()
    {
        $id_usuario = $_POST['id_usuario'];

        $this->tienda->borrarUsuario($id_usuario);

        header('Location: index.php');
    }

    public function lista_comentarios()
    {
        $this->view = 'lista_comentarios';
        $comentarios = $this->tienda->getComentarios();

        $datos = array(
            'comentarios' => $comentarios,
        );

        return $datos;
    }

    //vista de nº de comentarios por producto
    public function comentarios()
    {
        $this->view = 'comentarios';
        $productosConComentarios = $this->tienda->obtenerProductosConComentarios();

        $datos = array(
            'productos' => $productosConComentarios,
        );

        return $datos;
    }

    public function borrar_comentario()
    {
        $id_comentario = $_POST['id_comentario'];

        $this->tienda->borrarComentario($id_comentario);

        header('Location: index.php');
    }

    public function borrar_producto()
    {
        $id_producto = $_POST['id_producto'];

        $this->tienda->borrarProducto($id_producto);

        header('Location: index.php');
    }
}
