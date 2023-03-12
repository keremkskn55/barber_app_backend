<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Order.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($order->validate_params($_POST['app_id'])) {
    $order->app_id = $_POST['app_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'app_id is required'));
    die();
  }

  $o = $order->orders_for_shop();
  echo json_encode(array('success' => 1, 'message' => 'Appointment Check is fetched', 'orders' => $o));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
