<?php

require_once '../model/db.php';
require_once '../config/config.php';
require_once '../model/Producto.php';
require_once '../model/Categoria.php';
require_once '../model/Carrito.php';
require_once '../model/Comentarios.php';
require_once '../model/ItemCarrito.php';
require_once '../model/ItemPedido.php';
require_once '../model/Pedido.php';
require_once '../model/Usuario.php';
require_once '../model/Tienda.php';
require_once 'controller/controller.php';


if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");


$controlador = new controlador();

$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();


if ($_GET["action"] === 'principal') {
    require_once 'view/template/header.php';
    require_once 'view/' . $controlador->view . '.php';
    require_once 'view/template/footer.php';
} else {
    require_once 'view/' . $controlador->view . '.php';
}
