<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Worker.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

  if ($worker->validate_params($_POST['shop_id'])) {
    $worker->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  echo json_encode(array('success' => 1, 'workers' => $worker->some_workers()));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
