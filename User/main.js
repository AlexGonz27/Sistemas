document.addEventListener("DOMContentLoaded", () => {
});

function cargarInfo(datos){
  console.log(datos);

  document.getElementById('name-user').textContent = datos.Nombre_Razón_Social;
  var modalDatos = document.getElementById('datos_usuario');
  const etiquetas = {
    Dirección: "Dirección: ",
    Fecha_Nacimiento: "Fecha de Nacimiento: ",
    Identificación: "Identificación: ",
    Nacionalidad: "Nacionalidad: ",
    Nombre_Razón_Social: "Nombre: ",
    Teléfono: "Teléfono: "
  };
  const orden = ["Nombre_Razón_Social", "Identificación", "Nacionalidad", "Fecha_Nacimiento", "Dirección", "Teléfono"];
  orden.forEach(key => {
    if (datos[key]) {
      var h = document.createElement("h5");
      h.textContent = etiquetas[key] + datos[key];
      document.getElementById('datos_usuario').appendChild(h);
    }
  });
}