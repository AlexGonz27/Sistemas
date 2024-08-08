<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['Clientes'])or empty($_POST['Nivel'])or empty($_POST['Correo'])or empty($_POST['Contraseña'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID_Cliente = $_POST['Clientes'];
                    $Nivel = $_POST['Nivel'];
                    $Correo = $_POST['Correo'];
                    $Contreseña = $_POST['Contraseña'];


                    if(!filter_var($Correo, FILTER_VALIDATE_EMAIL))
                    {
                        $respuesta['mensaje'] = 'Ingrese un Correo valido.'; 
                    }else
                    {

                        $sql = "SELECT * FROM tbl_usuario WHERE Correo = '$Correo'";
                        $result= mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro usuario con ese correo.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_usuario (ID_Cliente,Nivel,Correo,Contraseña) VALUES ('$ID_Cliente','$Nivel','$Correo','$Contreseña')";                        
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
                if (empty($_POST['nivel'])or empty($_POST['correo'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_usuario'];
                    $Nivel = $_POST['nivel'];
                    $Correo = $_POST['correo'];

                    if(!filter_var($Correo, FILTER_VALIDATE_EMAIL))
                    {
                        $respuesta['mensaje'] = 'Ingrese un Correo valido.'; 
                    }else
                    {

                        $sql = "SELECT * FROM tbl_usuario WHERE Correo = '$Correo' AND ID_Usuario != $ID";
                        $result= mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otro usuario con ese correo.';
                        }else
                        {
                            $sql = "UPDATE tbl_usuario SET Nivel='$Nivel', Correo='$Correo' WHERE ID_Usuario = '$ID'";
                            
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
                $ID = $_POST['ID_User'];
    
                $sql = "DELETE FROM tbl_usuario WHERE ID_Usuario = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>