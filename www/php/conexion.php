<?php
$servername = "localhost"; // Puedes cambiarlo si tu servidor MySQL está en otro lugar
$username = "root";
$password = "";
$database = "clinica";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
else{
    //echo "hola mundo";
}
?>
