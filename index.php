<?php

require_once 'model/db.php';
require_once 'config/config.php';
require_once 'model/Producto.php';
require_once 'model/Categoria.php';
require_once 'controller/tienda.php';

/* Bienvenido a FutureTech, la tienda en línea para tecnología de vanguardia. Ofrecemos una amplia selección de productos
tecnológicos de alta calidad, desde portátiles y ordenadores de sobremesa hasta periféricos y accesorios para
computadoras. Nuestros productos son cuidadosamente seleccionados para garantizar que nuestros clientes obtengan la
mejor experiencia tecnológica posible. Ofrecemos precios competitivos y envío rápido para que pueda disfrutar de sus
productos lo antes posible. En FutureTech, nos comprometemos a brindar productos y servicios de alta calidad a nuestros
clientes, ¡ven y descubre el futuro de la tecnología con nosotros! */

if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");


$controlador = new tienda();

$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();
var_dump($dataToView);


require_once 'view/template/header.php';
require_once 'view/' . $controlador->view . '.php';
require_once 'view/template/footer.php';
