<?php

class controlador
{

    public $view;
    public $header;

    public function __construct()
    {
        $this->view = 'principal';
    }

    public function principal()
    {
        $this->view = 'principal';

        $tienda = new Tienda();
        $categorias = $tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    public function producto_individual()
    {
        $this->view = 'producto_individual';

        $id = $_GET['id_producto'];
        $tienda = new Tienda();
        $categorias = $tienda->getCategorias();
        $producto = $tienda->getProductoId($id);

        $datos = array(
            'categorias' => $categorias,
            'producto' => $producto,
        );

        return $datos;
    }
}
