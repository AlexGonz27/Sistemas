<?php
if($_SERVER["REQUEST_METHOD"] == "GET")
{
    include_once '../conexion.php';
    $conn = conectarDB();
    $id = $_GET['id'];
    $query = "SELECT * FROM tbl_habitaciones_categoria WHERE ID_Habitaciones = '".$id."'";
    $result = $conn->query($query);
    if($conn->affected_rows > 0){
        while($row=$result->fetch_assoc()){
            $array=$row['N_Habitación'];
        }
        echo json_encode($array);
    }else{
        echo "No hay registros";
    }
    $result->close();
    $conn->close();
}





?>