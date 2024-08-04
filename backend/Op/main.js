const currentPage = document.title;
elementoLi = document.getElementById(currentPage);

document.addEventListener("DOMContentLoaded", () => {
  if (elementoLi) {
      elementoLi.classList.add("hovered");
  }
  
  const btnsModifi = document.querySelectorAll(".btns.btn-modificar");
  
  btnsModifi.forEach((boton) => {
    boton.addEventListener("click", function(){
        document.getElementById('ventmodifi').style.display = 'block';
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

function cerrarEmergente(){
  document.getElementById('ventmodifi').style.display = 'none';
}