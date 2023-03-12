<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($user->validate_params($_POST['name'])) {
    $user->name = $_POST['name'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'name is required'));
    die();
  }

  if ($user->validate_params($_POST['surname'])){
    $user->surname = $_POST['surname'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'surname is required'));
    die();
  }

  if ($user->validate_params($_POST['email'])){
    $user->email = $_POST['email'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Email is required'));
    die();
  }

  if ($user->validate_params($_POST['password'])){
    $user->password = $_POST['password'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'password is required'));
    die();
  }

  if ($user->validate_params($_POST['gender'])){
    $user->gender = $_POST['gender'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'gender is required'));
    die();
  }

  if ($user->validate_params($_POST['birthday'])){
    $user->birthday = $_POST['birthday'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'birthday is required'));
    die();
  }

  if ($user->validate_params($_POST['city'])){
    $user->city = $_POST['city'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'city is required'));
    die();
  }

  if ($user->validate_params($_POST['phone_no'])){
    $user->phone_no = $_POST['phone_no'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'phone_no is required'));
    die();
  }

  if ($user->check_unique_email()){
    if ($id = $user->register_user()){
      echo json_encode(array('success' => 1, 'message' => 'User is registered'));
    } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
    }
  } else {
    http_response_code(401);
    echo json_encode(array('success' => 0, 'message' => 'Username already exists'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
