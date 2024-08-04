<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['nombre']) or empty($_POST['desc']) or empty($_POST['cap']) or empty($_POST['cost'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['desc'];
                    $capacidad = $_POST['cap'];
                    $costo = $_POST['cost'];

                    if(!is_numeric($capacidad) or !is_numeric($costo))
                    {
                        $respuesta['mensaje'] = 'Los campos capacidad y precio deben ser numericos.';
                    }else
                    {
                        $sql = "SELECT * FROM tbl_categorias WHERE Nombre = '$nombre'";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra categoria con el mismo nombre.';
                        }else
                        {
                            $sql = "INSERT INTO tbl_categorias (Nombre,Descripción,Capacidad,Precio) VALUES ('$nombre','$descripcion','$capacidad','$costo')";                        
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
                if (empty($_POST['nombre']) or empty($_POST['desc']) or empty($_POST['cap']) or empty($_POST['cost'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $ID = $_POST['ID_Cat'];
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['desc'];
                    $capacidad = $_POST['cap'];
                    $costo = $_POST['cost'];
                    
                    if(!is_numeric($capacidad) or !is_numeric($costo))
                    {
                        $respuesta['mensaje'] = 'Los campos capacidad y precio deben ser numericos.'; 
                    }else
                    {
                        $sql = "SELECT * FROM tbl_categorias WHERE Nombre = '$nombre' and ID_Categoria != $ID";
                        $result= mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0)
                        {
                            $respuesta['mensaje'] = 'Ya existe otra categoria con el mismo nombre.';
                        }else
                        {
                            $sql = "UPDATE tbl_categorias SET Nombre='$nombre',Descripción='$descripcion',Capacidad='$capacidad',Precio='$costo' WHERE ID_Categoria = '$ID'";
                        
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
                $ID = $_POST['ID_Cat'];
    
                $sql = "DELETE FROM tbl_categorias WHERE ID_Categoria = '$ID'";
                    
                if (mysqli_query($conn, $sql)) {
                    $respuesta['estado'] = 'completado';
                } 
            } 
            echo json_encode($respuesta);
        }
        mysqli_close($conn);
    ?>