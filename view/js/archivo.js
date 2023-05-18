console.log('Starting');
if (typeof jQuery === 'undefined') {
  console.log('jQuery no se ha cargado correctamente');
} else {
  console.log('jQuery se ha cargado correctamente');
}

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

//imagen del producto individual zoom
// Obtener la imagen y el contenedor
let imagen = document.getElementById('imagenPI');
let contenedor = document.getElementById('img-container');

// Aumentar el tamaño de la imagen al pasar el ratón por encima
imagen.addEventListener('mouseover', () => {
  imagen.style.transform = 'scale(2)'; // Ajusta el factor de escala deseado
});

// Restaurar el tamaño original de la imagen al quitar el ratón
imagen.addEventListener('mouseout', () => {
  imagen.style.transform = 'scale(1)';
});

// Mostrar la imagen en grande al hacer clic
imagen.addEventListener('click', () => {
  contenedor.classList.toggle('img-p-individual-expanded');
});
