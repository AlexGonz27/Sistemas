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
        table.columns().search(this.value).draw();
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

document.getElementById("form-agregar").addEventListener("submit", function(event) {
  event.preventDefault();
});

function ConfgVentModifiCat(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Cat").value = FilaJson.ID_Categoria;
  document.querySelector("#form-modificar #text-nombreCat").value = FilaJson.Nombre;
  document.querySelector("#form-modificar #text-descCat").value = FilaJson.Descripción;
  document.querySelector("#form-modificar #text-capCat").value = FilaJson.Capacidad;
  document.querySelector("#form-modificar #text-costCat").value = FilaJson.Precio;
}

function ConfgVentElimCat(ID) {
  document.getElementById("ID_CatElim").value = ID;
}