


document.addEventListener("DOMContentLoaded", () => {
  $(document).ready(function() {
    $('.forma').on('submit', function(e) {
      e.preventDefault(); // Evitar el envío por defecto del formulario

      var formData = new FormData(this); // Serializar los datos del formulario

      $.ajax({
          url: 'consultas.php', // Archivo PHP que procesa la solicitud
          method: 'POST',
          data: formData,
          processData: false, // Evitar que jQuery procese los datos
          contentType: false,
          success: function(respuesta) {
            console.log(respuesta);
            var data = JSON.parse(respuesta);

            if (data.estado === 'completado') {
              tareaCompletada();
              document.querySelectorAll('.ventana').forEach(function(element) {
                element.style.display = 'none';
            });
              setTimeout(function() {
                  location.reload();
              }, 3000);
            } else {
              tareaError(data.mensaje);
            }
          },
          error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema con la solicitud: ' + error
            });
          }
      });
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