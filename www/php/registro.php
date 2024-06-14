<?php
include('conexion.php');

class Result
{}
$response = new Result();

if(isset($_POST['data'])){
    $user = json_decode($_POST['data']);

    $repetido = $conn->query("SELECT * FROM clients WHERE email = '$user->mail'");

    if (mysqli_num_rows($repetido) > 0) {
        $response->result = false;
        $response->msg = "Ese correo ya está registrado";
    }else{
        $resultado = $conn->query("INSERT INTO clients (name, email, pass, lastname, phone) VALUES('$user->name', '$user->mail', '$user->pass', '$user->lastname', $user->phone)");
        // Obtén el ID del último registro insertado
        $last_id = mysqli_insert_id($conn);

        // Realiza una consulta para obtener la fila completa
        $result = $conn->query("SELECT * FROM clients WHERE id = $last_id");

        // Obtiene la fila como un objeto
        $row = mysqli_fetch_object($result);

        $response->result = $row;
        $response->msg = "Registro exitoso";
    }

}

echo json_encode($response);

?>