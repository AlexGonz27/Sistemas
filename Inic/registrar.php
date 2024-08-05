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
    $Nac = $_POST['Nacionalidad'];
    $Identidad = $_POST['Identidad'];
    $Nombre = $_POST['Nombre_Razon'];
    $Fecha = $_POST['Fecha_nac'];
    $Direc = $_POST['Direc'];
    $Num_Tlf = $_POST['Num_tlf'];
    $Correo = $_POST['Correo'];
    $Contra = $_POST['Contra'];

    // Consulta SQL para insertar en tbl_cliente_persona
    $sql = "INSERT INTO tbl_cliente_persona
                (`Nacionalidad`, `Identificación`, `Nombre_Razón_Social`, `Dirección`, `Teléfono`, `Fecha_Nacimiento`) 
                VALUES ('$Nac','$Identidad','$Nombre','$Direc','$Num_Tlf','$Fecha')";
    if(mysqli_query($conn,$sql)){
        $query = "SELECT * FROM tbl_cliente_persona WHERE Nacionalidad = '$Nac' AND Identificación = '$Identidad'";
        $result = mysqli_fetch_assoc(mysqli_query($conn,$query));
        $sqlreg = "INSERT INTO `tbl_usuario`(`ID_Cliente`, `Nivel`, `Correo`, `Contraseña`) 
                    VALUES ('".$result['ID_Cliente']."','3','$Correo','$Contra')";
        if (mysqli_query($conn,$sqlreg)) {
            $respuesta['estado'] = "completado";
        } else {
            $respuesta['mensaje'] = 'Error en la inserción en tbl_usuario: ' . mysqli_error($conn);
        }
    } else {
        $respuesta['mensaje'] = 'Error en la inserción en tbl_cliente_persona: ' . mysqli_error($conn);
    }
    echo json_encode($respuesta);
}
mysqli_close($conn);
?>
