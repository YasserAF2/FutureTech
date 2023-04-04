<?php
class Carrito
{
    private $id_carrito;
    private $precio_total;
    private $id_usuario;

    public function __construct($id_carrito, $precio_total, $id_usuario)
    {
        $this->id_carrito = $id_carrito;
        $this->precio_total = $precio_total;
        $this->id_usuario = $id_usuario;
    }

    public function getIdCarrito()
    {
        return $this->id_carrito;
    }

    public function getPrecioTotal()
    {
        return $this->precio_total;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }
}
