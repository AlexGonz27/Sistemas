<?php
session_start();
include './conexion.php';
$conn = conectarDB(); 
$respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';

    $codigo = codigoUnico($conn);
    $ID = $_SESSION['user_id'];
    $Hab = 1;
    $Fch_reserva = date('Y-m-d');
    $Fch_entrada = $_POST['fch_ent'];
    $Fch_salida = $_POST['fch_sal'];
    $N_Adultos = $_POST['C_Adultos'];
    $N_niños = $_POST['C_Niños'];

    $sql = "INSERT INTO tbl_reservacion (ID_Cliente,ID_Habitacion,Codigo_Reserva,Fecha_Reservación,
                        Fecha_Entrada,Fecha_Salida,N_Adultos,N_Ninos,Sn_mascotas,Estado,Monto) 
                    VALUES ('$ID','$Hab','$codigo','$Fch_reserva','$Fch_entrada','$Fch_salida','$N_Adultos','$N_niños',1,'Pendiente',100)";                        
    if (mysqli_query($conn,$sql)) {
        $reserva_id = mysqli_insert_id($conn);
        foreach ($servicios as $servicio) {
            $conect = "INSERT INTO tbl_reservacion_servicios (`ID_reservacion`, `ID_servicio`) VALUES ('$reserva_id','$servicio')";
            if (mysqli_query($conn,$conect)) {
                $respuesta['mensaje'] = "Nuevo servicio creado exitosamente";
            } else {
                $respuesta['mensaje'] = "No se pudo añadir el servicio" ;
            }
        }
        $respuesta['estado'] = 'completado';
    } else {
        $respuesta['mensaje'] = 'No se pudo agregar la reserva';
    }

}
mysqli_close($conn);
function generarCodigo() {
    $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numeros = '0123456789';
    $codigo = '';

    // Generar dos letras aleatorias
    for ($i = 0; $i < 2; $i++) {
        $codigo .= $letras[rand(0, strlen($letras) - 1)];
    }

    // Generar dos números aleatorios
    for ($i = 0; $i < 2; $i++) {
        $codigo .= $numeros[rand(0, strlen($numeros) - 1)];
    }

    return $codigo;
}
function codigoUnico($conexion) {
    do {
        $codigo = generarCodigo();
        $query = "SELECT COUNT(*) FROM tbl_reservacion WHERE Codigo_Reserva = '$codigo'";
        $resultado = mysqli_query($conexion, $query);
        $fila = mysqli_fetch_array($resultado);
    } while ($fila[0] > 0);

    return $codigo;
}
?>
