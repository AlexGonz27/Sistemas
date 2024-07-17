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
   <?php
      function conectarDB(){
         $serverName = "localhost"; // Cambia esto al nombre de tu servidor SQL
         $databaseName = "gestion_reservas"; // Cambia esto al nombre de tu base de datos
         $username = "root"; // Cambia esto al nombre de usuario
         $password = ""; // Cambia esto a la contraseña
     
         // Crear conexión
         $conn = new mysqli($serverName, $username, $password, $databaseName);
     
         // Verificar la conexión
         if ($conn->connect_error) {
             die("La conexión falló: " . $conn->connect_error);//pendejo
         }
         return $conn;
      }
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $usuario = $_POST['usuario'];
         $contrasenia = $_POST['contrasena'];
         $conn = conectarDB();
         $sql = "SELECT * FROM tbl_usuario WHERE Correo = '$usuario'";

         $resultado = mysqli_query($conn,$sql);
            
         if($fila = mysqli_fetch_assoc($resultado)){
            if ($fila['Contraseña'] === $contrasenia) {
               switch ($fila['Nivel']) {
                  case "1":
                     header('Location: ../Users/Adm/index.php');
                     exit;
                     break;
                  case "2":
                     header('Location: ../Users/Op/index.php');
                     exit;
                     break;
                  case "3":
                     header('Location: ../Users/User/index.php');
                     exit;
                     break;
                  default:
                     echo "Error";
                     exit;
                     break;
               }
            }
            else{
               echo '<p>El usuario o contraseña son incorrectas</p>';
            }
         }
         else {
            echo '<p>El usuario no existe</p>';
         }
    }
    ?>
    <div class="container">
        <div class="container-form">
            <form method="post" action="" class="sign-in">
                 <h2>Iniciar Sesion</h2>
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
                    <input name="contrasena" type="password" placeholder="Contrasena"> 
                 </div>
                 <a href="#">Olvidaste tu contrasena</a>
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

   

    <script src="../main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>