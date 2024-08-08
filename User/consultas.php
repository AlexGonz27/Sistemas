<?php
        include 'conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['modificar'])){
                if (empty($_POST['CI']) or empty($_POST['direc']) or empty($_POST['tlf']) or empty($_POST['fn'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Clt'];
                    $CI = $_POST['CI'];
                    $name_rs = $_POST['name_rs'];
                    $nac = $_POST['Nacionalidad'];
                    $direc = $_POST['direc'];
                    $tlf = $_POST['tlf'];
                    $fn = $_POST['fn'];

                    
                    if(preg_match("/\d/",$name_rs))
                    {
                        $respuesta['mensaje'] = 'El campo nombre no debe contener números!';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_cliente_persona WHERE Identificación = '$CI' AND Nacionalidad = '$nac'  AND ID_Cliente != $ID";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro cliente con la misma identifiación!';
                        }else
                        {
                            $sql = "UPDATE tbl_cliente_persona SET Nacionalidad='$nac',Identificación='$CI',
                                                                    Nombre_Razón_Social='$name_rs',Dirección='$direc',
                                                                    Teléfono='$tlf',Fecha_Nacimiento='$fn' 
                                                                    WHERE ID_Cliente='$ID'";
                        
                            if (mysqli_query($conn, $sql)) {
                                $respuesta['estado'] = 'completado';
                            } else {
                                $respuesta['mensaje'] = 'Error al modificar el cliente';
                            }
                        }
                    } 
                }
            }
            if (isset($_POST['anular'])){
                $ID = $_POST['ID_Res'];
    
                $sql = "UPDATE tbl_reservacion SET Estado ='Anulada' WHERE ID_Reservación = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>