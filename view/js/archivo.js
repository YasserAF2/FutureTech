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

//FORMULARIO LOGIN EN VERSION MOVIL
// Obtén el botón y el formulario por su ID
var btnLogin = document.getElementById('btn-login2');
var formLogin = document.getElementById('formlogin');

// Verifica si el botón existe antes de agregar el event listener
if (btnLogin) {
  // Agrega un event listener al botón para escuchar el clic
  btnLogin.addEventListener('click', function () {
    // Verifica si el formulario ya tiene la clase "open"
    if (formLogin.classList.contains('open')) {
      // Si tiene la clase "open", la remueve para cerrar el formulario
      formLogin.classList.remove('open');
    } else {
      // Si no tiene la clase "open", la agrega para abrir el formulario
      formLogin.classList.add('open');
    }
  });
}

//MENU HAMBURGUESA
// Obtener referencias a los elementos del DOM
let menuToggle = document.getElementById('menu-toggle');
let menu = document.getElementById('menu');

// Agregar un controlador de eventos al botón
menuToggle.addEventListener('click', function () {
  menu.classList.toggle('show');
});

// JavaScript carrusel
window.addEventListener('DOMContentLoaded', function () {
  var carousel = document.querySelector('.hero-carousel');
  carousel.classList.add('loading');

  setTimeout(function () {
    // Una vez que los recursos estén listos, eliminar la clase de "loading"
    carousel.classList.remove('loading');
  }, 4000);
});

// Selecciona todos los elementos con la clase "carousel-slide" y los guarda en la variable slides
var slides = document.querySelectorAll('.carousel-slide');
// Almacena el índice del slide actual
var currentSlide = 0;
// Establece un intervalo de tiempo para llamar a la función nextSlide cada 5000 milisegundos (5 segundos)
var slideInterval = setInterval(nextSlide, 4000);

function nextSlide() {
  // Remueve la clase "active" del slide actual, ocultándolo
  slides[currentSlide].classList.remove('active');

  // Calcula el índice del siguiente slide en función del índice actual y la cantidad de slides disponibles
  currentSlide = (currentSlide + 1) % slides.length;

  // Agrega la clase "active" al nuevo slide actual, mostrándolo
  slides[currentSlide].classList.add('active');
}
