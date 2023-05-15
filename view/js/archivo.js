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

function comprobarNombreUsuario() {
  const nombreUsuario = document.getElementById('nombre').value;
  const mensajeError = document.getElementById('mensaje-error');

  console.log('Comprobando nombre de usuario:', nombreUsuario);

  fetch('index.php?action=comprobar_nombre_usuario&nombre=' + nombreUsuario)
    .then((response) => response.json())
    .then((data) => {
      console.log('Respuesta del servidor:', data);
      if (data.existe) {
        mensajeError.innerText =
          'El nombre de usuario ya existe, por favor elija otro';
      } else {
        mensajeError.innerText = '';
      }
    })
    .catch((error) => {
      console.error('Error al comprobar el nombre de usuario:', error);
    });
}
