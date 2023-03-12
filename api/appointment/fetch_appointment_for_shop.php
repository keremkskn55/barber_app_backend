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

  $a = $appointment->appointments_for_shop();
  echo json_encode(array('success' => 1, 'message' => 'Appointment Check is fetched', 'appointment' => $a));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
