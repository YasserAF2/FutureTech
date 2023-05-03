if (typeof jQuery === 'undefined') {
  console.log('jQuery no se ha cargado correctamente');
} else {
  console.log('jQuery se ha cargado correctamente');
}

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
