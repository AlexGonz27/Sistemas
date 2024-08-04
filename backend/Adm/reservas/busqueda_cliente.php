<?php
include '../conexion.php';
$conn = conectarDB();

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_cliente = $_POST['id_cliente'];

$id_cliente = $conn->real_escape_string($id_cliente);

$sql = "SELECT * FROM tbl_cliente_persona WHERE Identificación = '$id_cliente'";
$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    exit;
}

if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();
    echo json_encode($cliente);
} else {
    echo json_encode(["error" => "No se encontró el cliente"]);
}

$conn->close();
?>
