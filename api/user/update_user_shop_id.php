<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($user->validate_params($_POST['user_id'])) {
    $user->user_id = $_POST['user_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'user_id is required'));
    die();
  }

  if ($user->validate_params($_POST['shop_id'])) {
    $user->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  if ($id = $user->update_shop_id()){
    echo json_encode(array('success' => 1, 'message' => 'User is updated'));
  } else {
    http_response_code(500);
    echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}

// CHANGE
