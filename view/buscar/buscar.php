<?php

// Verificar si la solicitud es una petición POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el valor del parámetro de búsqueda
    $query = $_POST['query'];

    // Aquí podrías hacer la búsqueda en tu base de datos o en alguna otra fuente de datos
    // En este ejemplo, simplemente devolveremos una respuesta con algunos resultados de prueba
    $resultados = [
        [
            'titulo' => 'Ordenador de sobremesa',
            'descripcion' => 'Ordenador de sobremesa de última generación con procesador Intel Core i7 y tarjeta gráfica NVIDIA GeForce RTX 3080.',
            'imagen' => 'view/buscar/img/torre-01-1.png',
            'url' => 'index.php?action=producto_individual&id_producto=11'
        ],
        [
            'titulo' => 'Ordenador de sobremesa HP',
            'descripcion' => 'Ordenador de sobremesa HP con procesador Intel Core i5, 8 GB de RAM y 256 GB de almacenamiento SSD.',
            'imagen' => 'view/buscar/img/sobremesa-HP.jpg',
            'url' => 'index.php?action=producto_individual&id_producto=11'
        ],
        [
            'titulo' => 'Monitor LG',
            'descripcion' => 'Monitor LG de 27 pulgadas con resolución 4K y tecnología HDR.',
            'imagen' => 'view/buscar/img/monitor LG.jpg',
            'url' => 'index.php?action=producto_individual&id_producto=11'
        ]
    ];

    // Generar el HTML con los resultados de búsqueda
    $html_resultados = '';
    foreach ($resultados as $resultado) {
        $html_resultados .= '<div class="resultado-busqueda">';
        $html_resultados .= '<a href="' . $resultado['url'] . '">';
        $html_resultados .= '<div class="row">';
        $html_resultados .= '<div class="col-md-3">';
        $html_resultados .= '<img src="' . $resultado['imagen'] . '" alt="' . $resultado['titulo'] . '">';
        $html_resultados .= '</div>';
        $html_resultados .= '<div class="col-md-9">';
        $html_resultados .= '<h4>' . $resultado['titulo'] . '</h4>';
        $html_resultados .= '<p>' . $resultado['descripcion'] . '</p>';
        $html_resultados .= '</div>';
        $html_resultados .= '</div>';
        $html_resultados .= '</a>';
        $html_resultados .= '</div>';
    }

    // Devolver la respuesta como texto plano
    echo $html_resultados;
}
