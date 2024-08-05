<?php
function verDisp($fechaEntrada, $fechaSalida, $conn) {
    $sql = "SELECT * FROM tbl_habitaciones_categoria";
    $resultado = mysqli_query($conn, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $id = $fila['ID_Habitaciones'];
        $sqlRev = "SELECT * FROM tbl_reservacion WHERE (ID_Habitación = $id) AND (Fecha_Entrada < $fechaSalida AND fecha_salida > $fechaEntrada);";
        $result = mysqli_query($conn, $sqlRev); 
        if (mysqli_num_rows($result) < 1) echo '<option value="' . $fila['ID_Habitaciones'] . '">' . $fila['N_Habitación'] . '</option>';
    } 
}

?>