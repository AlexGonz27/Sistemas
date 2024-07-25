const currentPage = document.title;
elementoLi = document.getElementById(currentPage);

document.addEventListener("DOMContentLoaded", () => {
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
        language: idiomaPersonalizado
    });

    $('#buscador_tabla').on('keyup', function () {
        table.search(this.value).draw();
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

  document.querySelector("#form-modificar #ID_Serv").value = FilaJson.ID_Servicios;
  document.querySelector("#form-modificar #text-tipo").value = FilaJson.Tipo;
  document.querySelector("#form-modificar #text-desc").value = FilaJson.Descripción;
  document.querySelector("#form-modificar #text-cost").value = FilaJson.Costo;
}
function ConfgVentElim(ID) {
  document.getElementById("ID_ServElim").value = ID;
}

function ValidTipo()
{
  Tipo = document.querySelector("#form-agregar #text-tipo");
  for(var i = 0; i < Tipo.value.Length();i++){
    if(Tipo.value <= '9' && Tipo.value >='0')
      {
        return false;
      }
  }
  return true;
  
}