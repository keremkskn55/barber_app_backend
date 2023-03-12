<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Shop.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($shop->validate_params($_POST['type_shop'])) {
    $shop->type_shop = $_POST['type_shop'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Type Shop is required'));
    die();
  }

  if ($shop->validate_params($_POST['name'])){
    $shop->name = $_POST['name'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Name is required'));
    die();
  }

  if ($shop->validate_params($_POST['address'])){
    $shop->address = $_POST['address'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Address is required'));
    die();
  }

  if ($shop->validate_params($_POST['lat'])){
    $shop->lat = $_POST['lat'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Lat is required'));
    die();
  }

  if ($shop->validate_params($_POST['lng'])){
    $shop->lng = $_POST['lng'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Lng is required'));
    die();
  }

  if ($shop->validate_params($_POST['img_url'])){
    $shop->img_url = $_POST['img_url'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Image Url is required'));
    die();
  }

  if ($shop->validate_params($_POST['user_id'])) {
    $shop->user_id = $_POST['user_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'user_id is required'));
    die();
  }


  if ($id = $shop->add_new_shop()){
      echo json_encode(array('success' => 1, 'message' => 'Shop is registered', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
