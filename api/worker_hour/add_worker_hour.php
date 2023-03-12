<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Worker_Hour.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($worker_hour->validate_params($_POST['worker_id'])) {
    $worker_hour->worker_id = $_POST['worker_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'worker_id is required'));
    die();
  }

  if ($worker_hour->validate_params($_POST['day'])) {
    $worker_hour->day = $_POST['day'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'day is required'));
    die();
  }

  if ($worker_hour->validate_params($_POST['start_hour'])) {
    $worker_hour->start_hour = $_POST['start_hour'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'start_hour is required'));
    die();
  }

  if ($worker_hour->validate_params($_POST['finish_hour'])) {
    $worker_hour->finish_hour = $_POST['finish_hour'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'finish_hour is required'));
    die();
  }


  if ($id = $worker_hour->add_new_worker_hour()){
      echo json_encode(array('success' => 1, 'message' => 'Worker_Hour is registered', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
