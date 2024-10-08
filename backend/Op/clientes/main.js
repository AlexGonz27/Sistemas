const currentPage = document.title;
elementoLi = document.getElementById(currentPage);

document.addEventListener("DOMContentLoaded", () => {

  if (localStorage.getItem('showAlert') === 'true') {
    
    tareaCompletada();

    localStorage.removeItem('showAlert');
  }
  if (elementoLi) {
      elementoLi.classList.add("hovered");
  }
  
  const btnsModifi = document.querySelectorAll(".btns.btn-modificar");
  const btnseliminar = document.querySelectorAll(".btns.btn-eliminar");

  btnsModifi.forEach((boton) => {
    boton.addEventListener("click", function(){
        document.getElementById('ventmodifi').style.display = 'block';
    })
  })
  btnseliminar.forEach((boton) => {
    boton.addEventListener("click", function(){
        document.getElementById('venteliminar').style.display = 'block';
    })
  })
  let idiomaPersonalizado = {
    "sEmptyTable": "No hay datos disponibles en esta tabla",
    "sZeroRecords": "No se encontraron resultados",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
    "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar _MENU_ Entradas",
    "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
    }
  };
  $(document).ready(function() {
    var table = $('#Tabla_Datos').DataTable({
        paging: false,
        ordering: false,
        Selection: true,
        language: idiomaPersonalizado,
        "columnDefs": [
            { "searchable": false, "targets": -1 } // Excluye la última columna de la búsqueda
        ]
    });

    $('#buscador_tabla').on('keyup', function () {
        table.search(this.value).draw();
    });

    
    // Codigo AJAX para la subida a la nube
    $('.forma').on('submit', function(e) {
      e.preventDefault(); // Evitar el envío por defecto del formulario

      var formData = new FormData(this); // Serializar los datos del formulario

      $.ajax({
          url: './consultas.php', // Archivo PHP que procesa la solicitud
          method: 'POST',
          data: formData,
          processData: false, // Evitar que jQuery procese los datos
          contentType: false,
          success: function(respuesta) {
            console.log(respuesta);
            var data = JSON.parse(respuesta);

            if (data.estado === 'completado') {
              localStorage.setItem('showAlert', 'true');
              location.reload();
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

  const cells = document.querySelectorAll('tbody tr td');

  cells.forEach(cell => {
    cell.addEventListener('click', function() {
      if (this.style.whiteSpace === 'nowrap') {
        this.classList.toggle('ocultar');
      } else {
        this.classList.toggle('mostrar');
      }
    });
  });

});
let lista = document.querySelectorAll(".navegacion li")

function activeLink() {
  lista.forEach((item) => {
    item.classList.remove("hovered")
  });
}
function desactiveLink() {
  if (elementoLi) {
    elementoLi.classList.add("hovered");
  }
}

lista.forEach((item) => {
  item.addEventListener("mouseover", activeLink)
  item.addEventListener("mouseout", desactiveLink)
});

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navegacion")
let main = document.querySelector(".principal")

toggle.onclick = function () {
  navigation.classList.toggle("active")
  main.classList.toggle("active")
};

function ConfgVentModifi(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Clt").value = FilaJson.ID_Cliente;
  document.querySelector("#form-modificar #text_CI").value = FilaJson.Identificación;
  document.querySelector("#form-modificar #text_Name_RS").value = FilaJson.Nombre_Razón_Social;
  document.querySelector("#form-modificar #text_Direc").value = FilaJson.Dirección;
  document.querySelector("#form-modificar #text_Tlf").value = FilaJson.Teléfono;
  document.querySelector("#form-modificar #text_Fn").value = FilaJson.Fecha_Nacimiento;
}

function ConfgVentElim(ID) {
  document.getElementById("ID_CltElim").value = ID;
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

function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  var allowedChars = [45, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57]; // Códigos ASCII para "-" y números
  
  if (allowedChars.indexOf(charCode) === -1) {
    return false;
  }
  
  return true;
}
