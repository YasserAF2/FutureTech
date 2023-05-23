console.log('Starting');
if (typeof jQuery === 'undefined') {
  console.log('jQuery no se ha cargado correctamente');
} else {
  console.log('jQuery se ha cargado correctamente');
}

//BUSCADOR
// Variable para almacenar el estado del div de resultados
let resultadosVisible = false;

document.querySelector('form').addEventListener('submit', function (event) {
  event.preventDefault(); // Evitar que el formulario se envíe normalmente

  const query = document.getElementById('busqueda').value; // Obtener el valor del campo de búsqueda

  // Realizar la solicitud utilizando fetch
  fetch('view/buscar/buscar.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'query=' + encodeURIComponent(query), // Enviar el parámetro de búsqueda
  })
    .then(function (response) {
      if (response.ok) {
        return response.text(); // Devolver la respuesta como texto
      } else {
        throw new Error(
          'Error en la respuesta del servidor. Código: ' + response.status
        );
      }
    })
    .then(function (html) {
      const resultadosDiv = document.getElementById('resultados');
      resultadosDiv.innerHTML = html; // Mostrar los resultados en el elemento con el ID "resultados"

      // Mostrar el div de resultados solo si hay resultados
      if (html.trim() !== '') {
        resultadosDiv.style.display = 'block';
        resultadosVisible = true;
      } else {
        resultadosDiv.style.display = 'none';
        resultadosVisible = false;
      }
    })
    .catch(function (error) {
      console.error('Error en la solicitud:', error);
    });
});

//Esconder el div resultados al hacer click fuera
document.addEventListener('click', function (event) {
  const resultadosDiv = document.getElementById('resultados');
  const targetElement = event.target;

  // Comprobar si el clic ocurrió fuera del div de resultados cuando este está visible
  if (
    resultadosVisible &&
    targetElement !== resultadosDiv &&
    !resultadosDiv.contains(targetElement)
  ) {
    resultadosDiv.style.display = 'none'; // Cerrar o desaparecer el div de resultados
    resultadosVisible = false; // Actualizar el estado del div de resultados
  }
});

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
if (loginButton) {
  loginButton.addEventListener('click', function () {
    console.log('click');
    formlogin.classList.toggle('open');
  });
}
