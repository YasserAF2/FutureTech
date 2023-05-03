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
            'imagen' => 'https://via.placeholder.com/150x150',
            'url' => '#'
        ],
        [
            'titulo' => 'Portátil HP',
            'descripcion' => 'Portátil HP con pantalla de 15 pulgadas, procesador AMD Ryzen 5 y tarjeta gráfica AMD Radeon Vega 8.',
            'imagen' => 'https://via.placeholder.com/150x150',
            'url' => '#'
        ],
        [
            'titulo' => 'Monitor LG',
            'descripcion' => 'Monitor LG de 27 pulgadas con resolución 4K y tecnología HDR.',
            'imagen' => 'https://via.placeholder.com/150x150',
            'url' => '#'
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
