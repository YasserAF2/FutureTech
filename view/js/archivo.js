if (typeof jQuery === 'undefined') {
  console.log('jQuery no se ha cargado correctamente');
} else {
  console.log('jQuery se ha cargado correctamente');
}

console.log($.fn.slick);

//BUSCADOR
$(document).ready(function () {
  // Agregar evento keyup al input de búsqueda
  $('#busqueda').on('keyup', function () {
    // Obtener el valor del input de búsqueda
    var query = $(this).val();

    // Hacer una solicitud AJAX al servidor para obtener los resultados de búsqueda
    $.ajax({
      url: 'view/buscar.php',
      type: 'POST',
      data: {
        query: query,
      },
      success: function (response) {
        // Mostrar los resultados de búsqueda en la página
        $('#resultados').html(response);
      },
    });
  });
});

$(document).mouseup(function (e) {
  var container = $('#resultados');
  if (!container.is(e.target) && container.has(e.target).length === 0) {
    container.hide();
  }
});

/* //CARRUSEL
$(document).ready(function () {
  $('.carrusel-robots').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: true,
    prevArrow: '<button type="button" class="slick-prev">Previous</button>',
    nextArrow: '<button type="button" class="slick-next">Next</button>',
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
});
 */
