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
      let resultadosDiv = document.getElementById('resultados');
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
  let resultadosDiv = document.getElementById('resultados');
  let targetElement = event.target;

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
let menuToggle = document.getElementById('menu-toggle');
let menu = document.getElementById('menu');

// Agregar un controlador de eventos al botón
menuToggle.addEventListener('click', function () {
  menu.classList.toggle('show');
});

//FORMULARIO LOGIN MOVIL
// Obtener el formulario y los campos de usuario y contraseña
const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const errorMessage = document.getElementById('error-message');

// Expresiones regulares para validar usuario y contraseña
const usernameRegex = /^[a-zA-Z0-9]{4,}$/;
const passwordRegex = /^.{6,}$/;

// Función de validación
function validarFormulario(event) {
  // Limpiar el mensaje de error
  limpiarMensajeError();

  // Validar usuario y contraseña
  let errores = [];

  if (!usernameRegex.test(usernameInput.value)) {
    errores.push('El usuario debe tener al menos 4 caracteres alfanuméricos');
  }

  if (!passwordRegex.test(passwordInput.value)) {
    errores.push('La contraseña debe tener al menos 6 caracteres');
  }

  // Mostrar mensajes de error si los hay
  if (errores.length > 0) {
    mostrarMensajesError(errores);
    event.preventDefault(); // Detener el envío del formulario si hay errores
  }
}

// Función para mostrar mensajes de error
function mostrarMensajesError(errores) {
  errores.forEach((error) => {
    const mensajeError = document.createElement('div');
    mensajeError.classList.add('error-item');
    mensajeError.textContent = error;
    errorMessage.appendChild(mensajeError);
  });
}

// Función para limpiar el mensaje de error
function limpiarMensajeError() {
  errorMessage.innerHTML = '';
}

// Asociar la función de validación al evento submit del formulario
loginForm.addEventListener('submit', validarFormulario);
