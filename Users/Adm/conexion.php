<?php
    function conectarDB(){
        $serverName = "localhost"; // Cambia esto al nombre de tu servidor SQL
        $databaseName = "b03oim8xwvf4jpuq5buf"; // Cambia esto al nombre de tu base de datos
        $username = "uqcyvv3hrdg9nufd"; // Cambia esto al nombre de usuario
        $password = "Rbi6QbmCFiZViAS8dcvY"; // Cambia esto a la contraseña
           // Crear conexión
        $conn = new mysqli($serverName, $username, $password, $databaseName);
           // Verificar la conexión
        if ($conn->connect_error) {
           die("La conexión falló: " . $conn->connect_error);
        }
        return $conn;
    }
?>