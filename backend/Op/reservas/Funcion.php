<?php
    include '../conexion.php';
    $conn = conectarDB(); 

    if(isset($_POST['F_E']) && isset($_POST['F_S'])) {
        $FE = $_POST['F_E'];
        $FS = $_POST['F_S'];

        echo '<option value="">Seleccionar una habitación</option>';

        $sql = "SELECT * FROM tbl_habitaciones_categoria;";
        $resultado = mysqli_query($conn, $sql);
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $id = $fila['ID_Habitaciones'];
            $sqlRev = "SELECT * FROM tbl_reservacion WHERE ID_Habitacion = '$id' AND Fecha_Entrada <= '$FS' AND Fecha_Salida >= '$FE';";
            $result = mysqli_query($conn, $sqlRev); 
            if (mysqli_num_rows($result) < 1) echo '<option value="' . $fila['ID_Habitaciones'] . '">' . $fila['N_Habitación'] . '</option>';
        } 
        mysqli_close($conn);
    }
    





?>











