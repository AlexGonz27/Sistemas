<?php
session_start();

// Datos de conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'gestion_reservas');

// Verificar conexión
if(!$conn){
    die("Error DB");
}

// Recibir datos del formulario
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contra'];

// Consulta SQL para verificar el usuario
$sql = "SELECT * FROM tbl_usuario WHERE Correo = '$usuario'";
$resultado = mysqli_query($conn,$sql);

if ($resultado->num_rows > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    // Verificar la contraseña en texto plano
    if ($contrasenia == $fila['Contraseña']) {
        // Contraseña correcta, iniciar sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $fila['ID_Usuario'];
        $_SESSION['user_email'] = $fila['Correo'];
        
        switch ($fila['Nivel']) {
              case '1':
                 header("Location: ../backend/Adm");
                 break;
              case '2':
                header("Location: ../backend/Op");
                 break;
              case '3':
                header("Location: ../User");
                 break;
            
              default:
                 # code...
                 break;
        }

        exit();
    
    }   else {
        // Contraseña incorrecta
        echo "Correo electrónico o contraseña incorrectos.";
    }
}   else {
        // Usuario no encontrado
        echo "Usuario no encontrado";
}


$conn->close();
?>

