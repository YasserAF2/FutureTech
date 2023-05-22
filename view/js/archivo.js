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

/* 
document.addEventListener('mouseup', function (e) {
  var container = document.getElementById('resultados');
  if (!container.contains(e.target)) {
    container.style.display = 'none';
  }
}); 
*/

//MENU HAMBURGUESA
// Obtener referencias a los elementos del DOM
const menuToggle = document.getElementById('menu-toggle');
const menu = document.getElementById('menu');

// Agregar un controlador de eventos al botón
menuToggle.addEventListener('click', function () {
  menu.classList.toggle('show');
});

//FORMULARIO LOGIN MOVIL
// Obtener referencias a los elementos del DOM
const loginButton = document.getElementById('btn-login2');
const formlogin = document.getElementById('formlogin');

// Agregar un controlador de eventos al botón de inicio de sesión
loginButton.addEventListener('click', function () {
  console.log('click');
  formlogin.classList.toggle('open');
});
