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
}
