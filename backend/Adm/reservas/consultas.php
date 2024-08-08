<?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuesta = ['estado' => 'error', 'mensaje' => 'Ocurrió un error desconocido'];
            if (isset($_POST['agregar'])) {
                if (empty($_POST['Habitacion']) or empty($_POST['Fch_Entrada']) or empty($_POST['Fch_Salida']) or empty($_POST['sel_servi'])) {
                    $respuesta['mensaje'] = 'Alguno de los campos se encuentra vacio.';
                }else
                {
                    $servicios = json_decode($_POST['sel_servi'], true);
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
                                    VALUES ('$ID','$Hab','$codigo','$Fch_reserva','$Fch_entrada','$Fch_salida','$N_Adultos','$N_niños','$Mascotas','Pendiente',100)";                        
                    if (mysqli_query($conn,$sql)) {
                        $reserva_id = mysqli_insert_id($conn);
                        foreach ($servicios as $servicio) {
                            $conect = "INSERT INTO tbl_reservacion_servicios (`ID_reservacion`, `ID_servicio`) VALUES ('$reserva_id','$servicio')";
                            if (mysqli_query($conn,$conect)) {
                                $respuesta['mensaje'] = "Nuevo servicio creado exitosamente";
                            } else {
                                $respuesta['mensaje'] = "No se pudo añadir el servicio" ;
                            }
                        }
                        $respuesta['estado'] = 'completado';
                    } else {
                        $respuesta['mensaje'] = 'No se pudo agregar la reserva';
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
            if (isset($_POST['buscar'])) {
                $ID = mysqli_real_escape_string($conn, $_POST['id_cliente']);
                $NA = mysqli_real_escape_string($conn, $_POST['Nacionalidad']);

                $sql = "SELECT * FROM tbl_cliente_persona WHERE Nacionalidad = '$NA' AND Identificación = '$ID'";

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $fila = mysqli_fetch_assoc($result);
                    echo    "<script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        mostrarinfo(" . json_encode($fila) . ");
                                    });
                                </script>";
                } else {
                    echo    "<script>
                                    var resultado = confirm('¿Deseas agregar el cliente?');
                                    if (resultado) {
                                        window.location.href = '../clientes/clientes.php';
                                    }
                                </script>";
                }
            }
            if (isset($_POST['servicios'])){
    
                $sql = "SELECT * FROM tbl_servicios";
                $result = mysqli_query($conn, $sql); 
                $servicios = array();
                $respuesta['mensaje'] = '';
                while ($fila = mysqli_fetch_assoc($result)) {
                    $respuesta['mensaje'] .= "
                                        <div class='col-md-4 d-flex align-items-stretch mb-3'>
                                            <input type='checkbox' class='btn-check' id='S".$fila['ID_Servicios']."' autocomplete='off' value='".$fila['ID_Servicios']."'>
                                            <label class='btn btn-outline-primary service-box border p-3 w-100' for='S".$fila['ID_Servicios']."' style='min-height: 50px'>".$fila['Tipo']."</label>
                                        </div>";
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