<?php
session_start();

// Datos de conexión a la base de datos
$conn = mysqli_connect('b03oim8xwvf4jpuq5buf-mysql.services.clever-cloud.com', 
                        'uqcyvv3hrdg9nufd', 
                        'Rbi6QbmCFiZViAS8dcvY', 
                        'b03oim8xwvf4jpuq5buf');

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
                 break;
        }

        exit();
    
    }   else {
        // Contraseña incorrecta
        echo "<script>alert('Correo electrónico o contraseña incorrectos')
                        window.location.href = './inic.php'
                </script>";
    }
}   else {
        // Usuario no encontrado
        echo "<script>alert('Usuario no encontrado')
                        window.location.href = './inic.php'
                </script>";
}


$conn->close();
?>

