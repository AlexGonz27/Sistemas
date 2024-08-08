<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['Habitacion']) or empty($_POST['Fch_Entrada']) or empty($_POST['Fch_Salida'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $codigo = codigoUnico($conn);
                    $ID = $_POST['ID_Clt'];
                    $Hab = $_POST['Habitacion'];
                    $Fch_reserva = $_POST['Fch_Reserva'];
                    $Fch_entrada = $_POST['Fch_Entrada'];
                    $Fch_salida = $_POST['Fch_Salida'];
                    $N_Adultos = $_POST['N_Adultos'];
                    $N_niños = $_POST['N_Niños'];
                    $Mascotas = $_POST['Mascotas'];

                    $sql = "INSERT INTO tbl_reservacion (ID_Cliente,ID_Habitacion,Codigo_Reserva,Fecha_Reservación,
                                        Fecha_Entrada,Fecha_Salida,N_Adultos,N_Ninos,Sn_mascotas,Estado,Monto) 
                                    VALUES ('$ID','$Hab','$codigo','$Fch_reserva','$Fch_reserva','$Fch_salida','$N_Adultos','$N_niños','$Mascotas','Pendiente',100)";                        
                    if (mysqli_query($conn,$sql)) {
                        $respuesta['estado'] = 'completado';
                    } else {
                        $respuesta['mensaje'] = 'Ha ocurrido un error al agregar su reserva';
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
                        $sql = "SELECT * FROM tbl_categorias WHERE Nombre = '$nombre' AND ID_Categoria != $ID";
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
        function generarCodigo() {
            $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $numeros = '0123456789';
            $codigo = '';
        
            // Generar dos letras aleatorias
            for ($i = 0; $i < 2; $i++) {
                $codigo .= $letras[rand(0, strlen($letras) - 1)];
            }
        
            // Generar dos números aleatorios
            for ($i = 0; $i < 2; $i++) {
                $codigo .= $numeros[rand(0, strlen($numeros) - 1)];
            }
        
            return $codigo;
        }
        function codigoUnico($conexion) {
            do {
                $codigo = generarCodigo();
                $query = "SELECT COUNT(*) FROM tbl_reservacion WHERE Codigo_Reserva = '$codigo'";
                $resultado = mysqli_query($conexion, $query);
                $fila = mysqli_fetch_array($resultado);
            } while ($fila[0] > 0);
        
            return $codigo;
        }
    ?>