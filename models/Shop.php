<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

// Class Student Start
class Shop{
  private $table = 'shop';

  public $shop_id;
  public $type_shop;
  public $name;
  public $address;
  public $lat;
  public $lng;
  public $img_url;
  public $user_id;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function add_new_shop() {
    global $database;

      $this->type_shop = trim(htmlspecialchars(strip_tags($this->type_shop)));
      $this->name = trim(htmlspecialchars(strip_tags($this->name)));
      $this->address = trim(htmlspecialchars(strip_tags($this->address)));
      $this->lat = trim(htmlspecialchars(strip_tags($this->lat)));
      $this->lng = trim(htmlspecialchars(strip_tags($this->lng)));
      $this->img_url = trim(htmlspecialchars(strip_tags($this->img_url)));
      $this->user_id = trim(htmlspecialchars(strip_tags($this->user_id)));

      $sql = "INSERT INTO $this->table (type_shop, name, address, lat, lng, img_url, user_id) VALUES (
        '".$database->escape_value($this->type_shop)."',
        '".$database->escape_value($this->name)."',
        '".$database->escape_value($this->address)."',
        '".(double) $this->lat."',
        '".(double) $this->lng."',
        '".$database->escape_value($this->img_url)."',
        '".(int) $this->user_id."'
      )";

      $shop_saved = $database->query($sql);

      if ($shop_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function a_shop() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE user_id = '" .(int) $this->user_id. "'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function some_shop() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE type_shop = '".$this->type_shop."'";

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

$shop = new Shop();
