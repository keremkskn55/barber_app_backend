<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Worker_Hour.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

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

  echo json_encode(array('success' => 1, 'worker_hours' => $worker_hour->some_workers_hour_related_day()));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
