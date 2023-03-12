<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Appointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

  if ($appointment->validate_params($_POST['user_id'])) {
    $appointment->user_id = $_POST['user_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'user_id is required'));
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

  if ($appointment->validate_params($_POST['taken_hour'])) {
    $appointment->taken_hour = $_POST['taken_hour'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'taken_hour is required'));
    die();
  }

  if ($appointment->validate_params($_POST['note'])) {
    $appointment->note = $_POST['note'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'note is required'));
    die();
  }

  if ($appointment->validate_params($_POST['price'])) {
    $appointment->price = $_POST['price'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'price is required'));
    die();
  }

  if ($id = $appointment->add_appointment()){
      echo json_encode(array('success' => 1, 'message' => 'Appointment is added', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
