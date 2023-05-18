<?php

class controlador
{

    public $view;
    public $header;
    private $tienda;

    public function __construct()
    {
        $this->view = 'principal';
        $this->tienda = new Tienda();
    }

    //PÁGINA PRINCIPAL
    public function principal()
    {
        session_start();
        $this->view = 'principal';
        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    //PÁGINA DE UN PRODUCTO INDIVIDUAL
    public function producto_individual()
    {
        session_start();
        $this->view = 'producto_individual';

        $id = $_GET['id_producto'];
        $categorias = $this->tienda->getCategorias();
        $producto = $this->tienda->getProductoId($id);
        $comentarios = $this->tienda->obtenerComentariosPorProducto($id);

        $datos = array(
            'categorias' => $categorias,
            'producto' => $producto,
            'comentarios' => $comentarios,
        );

        return $datos;
    }

    //LOGIN DE USUARIO
    public function logeado()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            if (!empty($usuario) && !empty($password) && $this->tienda->validarUsuario($usuario, $password)) {

                session_start(); // Inicia la sesión
                $_SESSION['usuario'] = $usuario; // Guarda el usuario en la sesión
                $_SESSION['tipo_usuario'] = $this->tienda->getTipoUsuario($usuario); // Guarda el tipo de usuario en la sesión
                header('Location: index.php'); // Redirecciona a la página principal
                exit;
            } else {
                $_SESSION['mensaje_error'] = 'Usuario o contraseña incorrectos';
            }
        }

        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    //LOGOUT DE USUARIO
    public function logout()
    {
        session_start();
        session_destroy();
        setcookie('usuario', '', time() - 3600, '/');
        header('Location: index.php');
    }

    //VISTA DEL CARRITO
    public function carrito()
    {
        session_start();
        $this->view = 'carrito';
        $id_usuario = $this->tienda->obtenerUsuarioPorCorreo($_SESSION['usuario']);

        // Obtener el id del carrito del usuario actual
        $id_carrito = $this->tienda->obtenerIdCarrito($id_usuario);

        $productos = array();
        $precio_total = 0; // Valor predeterminado para el precio total
        $mensaje = ""; // Valor predeterminado para el mensaje


        if (!$id_carrito) {
            // Si no existe un carrito para el usuario actual, mostrar mensaje
            $mensaje = "No hay productos en el carrito.";
        } else {
            // Obtener los productos del carrito y el precio total
            $productos = $this->tienda->obtenerProductosCarrito($id_carrito);
            $precio_total = $this->tienda->calcularPrecioTotalCarrito($id_carrito);
        }

        // Obtener las categorías para el menú
        $categorias = $this->tienda->getCategorias();

        // Crear un array con los datos que se enviarán a la vista
        $datos = array(
            'categorias' => $categorias,
            'productos' => $productos,
            'precio_total' => $precio_total,
            'mensaje' => $mensaje
        );

        return $datos;
    }


    //AGREGAR UN PRODUCTO AL CARRITO
    public function agregarAlCarrito()
    {
        // Obtener el id del usuario actual desde la sesión
        session_start();
        $id_usuario = $this->tienda->obtenerUsuarioPorCorreo($_SESSION['usuario']);
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        // Comprobar si ya existe un carrito para el usuario actual
        $id_carrito = $this->tienda->obtenerIdCarrito($id_usuario);

        if (!$id_carrito) {
            // Si no existe un carrito para el usuario actual, crear uno nuevo
            $precio_total = 0; // El precio total del carrito se inicializa en cero
            $this->tienda->crearCarrito($id_usuario, $precio_total);
            $id_carrito = $this->tienda->obtenerIdCarrito($id_usuario);
        }

        // Obtener los datos del producto que se va a agregar al carrito
        $producto = $this->tienda->getProductoId($id_producto);

        // Agregar el producto al carrito    
        $precio = $producto['precio'];
        $result = $this->tienda->agregarItemAlCarrito($id_carrito, $id_producto, $cantidad, $precio);

        if ($result) {
            // Actualizar el precio total del carrito
            $precio_total = $this->tienda->calcularPrecioTotalCarrito($id_carrito);
            $this->tienda->actualizarPrecioTotalCarrito($id_carrito, $precio_total);
            echo "Producto agregado al carrito correctamente.";
            header("Location: index.php?action=carrito");
        } else {
            echo "Error al agregar el producto al carrito.";
        }

        $this->view = 'carrito';
    }

