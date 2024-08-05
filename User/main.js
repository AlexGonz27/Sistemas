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
    Nombre_Razón_Social: "Nombre: ",
    Teléfono: "Teléfono: "
  };
  const orden = ["Nombre_Razón_Social", "Identificación", "Fecha_Nacimiento", "Dirección", "Teléfono"];
  orden.forEach(key => {
    if (datos[key]) {
      if(key == "Identificación"){
        var h = document.createElement("h5");
        h.textContent = etiquetas[key] + datos['Nacionalidad'] + "-" + datos[key];
        document.getElementById('datos_usuario').appendChild(h);
      } else{
        var h = document.createElement("h5");
        h.textContent = etiquetas[key] + datos[key];
        document.getElementById('datos_usuario').appendChild(h);
      }
    }
  });
}