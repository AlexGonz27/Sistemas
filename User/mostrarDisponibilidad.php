<?php
include './conexion.php';
// Conectar a la base de datos
$conn = conectarDB();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Consulta para obtener las habitaciones
    $fecha_entrada = $_POST['fch_ent'];
    $fecha_salida = $_POST['fch_sal'];

    $sql = "SELECT * FROM tbl_habitaciones_categoria ";
    $result = mysqli_query($conn, $sql);
    $roomCount = 0;
    // Verificar si hay habitaciones disponibles
    $respuesta = ['data' => '', 'mensaje' => '','fechas'=> $fecha_entrada.$fecha_salida];
    if (mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            $consulta = "SELECT ID_Habitacion 
                        FROM tbl_reservacion 
                        WHERE ID_Habitacion = ".$fila['ID_Habitaciones']." AND ((Fecha_Entrada <= '$fecha_salida' AND Fecha_Salida >= '$fecha_entrada'))";
            if(mysqli_num_rows(mysqli_query($conn, $consulta)) < 1){                               
                $respuesta['data'] = $fila; 
                // Obtener la categoría de la habitación
                $sql = "SELECT * FROM tbl_categorias WHERE ID_Categoria = '" . $fila['ID_Categoria'] . "'";
                $categoria = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                // Mostrar la imagen del carrusel
                $respuesta['mensaje'] .= "<div id='H". $fila['N_Habitación'] ."' class='carousel-item " . ($roomCount === 0 ? 'active' : '') . "'
                                    data-room-numH='" . $fila['N_Habitación'] . "'  
                                    data-room-name='" . $categoria['Nombre'] . "' 
                                    data-room-description='" . $fila['Descripción'] . "' 
                                    data-room-price='" . $categoria['Precio'] . "'>
                            <div class='d-flex justify-content-center'>
                    <img src='.." . $fila['imagen'] . "' class='d-block img-fluid w-50' alt='room'>
                    </div>
                    </div>";
                $roomCount++;
            }
        }
        echo json_encode($respuesta);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>