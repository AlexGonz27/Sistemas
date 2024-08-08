


document.addEventListener("DOMContentLoaded", () => {
  // Asegúrate de que updateRoomData sea una función válida
  // Código AJAX para la subida a la nube

  document.getElementById('btn-addHabitacion').addEventListener('click', function(){
    // Crear el contenedor de la nueva habitación
    var nuevaHabitacion = document.createElement('div');
    nuevaHabitacion.className = 'row border border-info-subtle border-2 rounded shadow p-3 mb-2';
    roomName = document.getElementById('room-name').textContent;
    roomNumH = document.getElementById('room-numH').textContent;
    roomPrice = document.getElementById('room-price').textContent;
    
    // Añadir el contenido HTML a la nueva habitación
    nuevaHabitacion.innerHTML = `
        <div class="col-md-12">
            <h4 class="text-start">Categoria: <span>${roomName}</span></h4>
            <h4 class="text-start">Nº Habitación: <span>${roomNumH}</span></h4>
            <h4 class="text-start mt-1">Precio: <span>${roomPrice}</span> $ / Por Noche</h4>
        </div>
        <div class="col-md-12 text-end">
            <span class='btn btn-danger btn-delete''><i class='bi bi-trash'></i></span>
        </div>
    `;

    // Añadir la nueva habitación al contenedor principal
    document.getElementById('habitaciones-container').appendChild(nuevaHabitacion);

    var removedElement = null;

    var element = document.getElementById('H' + roomNumH);
    if (element) {
      // Cambiar a otro elemento del carrusel antes de eliminar
      var nextElement = element.nextElementSibling || element.previousElementSibling;
      if (nextElement) {
      var carousel = new bootstrap.Carousel(document.querySelector('#carouselImages'));
      carousel.to(Array.from(nextElement.parentNode.children).indexOf(nextElement));
      }
      removedElement = element.cloneNode(true); // Clonar el elemento para almacenarlo
      element.remove(); // Eliminar el elemento del DOM
      
      if (document.getElementById('carouselImages').querySelectorAll('.carousel-item').length === 0) {
        document.getElementById('noContentMessage').style.display = 'block';
      }
    } else {
        console.log('Elemento no encontrado');
    }

    nuevaHabitacion.querySelector('.btn-delete').addEventListener('click', function() {
      if (removedElement) {
        document.getElementById('noContentMessage').style.display = 'none';
        document.getElementById('resultadoDisponibilidad').appendChild(removedElement); // Volver a agregar el elemento al carrusel
        removedElement = null; // Limpiar la referencia
      
      } else {
          console.log('No hay elemento para mostrar');
      }
      nuevaHabitacion.remove();
    });

  })
  
  $('.forma').on('submit', function(e) {
    e.preventDefault(); // Evitar el envío por defecto del formulario

    var formData = new FormData(this); // Serializar los datos del formulario
    for (var pair of formData.entries()) {
      console.log(pair[0] + ': ' + pair[1]);
    }

    // Aquí puedes agregar tu código AJAX para enviar formData a la nube
    $.ajax({
      url: './mostrarDisponibilidad.php', // Reemplaza con tu URL de subida
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(respuesta) {
        var data = JSON.parse(respuesta);
        console.log(data);
        $('#resultadoDisponibilidad').html(data['mensaje']);

        updateRoomData();
        toggleDisponibilidad();

      },
      error: function(error) {
        // Manejar el error
        console.error('Error:', error);
      }
>>>>>>> Stashed changes
    });
  });
});



function cargarInfo(datos){
  console.log(datos);

  document.getElementById('name-user').textContent = datos.Nombre_Razón_Social;
  
}

function ConfgVentModifi(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Clt").value = FilaJson.ID_Cliente;
  document.querySelector("#form-modificar #text-Name_RS").value = FilaJson.Nombre_Razón_Social;
  document.querySelector("#form-modificar #text-CI").value = FilaJson.Identificación;
  document.querySelector("#form-modificar #text-Direc").value = FilaJson.Dirección;
  document.querySelector("#form-modificar #text-Tlf").value = FilaJson.Teléfono;
  document.querySelector("#form-modificar #text-Fn").value = FilaJson.Fecha_Nacimiento;
}

function ConfgVentElim(ID){
  document.getElementById("ID_ResElim").value = ID;
}

function tareaCompletada(){
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
<<<<<<< Updated upstream
  Toast.fire({
    icon: "success",
    title: "Tarea completada!",
  });
}

function tareaError(mensaje){
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
  Toast.fire({
    icon: "error",
    title: "error",
    text: mensaje
  });
}
=======
}
function toggleDisponibilidad() {
  var div1 = document.getElementById("Disponibilidad");
  if (div1.style.display === "none") {
      div1.style.display = "block";
  }
}
// Función para actualizar los datos de la habitación
function updateRoomData() {
  const activeItem = document.querySelector('.carousel-item.active');
  const roomName = activeItem.getAttribute('data-room-name');
  const roomNumH = activeItem.getAttribute('data-room-numH');
  const roomDescription = activeItem.getAttribute('data-room-description');
  const roomPrice = activeItem.getAttribute('data-room-price');
  document.getElementById('room-name').textContent = roomName;
  document.getElementById('room-numH').textContent = roomNumH;
  document.getElementById('room-description').textContent = roomDescription;
  document.getElementById('room-price').textContent = roomPrice;
}
// Actualizar los datos cuando se cambia la diapositiva
document.getElementById('carouselImages').addEventListener('slid.bs.carousel', updateRoomData);
// Actualizar los datos al cargar la página
>>>>>>> Stashed changes
