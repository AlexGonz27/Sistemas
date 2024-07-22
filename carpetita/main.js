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
    var table = $('#Tabla_Servicios').DataTable({
        paging: false,
        ordering: false,
        Selection: true,
        language: idiomaPersonalizado
    });

    $('#buscador_tabla').on('keyup', function () {
        table.columns(0).search(this.value).draw();
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

const contenedorCartas = document.querySelector(".cartaCaja");
const cartas = contenedorCartas.querySelectorAll(".carta");

// Agrega un event listener a cada carta
cartas.forEach((carta) => {
    const cartaNombre = carta.querySelector(".cartaNombre").textContent;
    carta.addEventListener("click", function() {
        const url = "./" + cartaNombre + ".php";
        window.location.href = url;
    });
});

document.getElementById("form-agregar").addEventListener("submit", function(event) {
  event.preventDefault();
});

function ConfgVentModifi(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Serv").value = FilaJson.ID_Servicios;
  document.querySelector("#form-modificar #text-tipo").value = FilaJson.Tipo;
  document.querySelector("#form-modificar #text-desc").value = FilaJson.Descripción;
  document.querySelector("#form-modificar #text-cost").value = FilaJson.Costo;
}

function ConfgVentModifiCat(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Cat").value = FilaJson.ID_Categoria;
  document.querySelector("#form-modificar #text-nombreCat").value = FilaJson.Nombre;
  document.querySelector("#form-modificar #text-descCat").value = FilaJson.Descripción;
  document.querySelector("#form-modificar #text-capCat").value = FilaJson.Capacidad;
  document.querySelector("#form-modificar #text-costCat").value = FilaJson.Precio;
}

function ConfgVentModifiHabit(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Hab").value = FilaJson.ID_Habitaciones;
  document.querySelector("#form-modificar #Categoria_agregar").value = FilaJson.ID_Categoria;
  document.querySelector("#form-modificar #text-descHab").value = FilaJson.N_Habitación;
  document.querySelector("#form-modificar #Estado_agregar").value = FilaJson.Estado;
}

function ConfgVentModifiPromo(FilaJson) {
  console.log(FilaJson)

  document.querySelector("#form-modificar #ID_Promo").value = FilaJson.ID_Promociones;
  document.querySelector("#form-modificar #text-nombre").value = FilaJson.Nombre;
  document.querySelector("#form-modificar #text-descrip").value = FilaJson.Descripción;
  document.querySelector("#form-modificar #text-descuento").value = FilaJson.Descuento;
}

function ConfgVentElim(ID) {
  document.getElementById("ID_ServElim").value = ID;
}

function ConfgVentElimCat(ID) {
  document.getElementById("ID_CatElim").value = ID;
}
function ConfgVentElimPromo(ID) {
  document.getElementById("ID_elimPromo").value = ID;
}
