<?php

class Comentarios
{
    private $id_comentarios;
    private $id_producto;
    private $id_usuario;
    private $texto;
    private $fecha;

    public function __construct($id_comentarios, $id_producto, $id_usuario, $texto, $fecha)
    {
        $this->id_comentarios = $id_comentarios;
        $this->id_producto = $id_producto;
        $this->id_usuario = $id_usuario;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }

    public function getIdComentario()
    {
        return $this->id_comentarios;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }
}
