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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido','nivel' => '0'];

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
            $_SESSION['user_id'] = $fila['ID_Cliente'];
            $_SESSION['user_email'] = $fila['Correo'];

            $respuesta['estado'] = 'completado';
            $respuesta['nivel'] = $fila['Nivel'];
        }   else {
            // Contraseña incorrecta
            $respuesta['mensaje'] = 'Correo electrónico o contraseña incorrectos';
        }
    }   else {
            // Usuario no encontrado
            $respuesta['mensaje'] = 'Usuario no encontrado';
    }
    echo json_encode($respuesta);
}

$conn->close();
?>
