<?php


include('conexion.php');

$email = "";
$pass = "";

if (isset($_GET['mail'])) {
    $email = $_GET['mail'];
}

if (isset($_GET['pass'])) {
    $pass = $_GET['pass'];
}

class Result
{}
$response = new Result();

//echo "SELECT * FROM Clients WHERE email='$email' AND pass='$pass'";

$resultado = $conn->query("SELECT * FROM Clients WHERE email='$email' AND pass='$pass'");

if ($resultado = mysqli_fetch_object($resultado)) {
    $response->data = $resultado;
    $response->result = true;
} else {
    $response->result = false;
}

echo json_encode($response);
