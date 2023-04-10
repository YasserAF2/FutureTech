<?php

require_once 'model/db.php';
require_once 'config/config.php';
require_once 'model/Producto.php';
require_once 'model/Categoria.php';
require_once 'model/Carrito.php';
require_once 'model/Comentarios.php';
require_once 'model/ItemCarrito.php';
require_once 'model/ItemPedido.php';
require_once 'model/Pedido.php';
require_once 'model/Usuario.php';
require_once 'model/Tienda.php';
require_once 'controller/controlador.php';

/* Bienvenido a FutureTech, la tienda en línea para tecnología de vanguardia. Ofrecemos una amplia selección de productos
tecnológicos de alta calidad, desde portátiles y ordenadores de sobremesa hasta periféricos y accesorios para
computadoras. Nuestros productos son cuidadosamente seleccionados para garantizar que nuestros clientes obtengan la
mejor experiencia tecnológica posible. Ofrecemos precios competitivos y envío rápido para que pueda disfrutar de sus
productos lo antes posible. En FutureTech, nos comprometemos a brindar productos y servicios de alta calidad a nuestros
clientes, ¡ven y descubre el futuro de la tecnología con nosotros! */

if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");


$controlador = new controlador();

$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();


require_once 'view/template/header.php';
require_once 'view/' . $controlador->view . '.php';
require_once 'view/template/footer.php';
