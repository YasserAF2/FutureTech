<?php

class Tienda
{
    private $conection;
    private array $categorias = array();

    function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }

    public function getCategorias()
    {
        $sql = "SELECT * FROM categoria";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->categorias[$i] = new Categoria($row['id_categoria'], $row['nombre']);
                $i++;
            }
        }
        return $this->categorias;
    }

    public function getProductoId($id)
    {
        $sql = "SELECT * FROM producto WHERE id_producto=" . $id . "";
        $resultado = $this->conection->query($sql);

        $producto = mysqli_fetch_assoc($resultado);
        return $producto;
    }

    public function validarUsuario($usuario, $password)
    {
        // Consulta para verificar las credenciales de inicio de sesión
        $sql = "SELECT * FROM usuario WHERE correo = '$usuario' AND contraseña = '$password'";
        $result = $this->conection->query($sql);

        // Verificar si se obtuvo un resultado
        if (mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerProducto($idProducto)
    {
        $sql = "SELECT * FROM producto WHERE id_producto = '$idProducto'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $producto = $result->fetch_assoc();
            return $producto;
        } else {
            return false;
        }
    }

    public function obtenerProductosPorCategoria($id_categoria)
    {
        $sql = "SELECT * FROM producto WHERE id_categoria = '$id_categoria'";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $productos = array();
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            return $productos;
        } else {
            return false;
        }
    }

    public function obtenerCategoria($id_categoria)
    {
        $sql = "SELECT * FROM categoria WHERE id_categoria = '$id_categoria'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $categoria = $result->fetch_assoc();
            return $categoria;
        } else {
            return false;
        }
    }

    /*     public function obtenerCarrito($idUsuario)
    {
        $sql = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario'";
        $result = $this->conection->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    } */
}
