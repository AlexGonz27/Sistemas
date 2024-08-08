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
                
                    $descripcion = $_POST['Descripcion'];
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
                                // Establecer el tamaño deseado
                                $max_width = 1350;
                                $max_height = 1080;
                            
                                // Obtener las dimensiones originales
                                list($width, $height) = getimagesize($_FILES["imagen"]["tmp_name"]);
                                
                                // Calcular las nuevas dimensiones
                                $ratio = $width / $height;
                                if ($width > $height) {
                                    $new_width = $max_width;
                                    $new_height = $max_width / $ratio;
                                } else {
                                    $new_height = $max_height;
                                    $new_width = $max_height * $ratio;
                                }
                                $src = imagecreatefromstring(file_get_contents($_FILES["imagen"]["tmp_name"]));
                                $dst = imagecreatetruecolor($new_width, $new_height);
                                imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                                if ($new_width > $max_width || $new_height > $max_height) {
                                    $respuesta['mensaje'] = "no pudo ser redimensionada. {$new_width}px de ancho y {$new_height}px de alto.";
                                }else{
                                    if (imagejpeg($dst, $target_file)) {
                                        $target_dir = "/images/Habitaciones/";
                                        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
                                        $sql = "INSERT INTO tbl_habitaciones_categoria (ID_Categoria, Descripción, imagen, N_Habitación, Estado) VALUES ('$categoria','$descripcion', '$target_file', '$N_Habitacion', '$estado')";
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
                $Image = $_POST['imagen'];

                $ruta = "../../.." . $Image;
                
                // Eliminar el archivo del servidor
                if (file_exists($ruta)) {
                    unlink($ruta);
                    $sql = "DELETE FROM tbl_habitaciones_categoria WHERE ID_Habitaciones = '$ID'";
                        
                    if (mysqli_query($conn, $sql)) {
                        $respuesta['estado'] = 'completado';
                    } 
                }else{
                    $respuesta['mensaje'] = 'No se encontró la imagen!';
                }
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>