    //ELIMINAR UN PRODUCTO DEL CARRITO
    public function eliminarProductoCarrito()
    {
        session_start();
        $id_producto = $_GET['id'];
        $id_usuario = $this->tienda->obtenerUsuarioPorCorreo($_SESSION['usuario']);
        $id_carrito = $this->tienda->obtenerIdCarrito($id_usuario);

        // Eliminar el producto del carrito
        $this->tienda->eliminarItemCarrito($id_carrito, $id_producto);

        // Redirigir al usuario al carrito
        header('Location: index.php?action=carrito');
    }

    //VISTA QUE SE MUESTRA AL PINCHAR EN UNA CATEGORIA DEL HEADER
    public function vista_categoria()
    {
        session_start();
        $this->view = 'categoria_header';
        $id_categoria = $_GET['id'];
        $productos = $this->tienda->obtenerProductosPorCategoria($id_categoria);
        $categorias = $this->tienda->getCategorias();
        $categoria_actual = $this->tienda->obtenerCategoria($id_categoria);

        $datos = array(
            'productos' => $productos,
            'categorias' => $categorias,
            'categoria_actual' => $categoria_actual,
        );

        return $datos;
    }

    //GUARDAR COMENTARIO EN UN PRODUCTO
    public function guardarComentario()
    {
        $this->view = 'producto_individual';

        $id_producto = $_POST['id_producto'];

        $categorias = $this->tienda->getCategorias();
        $producto = $this->tienda->getProductoId($id_producto);

        if (isset($_POST['texto']) && !empty($_POST['texto'])) {
            $correo_usuario = $_POST['correo_usuario'];
            $id_usuario = $this->tienda->obtenerUsuarioPorCorreo($correo_usuario);
            $texto = $_POST['texto'];
            $fecha = date('Y-m-d H:i:s');
            $result = $this->tienda->guardarComentario(null, $texto, $fecha, $id_producto, $id_usuario);
            if ($result) {
                // Si se guarda el comentario exitosamente, obtenemos los comentarios del producto actualizado.
                $comentarios = $this->tienda->obtenerComentariosPorProducto($id_producto);
            } else {
                echo "Error al guardar el comentario";
            }
        }

        // Obtenemos los comentarios del producto para mostrarlos en la vista.
        $comentarios = $this->tienda->obtenerComentariosPorProducto($id_producto);

        $datos = array(
            'categorias' => $categorias,
            'producto' => $producto,
            'comentarios' => $comentarios,
            'id_producto' => $id_producto,
        );

        return $datos;
    }

    //REGISTRO
    public function procesar_registro()
    {
        // Obtener los datos del formulario
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];

        // Comprobar si el nombre de usuario ya existe
        if ($this->tienda->existeNombreUsuario($nombre)) {
            // Devolver un mensaje de error en formato JSON
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'El nombre de usuario ya existe'));
            return;
        }

        // Hash de la contraseña
        $hashed_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        // Insertar los datos del usuario en la base de datos
        $this->tienda->registro($correo, $hashed_contraseña, $nombre, $direccion);

        // Devolver un mensaje de éxito en formato JSON
        header('Content-Type: application/json');
        echo json_encode(array('exito' => 'El registro se ha completado con éxito'));
    }


    //COMPROBAR EL NOMBRE DEL USUARIO
    public function comprobar_nombre_usuario()
    {
        if (isset($_GET['nombre'])) {
            $nombreUsuario = $_GET['nombre'];
            // Consulta a la base de datos para verificar si el nombre de usuario existe
            $existe = $this->tienda->existeNombreUsuario($nombreUsuario);
            // Devolver una respuesta en formato JSON con el resultado de la consulta
            header('Content-Type: application/json');
            echo json_encode(array('existe' => $existe));
        } else {
            // Si no se proporciona el nombre de usuario, devolver un error 400 Bad Request
            http_response_code(400);
            echo 'Error: Nombre de usuario no proporcionado';
        }
    }
}