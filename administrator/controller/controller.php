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

    public function cerrar_sesion()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../index.php');
    }
}
