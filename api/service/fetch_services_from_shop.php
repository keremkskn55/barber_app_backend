<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($service->validate_params($_POST['shop_id'])) {
    $service->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  $s = $service->services_from_shop();
  echo json_encode(array('success' => 1, 'message' => 'Services ARE fetched', 'services' => $s));

} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
