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
  });
  
  
  $(document).ready(function() {
    $.ajax({
        url: './consultas.php',
        type: 'POST',
        data: { action: 'reservas' },
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            var data = JSON.parse(response);
            datos = data.data;
            var eventos = datos.map(function(reserva) {
              return {
                  title: 'Habitación ' + reserva.N_Habitación,
                  start: reserva.Fecha_Entrada,
                  end: new Date(new Date(reserva.Fecha_Salida).setDate(new Date(reserva.Fecha_Salida).getDate() + 1)).toISOString().split('T')[0]
              };
            });
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
              headerToolbar: {
                left: 'prevYear,prev,next,nextYear today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
              },
              buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
              },
              locale: 'es',
              initialView: 'dayGridMonth',
              navLinks: true, // can click day/week names to navigate views
              editable: true,
              events: eventos

            });
          
            calendar.render();
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
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

const contenedorCartas = document.querySelector(".cartaCaja");
const cartas = contenedorCartas.querySelectorAll(".carta");

// Agrega un event listener a cada carta
cartas.forEach((carta) => {
    const cartaNombre = carta.querySelector(".cartaNombre").textContent.toLowerCase();
    carta.addEventListener("click", function() {
        const url = "./" + cartaNombre + "/" + cartaNombre + ".php";
        window.location.href = url;
    });
});

function mostrarConsola(data){
  console.log(data);
}
