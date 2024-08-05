
document.addEventListener("DOMContentLoaded", () => {
    $(document).ready(function() {
        
      $('.forma').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío por defecto del formulario
  
        var formData = new FormData(this); // Serializar los datos del formulario
  
        $.ajax({
            url: './login.php', // Archivo PHP que procesa la solicitud
            method: 'POST',
            data: formData,
            processData: false, // Evitar que jQuery procese los datos
            contentType: false,
            success: function(respuesta) {
                console.log(respuesta);

                var data = JSON.parse(respuesta);

                if (data.estado === 'completado') {
                    switch (data.nivel) {
                        case '1':
                            window.location.href = '../backend/Adm'
                            break;
                        case '2':
                            window.location.href = '../backend/Op'
                            break;
                        case '3':
                            window.location.href = '../User'
                            break;
                        default:
                            break;
                    }

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
      $('.registrar').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío por defecto del formulario
  
        var formData = new FormData(this); // Serializar los datos del formulario
  
        $.ajax({
            url: './registrar.php', // Archivo PHP que procesa la solicitud
            method: 'POST',
            data: formData,
            processData: false, // Evitar que jQuery procese los datos
            contentType: false,
            success: function(respuesta) {
                console.log(respuesta);

                var data = JSON.parse(respuesta);

                if (data.estado === 'completado') {
                    window.location.href = '../User'
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

const container = document.querySelector(".container")
const btnSingIn = document.getElementById("btn-sing-in")
const btnSingUp = document.getElementById("btn-sing-up")

btnSingIn.addEventListener("click",()=>{
    container.classList.remove("toggle")
});
btnSingUp.addEventListener("click",()=>{
    container.classList.add("toggle")
});


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