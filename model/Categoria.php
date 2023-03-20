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
        $this->getConection();
        $sql = "SELECT producto.* FROM producto WHERE id_categoria='.$id_categoria.'";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->productos[$i] = new Producto($row['id_producto'], $row['nombre'], $row['descripcion'], $row['precio'], $row['imagen'], $row['cantidad']);
                $i++;
            }
            return $this->productos;
        }
    }
}
