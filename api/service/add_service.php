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

  if ($service->validate_params($_POST['service_name'])){
    $service->service_name = $_POST['service_name'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'service_name is required'));
    die();
  }

  if ($service->validate_params($_POST['price'])){
    $service->price = $_POST['price'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'price is required'));
    die();
  }

  if ($service->validate_params($_POST['work_hour'])){
    $service->work_hour = $_POST['work_hour'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'work_hour is required'));
    die();
  }

  if ($id = $service->add_new_service()){
      echo json_encode(array('success' => 1, 'message' => 'Shop is registered', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
