<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['tipo'])or empty($_POST['desc'])or empty($_POST['cost'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $tipo = $_POST['tipo'];
                    $descripcion = $_POST['desc'];
                    $costo = $_POST['cost'];


                    if(!is_numeric($costos))
                    {
                        $respuesta['mensaje'] = 'Los precios deben ser numericos.'; 
                    }else
                    {

                        $sql = "SELECT * FROM tbl_servicios WHERE Descripción = '$descripcion'";
                        $result= mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro servicio con la misma descripcion.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_servicios (Tipo,Descripción,Costo) VALUES ('$tipo','$descripcion','$costo')";                        
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
                if (empty($_POST['tipo'])or empty($_POST['desc'])or empty($_POST['cost'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Serv'];
                    $tipo = $_POST['tipo'];
                    $descripcion = $_POST['desc'];
                    $costo = $_POST['cost'];

                    if(!is_numeric($costo))
                    {
                        $respuesta['mensaje'] = 'Los precios deben ser numericos.'; 
                    }else
                    {

                        $sql = "SELECT * FROM tbl_servicios WHERE Descripción = '$descripcion' AND ID_Servicios != $ID";
                        $result= mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro servicio con la misma descripcion.';
                        }else
                        {
                            $sql = "UPDATE tbl_servicios SET Tipo='$tipo',Descripción='$descripcion',Costo='$costo' WHERE ID_Servicios = '$ID'";
                            
                            if (mysqli_query($conn, $sql)) {
                                $respuesta['estado'] = 'completado';
                            } else {
                                $respuesta['mensaje'] = 'Error al modificar la categoria';
                            }
                        }                                                  
                        
                    } 
                }
            }
            if (isset($_POST['eliminar'])){
                $ID = $_POST['ID_Serv'];
    
                $sql = "DELETE FROM tbl_servicios WHERE ID_Servicios = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>