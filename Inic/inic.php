<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css ">
    <title>Inicio de sesion</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="container-form">
            <form method="post" class="sign-in forma">
                 <h2>Iniciar Sesión</h2>
                 <span>Ingrese su usuario y contrasena</span>
                 <div class="container-input">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <input name="usuario" type="text" placeholder="Usuario"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input name="contra" type="password" placeholder="Contraseña"> 
                 </div>
                 <button type="submit" class="button" style="background-color: #009970;">INICIAR SESION</button>
             </form>
        </div>

         <div class="container-form">
            <form class="sign-up registrar">
                <h2>Registrarse</h2>
                 <span>Ingrese los datos rellenando todos los campos.</span>
                 <div class="container-input">
                     <select class="mi-select" name="Nacionalidad">
                         <option value="V">V</option>
                         <option value="E">E</option>
                         <option value="J">J</option>
                     </select>
                    <input type="text" placeholder="Cedula de Identidad" name="Identidad"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="people-circle-outline"></ion-icon>
                    <input type="text" placeholder="Nombre" name="Nombre_Razon"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="today-outline"></ion-icon>
                    <input type="date" placeholder="Fecha de Nacimiento" name="Fecha_nac"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="people-circle-outline"></ion-icon>
                    <input type="text" placeholder="Direccion" name="Direc"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="call-outline"></ion-icon>
                    <input type="text" placeholder="Numero Telefonico" name="Num_tlf"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="mail" placeholder="Correo" name="Correo"> 
                 </div>
                 <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Contrasena" name="Contra"> 
                 </div>
                 <button class="button" style="background-color: #F6AD34;">Guardar Registro</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>