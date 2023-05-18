console.log('Starting');
if (typeof jQuery === 'undefined') {
  console.log('jQuery no se ha cargado correctamente');
} else {
  console.log('jQuery se ha cargado correctamente');
}

//BUSCADOR
document.addEventListener('DOMContentLoaded', function () {
  // Obtener el elemento del input de búsqueda
  var busquedaInput = document.getElementById('busqueda');

  // Agregar el evento keyup al input de búsqueda
  busquedaInput.addEventListener('keyup', function () {
    // Obtener el valor del input de búsqueda
    var query = this.value;

    // Realizar la solicitud AJAX utilizando fetch
    fetch('view/buscar.php', {
      method: 'POST',
      headers: {
        'Content-type': 'application/x-www-form-urlencoded',
      },
      body: 'query=' + encodeURIComponent(query),
    })
      .then(function (response) {
        return response.text();
      })
      .then(function (data) {
        // Mostrar los resultados de búsqueda en la página
        document.getElementById('resultados').innerHTML = data;
      })
      .catch(function (error) {
        console.log('Error:', error);
      });
  });
});

document.addEventListener('mouseup', function (e) {
  var container = document.getElementById('resultados');
  if (!container.contains(e.target)) {
    container.style.display = 'none';
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
