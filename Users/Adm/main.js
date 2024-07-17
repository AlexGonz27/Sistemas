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

function ConfgVentModifi(C_ID,ID) {
  let fila;

  if (C_ID === 1) {
    fila = document.querySelector("#Tabla_Servicios tr:first-child");
  } else {
    fila = document.querySelector("#Tabla_Servicios tr:nth-child(" + (C_ID) + ")");
  }
  document.getElementById("ID_Serv").value = ID;
  document.getElementById("text-tipo").value = fila.cells[0].textContent;
  document.getElementById("text-desc").value = fila.cells[1].textContent;
  document.getElementById("text-cost").value = fila.cells[2].textContent;
}

function ConfgVentModifiCat(C_ID,ID) {
  let fila;

  if (C_ID === 1) {
    fila = document.querySelector("#Tabla_Categorias tr:first-child");
  } else {
    fila = document.querySelector("#Tabla_Categorias tr:nth-child(" + (C_ID) + ")");
  }
  document.getElementById("ID_Cat").value = ID;
  document.getElementById("text-nombre").value = fila.cells[0].textContent;
  document.getElementById("text-desc").value = fila.cells[1].textContent;
  document.getElementById("text-cap").value = fila.cells[2].textContent;
  document.getElementById("text-cost").value = fila.cells[3].textContent;
}

function ConfgVentElim(ID) {
  document.getElementById("ID_ServElim").value = ID;
}

function ConfgVentElimCat(ID) {
  document.getElementById("ID_CatElim").value = ID;
}