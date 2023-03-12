<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Favs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($favs->validate_params($_POST['shop_id'])) {
    $favs->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  if ($favs->validate_params($_POST['cus_id'])) {
    $favs->cus_id = $_POST['cus_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'cus_id is required'));
    die();
  }


  if ($id = $favs->change_shop_fav()){
      echo json_encode(array('success' => 1, 'message' => 'Fav condition was changed', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
