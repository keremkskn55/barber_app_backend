<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Shop.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($shop->validate_params($_POST['user_id'])) {
    $shop->user_id = $_POST['user_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'user_id is required'));
    die();
  }

  $s = $shop->a_shop();
  echo json_encode(array('success' => 1, 'message' => 'User is fetched', 'shop' => $s));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
