<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['Clientes'])or empty($_POST['Reservas'])or empty($_POST['Monto'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID_Cliente = $_POST['Clientes'];
                    $ID_Reservas = $_POST['Reservas'];
                    $Monto = $_POST['Monto'];
                    


                    if(!is_numeric($Monto))
                    {
                        $respuesta['mensaje'] = 'Ingrese un monto numerico.'; 
                    }else
                    {

                        $sql = "SELECT * FROM tbl_pagos WHERE ID_cliente = '$ID_Cliente' and ID_Reserva = '$ID_Reservas'";
                        $result= mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro pago hecho por el cliente para la misma reserva, Modifique el ya existente.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_pagos (ID_Cliente,ID_Reserva,Monto) VALUES ('$ID_Cliente','$ID_Reservas','$Monto')";                        
                            if (mysqli_query($conn, $sql)) {
                                $respuesta['estado'] = 'completado';
                            } else {
                                $respuesta['mensaje'] = 'Error al insertar la categoria';
                            }
                        }        
                        
                    }      
                }  
            }
            if (isset($_POST['modificar'])){
                if (empty($_POST['Monto'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Pago'];
                    $Monto = $_POST['Monto'];
                    

                    if(!is_numeric($Monto))
                    {
                        $respuesta['mensaje'] = 'Ingrese un monto numerico.'; 
                    }else
                    {

                        
                        $sql = "UPDATE tbl_pagos SET Monto='$Monto' WHERE ID_Pago = '$ID'";
                            
                        if (mysqli_query($conn, $sql)) {
                            $respuesta['estado'] = 'completado';
                        } else {
                            $respuesta['mensaje'] = 'Error al modificar la categoria';
                        }
                    }                                                  
                }
            }
            if (isset($_POST['eliminar'])){
                $ID = $_POST['ID_Pago'];
    
                $sql = "DELETE FROM tbl_pagos WHERE ID_Pago = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>