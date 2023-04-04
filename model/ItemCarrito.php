<?php

class ItemCarrito
{
    private $id_item_carrito;
    private $id_carrito;
    private $id_producto;
    private $cantidad;
    private $precio_unitario;

    public function __construct($id_item_carrito, $id_carrito, $id_producto, $cantidad, $precio_unitario)
    {
        $this->id_item_carrito = $id_item_carrito;
        $this->id_carrito = $id_carrito;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio_unitario = $precio_unitario;
    }

    public function getIdItemCarrito()
    {
        return $this->id_item_carrito;
    }

    public function getIdCarrito()
    {
        return $this->id_carrito;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getPrecioUnitario()
    {
        return $this->precio_unitario;
    }
}
