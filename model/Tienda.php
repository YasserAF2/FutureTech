<?php

class Tienda
{
    private $conection;
    private array $categorias = array();
    private array $usuarios = array();
    private array $productos = array();
    private array $comentarios = array();

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

    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuario";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->usuarios[$i] = new Usuario($row['id_usuario'], $row['nombre'], $row['direccion'], $row['correo'], $row['tipo'], $row['contraseña']);
                $i++;
            }
        }
        return $this->usuarios;
    }

    public function getProductos()
    {
        $sql = "SELECT * FROM producto";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->productos[$i] = new Producto($row['id_producto'], $row['nombre'], $row['descripcion'], $row['precio'], $row['imagen'], $row['cantidad'], $row['oferta'], $row['porcentaje_oferta'], $row['destacado'], $row['id_categoria']);
                $i++;
            }
        }
        return $this->productos;
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

    public function getTipoUsuario($email)
    {
        $sql = "SELECT tipo FROM usuario WHERE correo = '$email'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $tipoUsuario = $result->fetch_assoc()['tipo'];
            return $tipoUsuario;
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

    /* COMENTARIO DE UN PRODUCTO, DEVUELVE LOS COMENTARIOS */
    public function getComentarios()
    {
        $sql = "SELECT * FROM comentarios";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->comentarios[$i] = new Comentarios($row['id_comentario'], $row['id_producto'], $row['id_usuario'], $row['texto'], $row['fecha']);
                $i++;
            }
        }
        return $this->comentarios;
    }
}
