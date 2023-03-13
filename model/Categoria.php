<?php

class Categoria
{

    private $id_categoria;
    private $nombre;
    private array $productos = array();
    private $conection;

    public function __construct($id_categoria, $nombre)
    {
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
        $this->getProductos($this->id_categoria);
    }

    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getProductos($id_categoria)
    {
    }
}
