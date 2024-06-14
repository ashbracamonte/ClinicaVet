<?php
include('conexion.php');

class Result
{}
$response = new Result();

if(isset($_POST['data'])){
    $pet = json_decode($_POST['data']);

    $repetido = $conn->query("SELECT * FROM patietns WHERE namepet = '$pet->name'");

    if (mysqli_num_rows($repetido) > 0) {
        $response->result = false;
        $response->msg = "Esa mascota ya está registrada";
    }else{
        $birth = strtotime($pet->birth);
        $date = date("Y-m-d", $birth);
        $response->date = $date;
        $resultado = $conn->query("INSERT INTO patietns (namepet, id_client, birth, gender) VALUES('$pet->name', $pet->userid, '$date', '$pet->gender')");
        $response->result = $pet;
        $response->msg = "Registro exitoso";
    }

}

$response->data = $_POST['data'];

echo json_encode($response);

?>