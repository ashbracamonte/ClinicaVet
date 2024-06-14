<?php
include('conexion.php');

class Result
{}
$response = new Result();

$response->result = false;
if(isset($_POST['data'])){
    $user = json_decode($_POST['data']);

    $pets = $conn->query("SELECT * FROM patietns WHERE id_client = '$user'");
    while ($resultado = mysqli_fetch_assoc($pets))
    {
        $datos[] = $resultado;
    }
    $response->pets = $datos;
    $response->result = true;
}

echo json_encode($response);

?>