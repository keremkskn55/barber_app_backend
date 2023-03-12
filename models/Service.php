<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

// Class Student Start
class Service{
  private $table = 'service';

  public $service_id;
  public $shop_id;
  public $service_name;
  public $price;
  public $work_hour;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function add_new_service() {
    global $database;

      $this->service_name = trim(htmlspecialchars(strip_tags($this->service_name)));
      $this->work_hour = trim(htmlspecialchars(strip_tags($this->work_hour)));

      $sql = "INSERT INTO $this->table (shop_id, service_name, price, work_hour) VALUES (
        '".(int) $this->shop_id."',
        '".$database->escape_value($this->service_name)."',
        '".(double) $this->price."',
        '".$database->escape_value($this->work_hour)."'
      )";

      $service_saved = $database->query($sql);

      if ($service_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function a_service() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE service_id = '" .(int) $this->service_id. "'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function services_from_shop() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE shop_id = '" .(int) $this->shop_id. "'";

    $result = $database->query($sql);
    return $database->fetch_array($result);
  }

  // // to check if username is unique or not
  // public function check_unique_username(){
  //   global $database;
  //
  //   $this->username = trim(htmlspecialchars(strip_tags($this->username)));
  //
  //   $sql = "SELECT id FROM $this->table WHERE username = '" .$database->escape_value($this->username). "'";
  //
  //   $result = $database->query($sql);
  //   $user_id = $database->fetch_row($result);
  //
  //   return empty($user_id);
  // }

  // public function check_unique_username_for_update(){
  //   global $database;
  //
  //   $this->username = trim(htmlspecialchars(strip_tags($this->username)));
  //
  //   $sql = "SELECT id FROM $this->table WHERE username = '" .$database->escape_value($this->username). "'";
  //
  //   $result = $database->query($sql);
  //   $user_id = $database->fetch_row($result);
  //
  //   if (empty($user_id)){
  //     return true;
  //   }
  //   else{
  //     if ($this->id == $user_id['id']){
  //       return true;
  //     }
  //     else{
  //       return false;
  //     }
  //   }
  // }
  //
  // public function update_user() {
  //   global $database;
  //
  //   $this->email = trim(htmlspecialchars(strip_tags($this->email)));
  //   $this->phone_no = trim(htmlspecialchars(strip_tags($this->phone_no)));
  //   $this->address = trim(htmlspecialchars(strip_tags($this->address)));
  //   $this->username = trim(htmlspecialchars(strip_tags($this->username)));
  //   $this->password = trim(htmlspecialchars(strip_tags($this->password)));
  //
  //   $sql = "UPDATE $this->table SET
  //   email = '".$database->escape_value($this->email)."',
  //   phone_no = '".$database->escape_value($this->phone_no)."',
  //   address = '".$database->escape_value($this->address)."',
  //   username = '".$database->escape_value($this->username)."',
  //   password = '".password_hash($database->escape_value($this->password), PASSWORD_BCRYPT)."'
  //   WHERE id = $this->id
  //   ";
  //
  //   $user_saved = $database->query($sql);
  //
  //   if ($user_saved) {
  //     return true;
  //   }
  //   else {
  //     return false;
  //   }
  //
  // }
  //
  // // Saving new data in our database
  // public function register_user() {
  //   global $database;
  //
  //   $this->email = trim(htmlspecialchars(strip_tags($this->email)));
  //   $this->phone_no = trim(htmlspecialchars(strip_tags($this->phone_no)));
  //   $this->address = trim(htmlspecialchars(strip_tags($this->address)));
  //   $this->username = trim(htmlspecialchars(strip_tags($this->username)));
  //   $this->password = trim(htmlspecialchars(strip_tags($this->password)));
  //
  //   $sql = "INSERT INTO $this->table (email, phone_no, address, username, password) VALUES (
  //     '".$database->escape_value($this->email)."',
  //     '".$database->escape_value($this->phone_no)."',
  //     '".$database->escape_value($this->address)."',
  //     '".$database->escape_value($this->username)."',
  //     '".password_hash($database->escape_value($this->password), PASSWORD_BCRYPT)."'
  //   )";
  //
  //   $user_saved = $database->query($sql);
  //
  //   if ($user_saved) {
  //     return true;
  //   }
  //   else {
  //     return false;
  //   }
  // }
  //
  // // Login Function
  // public function login(){
  //   global $database;
  //
  //   $this->username = trim(htmlspecialchars(strip_tags($this->username)));
  //   $this->password = trim(htmlspecialchars(strip_tags($this->password)));
  //
  //   $sql = "SELECT * FROM $this->table WHERE username = '" .$database->escape_value($this->username). "'";
  //
  //   $result = $database->query($sql);
  //   $user = $database->fetch_row($result);
  //
  //   if (empty($user)) {
  //     return "User doesn't exist.";
  //   }
  //   else {
  //     if (password_verify($this->password, $user['password'])) {
  //       unset($user['password']);
  //       return $user;
  //     }
  //     else{
  //       return "Password doesn't match";
  //     }
  //   }
  // }
  //
  // public function an_user() {
  //   global $database;
  //
  //   $sql = "SELECT * FROM $this->table WHERE username = '" .$database->escape_value($this->username). "'";
  //
  //   $result = $database->query($sql);
  //   return $database->fetch_row($result);
  // }
  //
  // // method to return the list of seller
  // public function all_users() {
  //   global $database;
  //
  //   $sql = "SELECT id, username, email, password, phone_no, address FROM $this->table";
  //
  //   $result = $database->query($sql);
  //
  //   return $database->fetch_array($result);
  // }
}

$service = new Service();
