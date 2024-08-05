<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['Nombre']) or empty($_POST['desc']) or empty($_POST['Nivel']) or empty($_POST['Sueldo'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $Nombre = $_POST['Nombre'];
                    $descripcion = $_POST['desc'];
                    $Nivel = $_POST['Nivel'];
                    $Sueldo = $_POST['Sueldo'];

                    if(!is_numeric($Nivel) or !is_numeric($Sueldo))
                    {
                        $respuesta['mensaje'] = 'Los campos Nivel y Sueldo deben ser numericos.';
                    }else
                    {
                        if(preg_match("/\d/",$Nombre))
                        {
                            $respuesta['mensaje'] = 'Los Nombres no deben contener numeros.';
                        }else
                        {
                            $sql = "SELECT * FROM tbl_cargos WHERE Nombre = '$Nombre'";
                            $result= mysqli_query($conn, $sql);
    
                            if(mysqli_num_rows($result) > 0)
                            {
                                $respuesta['mensaje'] = 'Ya un cargo con el mismo nombre.';
                            }else
                            {
                                $sql = "INSERT INTO tbl_cargos (Nombre,Descripción,Nivel,Sueldo) VALUES ('$Nombre','$descripcion','$Nivel','$Sueldo')";                        
                                if (mysqli_query($conn, $sql)) {
                                    $respuesta['estado'] = 'completado';
                                } else {
                                    $respuesta['mensaje'] = 'Error al insertar la categoria';
                                }
                            }        
                        }                        
                        
                    }      
                }  
            }
            if (isset($_POST['modificar'])){
                if (empty($_POST['Nombre']) or empty($_POST['desc']) or empty($_POST['Nivel']) or empty($_POST['Sueldo'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Car'];
                    $Nombre = $_POST['Nombre'];
                    $descripcion = $_POST['desc'];
                    $Nivel = $_POST['Nivel'];
                    $Sueldo = $_POST['Sueldo'];
                    
                    if(!is_numeric($Nivel) or !is_numeric($Sueldo))
                    {
                        $respuesta['mensaje'] = 'Los campos Nivel y Sueldo deben ser numericos.';
                    }else
                    {
                        if(preg_match("/\d/",$Nombre))
                        {
                            $respuesta['mensaje'] = 'Los Nombres no deben contener numeros.';
                        }else
                        {
                            $sql = "SELECT * FROM tbl_cargos WHERE Nombre = '$Nombre' and ID_Cargo != $ID";
                            $result= mysqli_query($conn, $sql);
    
                            if(mysqli_num_rows($result) > 0)
                            {
                                $respuesta['mensaje'] = 'Ya existe un cargo con el mismo nombre.';
                            }else
                            {
                                $sql = "UPDATE tbl_cargos SET Nombre='$Nombre',Descripción='$descripcion',Nivel='$Nivel',Sueldo='$Sueldo' WHERE ID_Cargo = '$ID'";
                            
                                if (mysqli_query($conn, $sql)) {
                                    $respuesta['estado'] = 'completado';
                                } else {
                                    $respuesta['mensaje'] = 'Error al modificar la categoria';
                                }
                            }
                        }                        
                        
                    } 
                }
            }
            if (isset($_POST['eliminar'])){
                $ID = $_POST['ID_Car'];
    
                $sql = "DELETE FROM tbl_cargos WHERE ID_Cargo = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>