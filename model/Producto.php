<?php

class Producto
{
    private $id_producto;
    private $nombre;
    private $descripcion;
    private $precio;
    private $imagen;
    private $cantidad;
    private $oferta;
    private $id_categoria;

    public function __construct($id_producto, $nombre, $descripcion, $precio, $imagen, $cantidad, $oferta, $id_categoria)
    {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->imagen = $imagen;
        $this->cantidad = $cantidad;
        $this->oferta = $oferta;
        $this->id_categoria = $id_categoria;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }
}
