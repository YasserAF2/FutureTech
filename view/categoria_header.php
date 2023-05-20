<?php
$productos = $dataToView['productos'];
?>

<div class="container">
    <h2 class="titulocategoria"><?php echo $dataToView['categoria_actual']['nombre']; ?></h2>
    <?php foreach ($productos as $producto) : ?>
    <div class="producto">
        <h2>
            <a href="index.php?action=producto_individual&id_producto=<?php echo $producto['id_producto']; ?>">
                <?php echo $producto['nombre']; ?>
            </a>
        </h2>
        <img class="imagen-categoria" src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>"
            alt="Imagen de <?php echo $producto['nombre']; ?>">
        <p><?php echo $producto['descripcion']; ?></p>
        <p>Precio: <?php echo $producto['precio']; ?>€</p>
        <?php if ($producto['oferta'] == 1) : ?>
        <p class="oferta">Oferta: <?php echo $producto['porcentaje_oferta']; ?>% de descuento</p>
        <?php endif; ?>
        <?php if ($producto['destacado'] == 1) : ?>
        <p class="destacado">¡Destacado!</p>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>