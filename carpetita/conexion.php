<?php
    function conectarDB(){
        $serverName = "localhost"; // Cambia esto al nombre de tu servidor SQL
        $databaseName = "gestion_reservas"; // Cambia esto al nombre de tu base de datos
        $username = "root"; // Cambia esto al nombre de usuario
        $password = "1234"; // Cambia esto a la contraseña
           // Crear conexión
        $conn = new mysqli($serverName, $username, $password, $databaseName);
           // Verificar la conexión
        if ($conn->connect_error) {
           die("La conexión falló: " . $conn->connect_error);
        }
        return $conn;
    }
?>