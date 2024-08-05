<?php
include './conexion.php';
$conn = conectarDB(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
    $sql = "SELECT r.*, h.N_Habitación 
            FROM tbl_reservacion r
            JOIN tbl_habitaciones_categoria h ON r.ID_Habitacion = h.ID_Habitaciones";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $respuesta = ['estado' => 'exito', 'data' => $result];
    } else {
        $respuesta['mensaje'] = 'Error en la consulta: ' . mysqli_error($conn);
    }

    echo json_encode($respuesta);
}
mysqli_close($conn);
?>
