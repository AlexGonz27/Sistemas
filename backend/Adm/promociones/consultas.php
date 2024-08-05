<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['nombre']) or empty($_POST['descrip']) or empty($_POST['descuento'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descrip'];
                    $descuento = $_POST['descuento'];


                    if(!is_numeric($descuento))
                    {
                        $respuesta['mensaje'] = 'Los descuentos deben ser numericos.'; 
                    }else
                    {

                        $sql = "SELECT * FROM tbl_promociones WHERE Nombre = '$nombre'";
                        $result= mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra promocion con el mismo nombre.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_promociones(Nombre,Descripción,Descuento) VALUES ('$nombre','$descripcion','$descuento')";                        
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
                if (empty($_POST['nombre']) or empty($_POST['descrip']) or empty($_POST['descuento'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Promo'];
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descrip'];
                    $descuento = $_POST['descuento'];

                    if(!is_numeric($descuento))
                    {
                        $respuesta['mensaje'] = 'Los descuentos deben ser numericos.'; 
                    }else
                    {

                        $sql = "SELECT * FROM tbl_promociones WHERE Nombre = '$nombre' AND ID_Promociones != $ID";
                        $result= mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra promocion con el mismo nombre.';
                        }else
                        {
                            $sql = "UPDATE tbl_promociones SET Nombre='$nombre',Descripción='$descripcion',Descuento='$descuento' WHERE ID_Promociones = '$ID'";
                            
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
                $ID = $_POST['ID_Promo'];
    
                $sql = "DELETE FROM tbl_promociones WHERE ID_Promociones = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>