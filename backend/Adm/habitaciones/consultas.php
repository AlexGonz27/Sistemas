<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['Categoria'])or empty($_POST['NumHabitaciones'])or empty($_POST['Estado'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $categoria = $_POST['Categoria'];
                    $N_Habitacion = $_POST['NumHabitaciones'];
                    $estado = $_POST['Estado'];

                    if(!is_numeric($N_Habitacion))
                    {
                        $respuesta['mensaje'] = 'Ingrese un numero de habitacion valido.';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_habitaciones_categoria WHERE N_Habitación = '$N_Habitacion'";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra habitacion con el mismo numero.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_habitaciones_categoria (ID_Categoria,N_Habitación,Estado) VALUES ('$categoria','$N_Habitacion','$estado')";                        
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
                if (empty($_POST['Categoria'])or empty($_POST['NumHabitaciones'])or empty($_POST['Estado'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_habit_modifi'];
                    $Categoria = $_POST['Categoria'];
                    $N_Habit = $_POST['NumHabitaciones'];
                    $Estado = $_POST['Estado'];
                    
                    if(!is_numeric($N_Habit))
                    {
                        $respuesta['mensaje'] = 'Ingrese un numero de habitacion valido.';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_habitaciones_categoria WHERE N_Habitación = '$N_Habit' AND ID_Habitaciones != $ID";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra habitacion con el mismo numero.';
                        }else
                        {
                            $sql = "UPDATE tbl_habitaciones_categoria SET ID_Categoria='$Categoria',N_Habitación='$N_Habit',Estado='$Estado' WHERE ID_Habitaciones = '$ID'";
                        
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
                $ID = $_POST['ID_Hab'];
    
                $sql = "DELETE FROM tbl_habitaciones_categoria WHERE ID_Habitaciones = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>