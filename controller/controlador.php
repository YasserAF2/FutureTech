<?php

class controlador
{

    public $view;
    public $header;

    public function __construct()
    {
        $this->view = 'principal';
    }

    public function principal()
    {
        $this->view = 'principal';

        $tienda = new Tienda();
        $categorias = $tienda->getCategorias();

        $datos = array(
            'categorias' => $categorias,
        );

        return $datos;
    }

    public function producto_individual()
    {
        $this->view = 'producto_individual';

        $id = $_GET['id_producto'];
        $tienda = new Tienda();
        $categorias = $tienda->getCategorias();
        $producto = $tienda->getProductoId($id);

        $datos = array(
            'categorias' => $categorias,
            'producto' => $producto,
        );

        return $datos;
    }

    public function logeado()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
            $password = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

            if ($this->validarUsuario($usuario, $password)) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $this->view = 'principal';
                header('Location: index.php?action=' . $this->view);
                exit;
            } else {
                $_SESSION['mensaje_error'] = 'Usuario o contraseña incorrectos';
                $this->view = 'principal';
            }
        }
    }

    private function validarUsuario($usuario, $password)
    {
        // Conexión a la base de datos
        $db = mysqli_connect("localhost", "root", "", "tienda");

        // Verificar si hay error en la conexión
        if (mysqli_connect_errno()) {
            printf("Error de conexión a la base de datos: %s\n", mysqli_connect_error());
            exit();
        }

        // Consulta para verificar las credenciales de inicio de sesión
        $sql = "SELECT * FROM usuario WHERE correo = '$usuario' AND contraseña = '$password'";
        $result = mysqli_query($db, $sql);

        // Verificar si se obtuvo un resultado
        if (mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($db);
    }
}
