<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Favs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($favs->validate_params($_POST['shop_id'])) {
    $favs->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  if ($favs->validate_params($_POST['worker_id'])) {
    $favs->worker_id = $_POST['worker_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'worker_id is required'));
    die();
  }

  $n_f = $favs->count_worker_fav();
  echo json_encode(array('success' => 1, 'message' => 'Worker Fav is fetched', 'num_fav' => $n_f));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
