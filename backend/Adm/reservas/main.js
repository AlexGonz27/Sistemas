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

    $('#F_E, #F_S').on('change', function(){
        var valor1 = $('#F_E').val();
        var valor2 = $('#F_S').val();
        $.ajax({
          url: 'Funcion.php',
          type: 'POST',
          data: {F_E: valor1, F_S: valor2},
          success: function(response){
              $('#Hab').html(response);
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
  
  document.getElementById("Fch_Reserva").value = new Date().toISOString().split('T')[0];
});
//Funciones para marcar en la navegacion
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
  $('#Tabla_Datos').DataTable().columns.adjust().draw();
};

//Modal Modificar Reserva (Propenso a gran cambio)
function ConfgVentModifi(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Reserva").value = FilaJson.ID_Reservación;
  document.querySelector("#form-modificar #ID_Cliente").value = FilaJson.ID_Cliente;
  document.querySelector("#form-modificar #Fch_Reserva").value = FilaJson.Fecha_Reservación;
  document.querySelector("#form-modificar #Fch_Entrada").value = FilaJson.Fecha_Entrada;
  document.querySelector("#form-modificar #Fch_Salida").value = FilaJson.Fecha_Salida;
  document.querySelector("#form-modificar #Estado").value = FilaJson.Estado;
}

function ConfgVentElim(ID) {
  document.getElementById("ID_ResElim").value = ID;
}

function mostrarinfo(datos) {
  document.getElementById('ID_clt').value = datos.Nacionalidad + "-" + datos.Identificación;
  document.getElementById('ID_clt').readOnly = true;
  document.getElementById('Nacionalidad').style.display = 'none';
  document.getElementById('buscar-btn').style.display = 'none';

  var divNombre = document.createElement("div");
  divNombre.className = "case";
  var inputNombre = document.createElement("input");
  inputNombre.type = "text";
  inputNombre.placeholder = "Nombre";
  inputNombre.name = "nombre";
  inputNombre.readOnly = true;
  inputNombre.value = datos.Nombre_Razón_Social; 
  divNombre.appendChild(inputNombre);
  document.getElementById('clientes').appendChild(divNombre);
  
  var divTelefono = document.createElement("div");
  divTelefono.className = "case";
  var inputTelefono = document.createElement("input");
  inputTelefono.type = "text";
  inputTelefono.placeholder = "Teléfono";
  inputTelefono.name = "telefono";
  inputTelefono.readOnly = true;
  inputTelefono.value = datos.Teléfono;
  divTelefono.appendChild(inputTelefono);
  document.getElementById('clientes').appendChild(divTelefono);

  var btnDisponibilidad = document.createElement("button");
  btnDisponibilidad.className = "btn-buscar";
  btnDisponibilidad.textContent = "Reservar";
  btnDisponibilidad.addEventListener('click', function(){
    Reservar(datos);
    document.getElementById('ventagregar').style.display = 'block';
    document.getElementById('forma').addEventListener('submit', function(event) {
      event.preventDefault();
    });
  })
  document.getElementById('btns-buscar').appendChild(btnDisponibilidad);

  var btnCancelar = document.createElement("button");
  btnCancelar.className = "btn-cancelar";
  btnCancelar.textContent = "Cancelar";
  btnCancelar.addEventListener('click', function(){
  })
  document.getElementById('btns-buscar').appendChild(btnCancelar);

}
function Reservar(datos) {
  console.log(datos)
  
  generarCodigo('Codigo_add');
  document.querySelector("#form-agregar #Identidad").textContent = datos.Identificación;
}
function generarCodigo(text) {
  const letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  const numeros = '0123456789';

  // Generar dos letras aleatorias
  let codigo = '';
  for (let i = 0; i < 2; i++) {
      codigo += letras.charAt(Math.floor(Math.random() * letras.length));
  }

  // Generar dos números aleatorios
  for (let i = 0; i < 2; i++) {
      codigo += numeros.charAt(Math.floor(Math.random() * numeros.length));
  }

  // Mostrar el código generado
  document.getElementById(text).innerText = codigo;
}