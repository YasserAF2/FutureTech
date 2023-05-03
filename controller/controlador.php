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

    public function principal()
    {
        $this->view = 'principal';
        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    public function producto_individual()
    {
        $this->view = 'producto_individual';

        $id = $_GET['id_producto'];
        $categorias = $this->tienda->getCategorias();
        $producto = $this->tienda->getProductoId($id);
        $comentarios = $this->tienda->getComentarios();

        $datos = array(
            'categorias' => $categorias,
            'producto' => $producto,
            'comentarios' => $comentarios,
        );

        return $datos;
    }


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
    }

    public function logout()
    {
        session_start();
        session_destroy();
        setcookie('usuario', '', time() - 3600, '/');
        header('Location: index.php');
    }

    public function carrito()
    {
        $this->view = 'carrito';
        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

/*     public function agregarAlCarrito($id_producto, $cantidad)
    {
        // Obtener el id del usuario actual desde la sesión
        session_start();
        $id_usuario = $_SESSION['id_usuario'];

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

        // Calcular el precio total del carrito después de agregar el producto
        $precio_total = $this->tienda->calcularPrecioTotalCarrito($id_carrito);

        // Agregar el producto al carrito
        $result = $this->tienda->agregarProductoAlCarrito($id_carrito, $producto, $cantidad);

        if ($result) {
            echo "Producto agregado al carrito correctamente.";
        } else {
            echo "Error al agregar el producto al carrito.";
        }
    } */

    public function vista_categoria()
    {
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

    public function guardarComentario()
    {
        $this->view = 'producto_individual';

        $id_producto = $_POST['id_producto'];

        $categorias = $this->tienda->getCategorias();
        $producto = $this->tienda->getProductoId($id_producto);
        $comentarios = $this->tienda->getComentarios();

        if (isset($_POST['texto']) && !empty($_POST['texto'])) {
            $correo_usuario = $_POST['correo_usuario'];
            $id_usuario = $this->tienda->obtenerUsuarioPorCorreo($correo_usuario);
            $texto = $_POST['texto'];
            $fecha = date('Y-m-d H:i:s');
            $result = $this->tienda->guardarComentario(null, $texto, $fecha, $id_producto, $id_usuario);
            if ($result) {
                $comentarios = $this->tienda->getComentarios();
            } else {
                echo "Error al guardar el comentario";
            }
        }


        $datos = array(
            'categorias' => $categorias,
            'producto' => $producto,
            'comentarios' => $comentarios,
            'id_producto' => $id_producto,
        );

        return $datos;
    }
}