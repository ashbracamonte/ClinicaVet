<?php
include('conexion.php');

class Result
{
}
$response = new Result();

if (isset($_POST['data'])) {
    $data = json_decode($_POST['data']);
    $hour = date("H", strtotime($data->fecha));
    $date = new DateTime($data->fecha);

    $vetHours = $conn->query("SELECT `entry`, `exit` FROM vet WHERE id='$data->id_veterinario' ");
    $resultado = mysqli_fetch_assoc($vetHours);

    if (!($hour >= date("H", strtotime($resultado['entry'])) && $hour <= date("H", strtotime($resultado['exit'])))) {
        $response->msg = "El veterinario no está disponible en ese horario, seleccione uno diferente";
    } else {

        $ocupado = $conn->query("SELECT * FROM appointments WHERE date_time='" . $date->format('Y-m-d H:i:s') . "'");

        if (mysqli_num_rows($ocupado) > 0) {
            $response->msg = "Ese horario ya está ocupado, seleccione otro";
        } else {
            $appointment = $conn->query("INSERT INTO appointments (`date_time`, `notes`, `id_patient`, `id_vet`) VALUES('" . $date->format('Y-m-d H:i:s') . "', '$data->notas', '$data->id_paciente', '$data->id_veterinario')");
            if ($appointment) {
                $response->msg = 'Cita agendada con éxito';
            } else {
                $response->msg = 'Ocurrió un error';
            }
        }
    }
}

$response->data = json_decode($_POST['data']);
echo json_encode($response);
