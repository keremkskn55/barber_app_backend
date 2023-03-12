<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Shop_Hour.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($shop_hour->validate_params($_POST['shop_id'])) {
    $shop_hour->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  if ($shop_hour->validate_params($_POST['day'])) {
    $shop_hour->day = $_POST['day'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'day is required'));
    die();
  }

  if ($shop_hour->validate_params($_POST['start_hour'])) {
    $shop_hour->start_hour = $_POST['start_hour'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'start_hour is required'));
    die();
  }

  if ($shop_hour->validate_params($_POST['finish_hour'])) {
    $shop_hour->finish_hour = $_POST['finish_hour'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'finish_hour is required'));
    die();
  }


  if ($id = $shop_hour->add_new_shop_hour()){
      echo json_encode(array('success' => 1, 'message' => 'Shop_Hour is registered', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
