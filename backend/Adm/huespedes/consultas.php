<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['Reserva']) or empty($_POST['fi'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $Reserva = $_POST['Reserva'];
                    $fi = $_POST['fi'];

                    
                    $sqlcod = "SELECT * FROM tbl_reservacion Where ID_Reservación = '$Reserva'";
                    $resultado = mysqli_query($conn, $sqlcod);
                    $fila = mysqli_fetch_assoc($resultado);
                    $Cod = $fila['Codigo_Reserva'];
                    
                    $sql = "INSERT INTO tbl_huespedes (ID_Reserva,Fecha_Ingreso,Codigo_Reserva) VALUES ('$Reserva','$fi','$Cod')";                        
                    if (mysqli_query($conn, $sql)) {
                        $respuesta['estado'] = 'completado';
                    } else {
                        $respuesta['mensaje'] = 'Error al insertar la categoria';
                    }
                            
                }                        
                   
            }
            if (isset($_POST['modificar'])){
                if (empty($_POST['fi'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Hue'];
                    $fi = $_POST['fi'];
                    
                    
                            
                    $sql = "UPDATE tbl_huespedes SET Fecha_Ingreso='$fi' WHERE ID_Huesped = '$ID'";
                            
                    if (mysqli_query($conn, $sql)) {
                        $respuesta['estado'] = 'completado';
                    } else {
                        $respuesta['mensaje'] = 'Error al modificar la categoria';
                    }       
                }
            }
            if (isset($_POST['eliminar'])){
                $ID = $_POST['ID_Hue'];
    
                $sql = "DELETE FROM tbl_huespedes WHERE ID_Huesped = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>