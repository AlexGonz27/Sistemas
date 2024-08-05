<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css ">
    <title>Inicio de sesion</title>
    
</head>
<body>
    <div class="container">
        <div class="container-form">
            <form method="post" action="login.php" class="sign-in">
                 <h2>Iniciar Sesión</h2>
                 <div class="social-networks">
                    <ion-icon name="call-outline"></ion-icon>
                 </div>
                 <span>Ingrese su usuario y contrasena</span>
                 <div class="container-input">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <input name="usuario" type="text" placeholder="Usuario"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input name="contra" type="password" placeholder="Contraseña"> 
                 </div>
                 <button class="button" style="background-color: #ff8000;">INICIAR SESION</button>
             </form>
        </div>

         <div class="container-form">
            <form class="sign-up">
                <h2>Registrarse</h2>
                 <span>Ingrese los datos rellenando todos los campos.</span>
                 <div class="container-input">
                    <ion-icon name="people-circle-outline"></ion-icon>
                    <input type="text" placeholder="Nombre"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="people-circle-outline"></ion-icon>
                    <input type="text" placeholder="Apellidos"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="today-outline"></ion-icon>
                    <input type="number" placeholder="Fecha de Nacimiento"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="document-lock-outline"></ion-icon>
                    <input type="number" placeholder="Cedula de Identidad"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="call-outline"></ion-icon>
                    <input type="number" placeholder="Numero Telefonico"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="folder-outline"></ion-icon>
                    <input type="number" placeholder="Nombre del Cargo"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Contrasena"> 
                 </div>
                 <button class="button" style="background-color: #007fff;">Guardar Registro</button>
            </form>
         </div>

         <div class="container-welcome">
            <div class="welcome-sing-up welcome">
                <h3> Bienvenido!</h3>
                <p>Ingrese sus datos para acceder a todas las funciones del sitio</p>
                <button class="button" id="btn-sing-up">Registrarse</button>
            </div>
            <div class="welcome-sing-in welcome">
                <h3>Hola!</h3>
                <p>Registrese con sus datos personales para poder ser un usuario</p>
                <button class="button" id="btn-sing-in">Iniciar sesion</button>
            </div>  
         </div>
    </div>

   

    <script src="./main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>