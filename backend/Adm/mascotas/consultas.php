<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['nombre']) or empty($_POST['det']) or empty($_POST['tipo'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $nombre = $_POST['nombre'];
                    $detalles = $_POST['det'];
                    $tipo = $_POST['tipo'];

                    if(preg_match("/\d/",$tipo)||preg_match("/\d/",$nombre))
                    {
                        $respuesta['mensaje'] = 'Los campos tipo y nombre no deben contener numeros.';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_mascotas WHERE Nombre = '$nombre'";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra mascota con el mismo nombre.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_mascotas (Tipo,Nombre,Detalles) VALUES ('$tipo','$nombre','$detalles')";                        
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
                if (empty($_POST['nombre']) or empty($_POST['det']) or empty($_POST['tipo'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Mas'];
                    $nombre = $_POST['nombre'];
                    $detalles = $_POST['det'];
                    $tipo = $_POST['tipo'];

                    
                    if(preg_match("/\d/",$tipo)||preg_match("/\d/",$nombre))
                    {
                        $respuesta['mensaje'] = 'Los campos tipo y nombre no deben contener numeros.';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_mascotas WHERE Nombre = '$nombre' and ID_Mascotas != $ID";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra mascota con el mismo nombre.';
                        }else
                        {
                            $sql = "UPDATE tbl_mascotas SET Nombre='$nombre',Detalles='$detalles',Tipo='$tipo' WHERE ID_Mascotas = '$ID'";
                        
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
                $ID = $_POST['ID_Mas'];
    
                $sql = "DELETE FROM tbl_mascotas WHERE ID_Mascotas = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>