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

    // LOGIN DE USUARIO
    public function logeado()
    {
        $mensajeError = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            if (!empty($usuario) && !empty($password)) {
                echo "Entrando en la condición de no vacío<br>"; // Mensaje de depuración

                // Obtener la contraseña encriptada asociada al usuario
                $contrasenaEncriptada = $this->tienda->getContrasenaEncriptada($usuario);

                if ($contrasenaEncriptada) {
                    echo "Contraseña encriptada obtenida: $contrasenaEncriptada<br>"; // Mensaje de depuración
                    echo $password;

                    // Comparar las contraseñas encriptadas
                    if (password_verify($password, $contrasenaEncriptada)) {
                        echo "Contraseña verificada correctamente<br>"; // Mensaje de depuración

                        session_start(); // Iniciar la sesión
                        $_SESSION['usuario'] = $usuario; // Guardar el usuario en la sesión
                        $_SESSION['tipo_usuario'] = $this->tienda->getTipoUsuario($usuario); // Guardar el tipo de usuario en la sesión
                        header('Location: index.php'); // Redireccionar a la página principal
                        exit;
                    } else {
                        $mensajeError = 'Usuario o contraseña incorrectos';
                    }
                } else {
                    echo "No se pudo obtener la contraseña encriptada<br>"; // Mensaje de depuración

                    $mensajeError = 'Usuario no encontrado';
                }
            } else {
                $mensajeError = 'Por favor, completa todos los campos';
            }
        }

        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
            'mensaje_error' => $mensajeError // Agregar el mensaje de error al arreglo de datos
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

    //Vista form registro
    public function registro()
    {
        $this->view = 'registro';
        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    //Realizar el registro
    public function registrohecho()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Capturar los valores del formulario
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];

            // Encriptar la contraseña
            $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);

            // Insertar los datos del usuario en la base de datos
            $this->tienda->registro($nombre, $direccion, $correo, $contrasenaEncriptada);

            // Después de procesar los datos y realizar el registro
            $this->view = 'registro_exitoso';
        }

        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    public function compra()
    {
        $precio_total = $_POST['precio_total'];
        $correo = $_POST['correo'];
        $id_usuario = $this->tienda->obtenerUsuarioPorCorreo($correo);

        // Verificar si se encontró el usuario por correo
        if ($id_usuario) {
            // Obtener la fecha actual
            $fecha = date('Y-m-d', strtotime('now'));

            // Realizar la lógica para crear el pedido en la base de datos utilizando el precio total, la fecha, el ID del usuario

            // 1. Crear el pedido
            $id_pedido = $this->tienda->crearPedido($fecha, $precio_total, $id_usuario);

            // 2. Obtener los productos del carrito desde la base de datos (o desde la sesión, dependiendo de tu implementación)
            $id_carrito = $this->tienda->obtenerIdCarrito($id_usuario);
            $productos = $this->tienda->obtenerProductosCarrito($id_carrito);

            // 3. Recorrer los productos y crear los registros correspondientes en la tabla "item_pedido"
            foreach ($productos as $producto) {
                $id_producto = $producto['id_producto'];
                $cantidad = $producto['cantidad'];
                $precio = $producto['precio'];
                $this->tienda->crearItemPedido($id_pedido, $id_producto, $cantidad, $precio);
            }

            // 4. Vaciar el carrito
            $this->tienda->vaciarCarrito($id_carrito);

            // 5. Cambiar vista
            $this->view = 'pedido_hecho';
        }

        $categorias = $this->tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }
}
