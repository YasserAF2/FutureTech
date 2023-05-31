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

    //Conexión
    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }

    //obtener todas las categorias
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

    //obtener todos los usuarios
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

    //obtener todos los productos
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

    /* Te devuelve un producto por el id_producto */
    public function getProductoId($id)
    {
        $sql = "SELECT * FROM producto WHERE id_producto=" . $id . "";
        $resultado = $this->conection->query($sql);

        $producto = mysqli_fetch_assoc($resultado);
        return $producto;
    }

    //validar el usuario
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

    /* obtener el tipo (cliente o admin) de usuario mediante el email */
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

    //obtener todos los productos por el id_producto
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

    //Obtener todos los productos de una categoria
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

    //Obtener categoria por el id de categoria
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

    /* devuelve el id del usuario consultando el correo */
    public function obtenerUsuarioPorCorreo($email)
    {
        $sql = "SELECT id_usuario FROM usuario WHERE correo = '$email'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $id_usuario = $result->fetch_assoc()['id_usuario'];
            return $id_usuario;
        } else {
            return false;
        }
    }

    //Obtener el nombre del usuario por el id_usuario
    public function obtenerNombreUser($id_usuario)
    {
        $sql = "SELECT nombre FROM usuario WHERE id_usuario = '$id_usuario'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $nombre = $result->fetch_assoc()['nombre'];
            return $nombre;
        } else {
            return false;
        }
    }

    /* DEVUELVE TODOS LOS COMENTARIOS */
    public function getComentarios()
    {
        $sql = "SELECT * FROM comentarios";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->comentarios[$i] = new Comentarios($row['id_comentarios'], $row['id_producto'], $row['id_usuario'], $row['texto'], $row['fecha']);
                $i++;
            }
        }
        return $this->comentarios;
    }

    //Obtener los comentarios de un producto por el id_producto
    public function obtenerComentariosPorProducto($id_producto)
    {
        $sql = "SELECT * FROM comentarios WHERE id_producto = '$id_producto' ORDER BY fecha DESC";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->comentarios[$i] = new Comentarios($row['id_comentarios'], $row['id_producto'], $row['id_usuario'], $row['texto'], $row['fecha']);
                $i++;
            }
        }
        return $this->comentarios;
    }

    /* GUARDAR COMENTARIO EN BD */
    public function guardarComentario($id_comentarios, $texto, $fecha, $id_producto, $id_usuario)
    {
        $this->getConection();
        $sql = "INSERT INTO comentarios (id_comentarios, texto, fecha, id_producto, id_usuario) VALUES ('$id_comentarios', '$texto', '$fecha', '$id_producto', '$id_usuario')";

        if ($this->conection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Obtener el id del carrito por el id_usuario
    public function obtenerIdCarrito($id_usuario)
    {
        $this->getConection();
        $sql = "SELECT id_carrito FROM carrito WHERE id_usuario = '$id_usuario'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $id_carrito = $result->fetch_assoc()['id_carrito'];
            return $id_carrito;
        } else {
            return false;
        }
    }

    //Crear un carrito para un usuario
    public function crearCarrito($id_usuario, $precio_total)
    {
        $this->getConection();
        $sql = "INSERT INTO carrito (id_carrito, precio_total, id_usuario) VALUES (null, '$precio_total', $id_usuario)";

        if ($this->conection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Calcular el precio del carrito
    public function calcularPrecioTotalCarrito($id_carrito)
    {
        $this->getConection();
        $sql = "SELECT SUM(cantidad * precio) AS precio_total FROM item_carrito WHERE id_carrito = $id_carrito";

        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['precio_total'];
        } else {
            return 0;
        }
    }

    //Agregar items al carrito
    public function agregarItemAlCarrito($id_carrito, $id_producto, $cantidad, $precio)
    {
        $this->getConection();
        $sql = "INSERT INTO item_carrito (id_carrito, id_producto, cantidad, precio) VALUES ($id_carrito, $id_producto, $cantidad, $precio)";

        if ($this->conection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Obtener los productos de un carrito
    public function obtenerProductosCarrito($id_carrito)
    {
        $this->getConection();
        $sql = "SELECT * FROM item_carrito WHERE id_carrito = $id_carrito";
        $result = $this->conection->query($sql);

        $productos = array();
        while ($row = $result->fetch_assoc()) {
            $producto = array(
                'id_item_carrito' => $row['id_item_carrito'],
                'cantidad' => $row['cantidad'],
                'precio' => $row['precio'],
                'id_carrito' => $row['id_carrito'],
                'id_producto' => $row['id_producto']
            );
            $productos[] = $producto;
        }
        return $productos;
    }

    //Eliminar item del carrito de BD
    public function eliminarItemCarrito($id_carrito, $id_producto)
    {
        $this->getConection();
        $sql = "DELETE FROM item_carrito WHERE id_carrito = $id_carrito AND id_producto = $id_producto";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
    }

    //Actualizar el precio del carrito
    public function actualizarPrecioTotalCarrito($id_carrito, $precio_total)
    {
        $this->getConection();
        $sql = "UPDATE carrito SET precio_total = $precio_total WHERE id_carrito = $id_carrito";

        if ($this->conection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Obtener el nombre del producto por el id_producto
    public function obtenerNombreProducto($id_producto)
    {
        $this->getConection();
        $sql = "SELECT nombre FROM producto WHERE id_producto = '$id_producto'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $nombre = $result->fetch_assoc()['nombre'];
            return $nombre;
        } else {
            return false;
        }
    }

    //Obtener la imagen de un producto por el id_producto
    public function obtenerImagenProducto($id_producto)
    {
        $this->getConection();
        $sql = "SELECT imagen FROM producto WHERE id_producto = '$id_producto'";
        $result = $this->conection->query($sql);

        if ($result->num_rows == 1) {
            $imagen = $result->fetch_assoc()['imagen'];
            return $imagen;
        } else {
            return false;
        }
    }

    //registrar un usuario
    public function registro($nombre, $direccion, $correo, $contraseña)
    {
        // Insertar los datos del usuario en la base de datos
        $this->getConection();
        $sql = "INSERT INTO usuario (nombre, direccion, correo, contraseña) VALUES ('$nombre', '$direccion', '$correo', '$contraseña')";

        if ($this->conection->query($sql) === TRUE) {
        } else {
        }
    }

    // editar usuario de la vista de administrador
    public function editarUsuario($id_usuario, $nombre, $direccion, $correo, $tipo)
    {
        $this->getConection();

        $nombre = $this->conection->real_escape_string($nombre);
        $direccion = $this->conection->real_escape_string($direccion);
        $correo = $this->conection->real_escape_string($correo);
        $tipo = $this->conection->real_escape_string($tipo);

        $sql = "UPDATE usuario SET nombre = '$nombre', direccion = '$direccion', correo = '$correo', tipo = '$tipo' WHERE id_usuario = $id_usuario";

        if ($this->conection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // borrar usuario de la vista de administrador
    public function borrarUsuario($id_usuario)
    {
        $this->getConection();
        $sql = "DELETE FROM usuario WHERE id_usuario= $id_usuario";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
    }

    //Borrar comentario de la vista de administrador
    public function borrarComentario($id_comentario)
    {
        $this->getConection();
        $sql = "DELETE FROM comentarios WHERE id_comentarios= $id_comentario";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
    }

    //Borrar comentario de la vista de producto
    public function borrarProducto($id_producto)
    {
        $this->getConection();
        $sql = "DELETE FROM producto WHERE id_producto= $id_producto";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
    }

    //subconsulta del número de comentarios
    public function obtenerProductosConComentarios()
    {
        $this->getConection();

        $sql = "SELECT p.id_producto, p.nombre, (
            SELECT COUNT(*) FROM comentarios WHERE id_producto = p.id_producto
        ) AS total_comentarios
        FROM producto p";
        $result = $this->conection->query($sql);

        if ($result->num_rows > 0) {
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            return $productos;
        } else {
            return false;
        }
    }

    //CREAR PEDIDO
    public function crearPedido($fecha, $precio_total, $id_usuario)
    {
        $this->getConection();
        $sql = "INSERT INTO pedido (fecha, precio_total, id_usuario) VALUES ('$fecha', $precio_total, $id_usuario)";

        if ($this->conection->query($sql) === TRUE) {
            // Devuelve el ID del pedido recién insertado
            return $this->conection->insert_id;
        } else {
            return false;
        }
    }

    //CREAR ITEM DE PEDIDO
    public function crearItemPedido($id_pedido, $id_producto, $cantidad, $precio)
    {
        $this->getConection();
        $sql = "INSERT INTO item_pedido (id_pedido, id_producto, cantidad, precio) VALUES ($id_pedido, $id_producto, $cantidad, $precio)";

        if ($this->conection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Vaciar el carrito
    public function vaciarCarrito($id_carrito)
    {
        $this->getConection();
        $sql = "DELETE FROM item_carrito WHERE id_carrito = $id_carrito";

        if ($this->conection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
