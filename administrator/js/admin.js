$(document).ready(function () {
  console.log('El documento se ha cargado correctamente.');
  $('.opciones-lista').click(function (event) {
    console.log('Se ha hecho clic en un elemento de la lista.');
    event.preventDefault();
    var url = $(this).attr('href');
    cargarVistaDinamica(url);
  });
});

function cargarVistaDinamica(url) {
  console.log('Cargando la vista dinámica desde la URL: ' + url);
  $.ajax({
    url: url,
    type: 'GET',
    success: function (respuesta) {
      console.log('La vista dinámica se ha cargado correctamente.');
      $('#vista-dinamica').html(respuesta);
    },
    error: function (xhr, status, error) {
      console.log(
        'Se ha producido un error al cargar la vista dinámica: ' + error
      );
    },
  });
}

window.addEventListener('scroll', function () {
  var btnVolverArriba = document.querySelector('.btn-volver-arriba');
  if (window.scrollY > 200) {
    btnVolverArriba.classList.add('show-btn-volver-arriba');
  } else {
    btnVolverArriba.classList.remove('show-btn-volver-arriba');
  }
});

function borrarProducto(id_producto) {
  fetch('index.php?action=borrar_producto_carrito', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      id_producto: id_producto,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data); // Si todo va bien, mostrar respuesta del servidor
      // Refrescar la página para mostrar los cambios en el carrito
      location.reload();
    })
    .catch((error) => {
      console.error('Error al borrar el producto del carrito:', error);
    });
}

//confirmar borrado de la lista de usuarios
function confirmarBorrado(idUsuario) {
  if (confirm('¿Estás seguro de que deseas borrar este usuario?')) {
    // Realiza la solicitud de borrado al servidor
    $.ajax({
      url: 'index.php?action=borrar_usuario',
      method: 'POST',
      data: { id_usuario: idUsuario },
      success: function (response) {
        // actualiza la lista de usuarios en la página
        location.reload();
      },
      error: function () {
        // Maneja el error si la solicitud de borrado falla
        alert('Error al borrar el usuario.');
      },
    });
  }
}

//confirmar borrado de la lista de comentarios
function confirmarBorradoComentario(idComentario) {
  if (confirm('¿Estás seguro de que deseas borrar este comentario?')) {
    // Realiza la solicitud de borrado al servidor
    $.ajax({
      url: 'index.php?action=borrar_comentario',
      method: 'POST',
      data: { id_comentario: idComentario },
      success: function (response) {
        // Actualiza la página
        location.reload();
      },
      error: function () {
        // Maneja el error si la solicitud de borrado falla
        alert('Error al borrar el comentario.');
      },
    });
  }
}

//confirmar borrado de la lista de productos
function confirmarBorradoProducto(idProducto) {
  if (confirm('¿Estás seguro de que deseas borrar este producto?')) {
    // Realiza la solicitud de borrado al servidor
    $.ajax({
      url: 'index.php?action=borrar_producto',
      method: 'POST',
      data: { id_producto: idProducto },
      success: function (response) {
        // Actualiza la página o realiza acciones adicionales si es necesario
        location.reload();
      },
      error: function () {
        // Maneja el error si la solicitud de borrado falla
        alert('Error al borrar el producto.');
      },
    });
  }
}
