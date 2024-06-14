<?php
include('conexion.php');

class Result
{}
$response = new Result();

$response->result = false;
if(isset($_POST['data'])){
    $data = json_decode($_POST['data']);

    $vet = $conn->query("SELECT * FROM vet WHERE specialization = '$data'");
    while ($resultado = mysqli_fetch_assoc($vet))
    {
        $datos[] = $resultado;
    }
    $response->vets = $datos;
    $response->result = true;
}

echo json_encode($response);

?>