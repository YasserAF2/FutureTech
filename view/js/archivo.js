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
        resultadosDiv.style.backgroundColor = '#101010';
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
// Variable para almacenar la posición anterior del scroll vertical
var previousScroll = window.pageYOffset || document.documentElement.scrollTop;

// Verifica si el botón existe antes de agregar el event listener
if (btnLogin) {
  // Agrega un event listener al botón para escuchar el clic
  btnLogin.addEventListener('click', function (ev) {
    ev.stopPropagation();
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

// Agrega un event listener al documento para escuchar el clic fuera del formulario
document.addEventListener('click', function (event) {
  if (!formLogin.contains(event.target) && event.target !== btnLogin) {
    formLogin.classList.remove('open');
  }
});

// Agrega un event listener al scroll vertical de la página
window.addEventListener('scroll', function () {
  // Obtiene la posición actual del scroll vertical
  var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  // Verifica si hubo un desplazamiento hacia abajo
  if (currentScroll > previousScroll) {
    formLogin.classList.remove('open');
  }

  // Actualiza la posición anterior del scroll vertical
  previousScroll = currentScroll;
});

//MENU HAMBURGUESA
// Obtener referencias a los elementos del DOM
let menuToggle = document.getElementById('menu-toggle');
let menu = document.getElementById('menu');

// Variables para almacenar la posición anterior y actual del scroll vertical
var previousScrollPos =
  window.pageYOffset || document.documentElement.scrollTop;
var currentScrollPos;

//abrir menu con el botón
menuToggle.addEventListener('click', function (ev) {
  ev.stopPropagation();
  menu.classList.toggle('show');
});

//cerrar menu clickeando fuera
document.addEventListener('click', function (event) {
  if (!menu.contains(event.target) && !event.target.matches('#menu-toggle')) {
    menu.classList.remove('show');
  }
});

// Cerrar el menú al hacer scroll vertical
window.addEventListener('scroll', function () {
  // Obtener la posición actual del scroll vertical
  currentScrollPos = window.pageYOffset || document.documentElement.scrollTop;

  // Verificar si hubo un desplazamiento hacia abajo
  if (currentScrollPos > previousScrollPos) {
    menu.classList.remove('show');
  }

  // Actualizar la posición anterior del scroll vertical
  previousScrollPos = currentScrollPos;
});

//CARRUSEL
window.addEventListener('DOMContentLoaded', function () {
  var carousel = document.querySelector('.hero-carousel');

  if (carousel !== null) {
    carousel.classList.add('loading');

    setTimeout(function () {
      // Una vez que los recursos estén listos, eliminar la clase "loading"
      carousel.classList.remove('loading');
    }, 4000);

    // Selecciona todos los elementos con la clase "carousel-slide" y los guarda en la variable slides
    var slides = document.querySelectorAll('.carousel-slide');
    // Almacena el índice del slide actual
    var currentSlide = 0;

    if (slides.length > 0) {
      // Establece un intervalo de tiempo para llamar a la función nextSlide cada 5000 milisegundos (5 segundos)
      var slideInterval = setInterval(nextSlide, 4000);
    }

    function nextSlide() {
      // Verifica si el índice actual está dentro del rango válido
      if (currentSlide >= 0 && currentSlide < slides.length) {
        // Remueve la clase "active" del slide actual, ocultándolo
        slides[currentSlide].classList.remove('active');

        // Calcula el índice del siguiente slide en función del índice actual y la cantidad de slides disponibles
        currentSlide = (currentSlide + 1) % slides.length;

        // Agrega la clase "active" al nuevo slide actual, mostrándolo
        slides[currentSlide].classList.add('active');
      }
    }
  }
});
