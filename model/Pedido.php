<?php

class Pedido
{
    private $id_pedido;
    private $id_usuario;
    private $fecha;
    private $precio_total;

    public function __construct($id_pedido, $id_usuario, $fecha, $precio_total)
    {
        $this->id_pedido = $id_pedido;
        $this->id_usuario = $id_usuario;
        $this->fecha = $fecha;
        $this->precio_total = $precio_total;
    }

    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getPrecioTotal()
    {
        return $this->precio_total;
    }
}
