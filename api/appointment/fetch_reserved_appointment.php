<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Appointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($appointment->validate_params($_POST['shop_id'])) {
    $appointment->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  if ($appointment->validate_params($_POST['worker_id'])) {
    $appointment->worker_id = $_POST['worker_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'worker_id is required'));
    die();
  }

  if ($appointment->validate_params($_POST['date'])) {
    $appointment->date = $_POST['date'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'date is required'));
    die();
  }

  if ($appointment->validate_params($_POST['start_hour'])) {
    $appointment->start_hour = $_POST['start_hour'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'start_hour is required'));
    die();
  }

  $a = $appointment->a_reserved_appointment();
  echo json_encode(array('success' => 1, 'message' => 'Appointment Check is fetched', 'appointment' => $a));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
