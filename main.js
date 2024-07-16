const container = document.querySelector(".container")
const btnSingIn = document.getElementById("btn-sing-in")
const btnSingUp = document.getElementById("btn-sing-up")

btnSingIn.addEventListener("click",()=>{
    container.classList.remove("toggle")
});
btnSingUp.addEventListener("click",()=>{
    container.classList.add("toggle")
});

function ComprobarSesion(){
    const textUsuario = document.getElementById('text-usuario').value
    const textContraseña = document.getElementById('text-contrasenia').value

    if(textUsuario == 'admin' && textContraseña == '1234'){
        window.opener.href('./Adm/index.php') 
    }
}