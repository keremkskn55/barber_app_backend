<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Comment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($comment->validate_params($_POST['shop_id'])) {
    $comment->shop_id = $_POST['shop_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'shop_id is required'));
    die();
  }

  if ($comment->validate_params($_POST['user_id'])){
    $comment->user_id = $_POST['user_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'user_id is required'));
    die();
  }

  if ($comment->validate_params($_POST['detail'])){
    $comment->detail = $_POST['detail'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'detail is required'));
    die();
  }

  if ($comment->validate_params($_POST['date'])){
    $comment->date = $_POST['date'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'date is required'));
    die();
  }

  if ($comment->validate_params($_POST['detailed_date'])){
    $comment->detailed_date = $_POST['detailed_date'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'date is required'));
    die();
  }

  if ($id = $comment->add_comment()){
      echo json_encode(array('success' => 1, 'message' => 'Comment is added', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
