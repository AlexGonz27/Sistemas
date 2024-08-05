<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['nombre']) or empty($_POST['fn'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $nombre = $_POST['nombre'];
                    $fn = $_POST['fn'];

                    if(preg_match("/\d/",$nombre))
                    {
                        $respuesta['mensaje'] = 'Los nombres no deben contener numeros.';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_menores WHERE Nombre_Apellido = '$nombre' and Fecha_Nacimiento = '$fn'";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro menor con el mismo nombre y fecha de nacimiento.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_menores (Nombre_Apellido,Fecha_Nacimiento) VALUES ('$nombre','$fn')";                        
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
                if (empty($_POST['nombre']) or empty($_POST['fn'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Men'];
                    $nombre = $_POST['nombre'];
                    $fn = $_POST['fn'];

                    
                    if(preg_match("/\d/",$nombre))
                    {
                        $respuesta['mensaje'] = 'Los nombres no deben contener numeros.';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_menores WHERE Nombre_Apellido ='$nombre' and Fecha_Nacimiento ='$fn' and ID_Menores != '$ID'";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro menor con el mismo nombre y fecha de nacimiento.';
                        }else
                        {
                            $sql = "UPDATE tbl_menores SET Nombre_Apellido='$nombre',Fecha_Nacimiento='$fn' WHERE ID_Menores = '$ID'";
                        
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
                $ID = $_POST['ID_Men'];
    
                $sql = "DELETE FROM tbl_menores WHERE ID_Menores = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>