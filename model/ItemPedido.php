<?php

class ItemPedido
{
    private $id_item_pedido;
    private $id_pedido;
    private $id_producto;
    private $cantidad;
    private $precio_unitario;

    public function __construct($id_item_pedido, $id_pedido, $id_producto, $cantidad, $precio_unitario)
    {
        $this->id_item_pedido = $id_item_pedido;
        $this->id_pedido = $id_pedido;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio_unitario = $precio_unitario;
    }

    public function getIdItemPedido()
    {
        return $this->id_item_pedido;
    }

    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getItemCantidad()
    {
        return $this->cantidad;
    }

    public function getPrecioUnitario()
    {
        return $this->precio_unitario;
    }
}