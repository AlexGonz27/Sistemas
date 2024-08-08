<?php 
//LOGEADO??
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../../");
    exit;
}
else{
    if ($_SESSION['nivel'] > 2) {
        header("Location: ../../../");
        exit;
    }
}

include '../conexion.php';
$conn = conectarDB(); 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $numE = 0;
    if (empty($_POST['nombre'])or empty($_POST['desc'])or empty($_POST['cap'])or empty($_POST['cost']) ) {
        $numE = 1;   
    }
    if (isset($_POST['agregar'])) {
        if ($numE == 1) {
            echo "<script>alert('Los campos nombre, descripcion, capacidad y precio son obligatorios.');</script>";  
        }else
        {
            $conn = conectarDB();
            $query = "SELECT * FROM tbl_categorias";
            $result= mysqli_query($conn, $query);

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['desc'];
            $capacidad = $_POST['cap'];
            $costo = $_POST['cost'];

            if(!is_numeric($capacidad) or !is_numeric($costo))
            {
                echo "<script>alert('Los campos capacidad y precio deben ser numericos.');</script>";
            }else
            {
                if (mysqli_num_rows($result) > 0) {
                    while($fila = mysqli_fetch_assoc($result)){
                        if ($fila['Nombre'] == $nombre) {
                            $numE=1;
                        }
                    }   
                }
                if($numE == 1)
                {
                    echo "<script>alert('Ya existe otra categoria con el mismo nombre');</script>";
                }else
                {
                    $sql = "INSERT INTO tbl_categorias (Nombre,Descripción,Capacidad,Precio) VALUES ('$nombre','$descripcion','$capacidad','$costo')";                        
                    if (mysqli_query($conn, $sql)) {
                        echo"<script>

                            </script>";
                    } else {
                        echo "Error al insertar fila: " . mysqli_error($conn);
                    }
                }        
            }      
        }  
    }
}
mysqli_close($conn);
?>
