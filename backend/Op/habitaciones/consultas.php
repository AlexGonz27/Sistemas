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
                    $target_dir = "../../../images/Habitaciones/"; // Carpeta donde se guardarán las imágenes
                
                    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $respuesta['mensaje'] = 'El archivo no es una imagen.';
                        $uploadOk = 0;
                    }
                
                    // Verificar si el archivo ya existe
                    if (file_exists($target_file)) {
                        $respuesta['mensaje'] = 'Lo siento, el archivo ya existe.';
                        $uploadOk = 0;
                    }
                
                    // Permitir ciertos formatos de archivo
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        $respuesta['mensaje'] = 'Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.';
                        $uploadOk = 0;
                    }
                
                    $categoria = $_POST['Categoria'];
                    $N_Habitacion = $_POST['NumHabitaciones'];
                    $estado = $_POST['Estado'];
                
                    if (!is_numeric($N_Habitacion)) {
                        $respuesta['mensaje'] = 'Ingrese un número de habitación válido.';
                    } else {
                        $sql = "SELECT * FROM tbl_habitaciones_categoria WHERE N_Habitación = '$N_Habitacion'";
                        $result = mysqli_query($conn, $sql);
                    
                        if (mysqli_num_rows($result) > 0) {
                            $respuesta['mensaje'] = 'Ya existe otra habitación con el mismo número.';
                        } else {
                            if ($uploadOk != 0) {
                                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                                    $target_dir = "/images/Habitaciones/";
                                    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
                                    $sql = "INSERT INTO tbl_habitaciones_categoria (ID_Categoria, imagen, N_Habitación, Estado) VALUES ('$categoria', '$target_file', '$N_Habitacion', '$estado')";
                                    if (mysqli_query($conn, $sql)) {
                                        $respuesta['estado'] = 'completado';
                                    } else {
                                        $respuesta['mensaje'] = 'Error al insertar la categoría: ' . mysqli_error($conn);
                                    }
                                } else {
                                    $respuesta['mensaje'] = 'Error al mover el archivo subido.';
                                }
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