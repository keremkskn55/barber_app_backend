<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");
require_once("{$base_dir}includes{$ds}password.php");

// Class Student Start
class User{
  private $table = 'user';

  public $user_id;
  public $email;
  public $password;
  public $gender;
  public $phone_no;
  public $city;
  public $birthday;
  public $name;
  public $surname;
  public $shop_id;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  // to check if username is unique or not
  public function check_unique_email(){
    global $database;

    $this->email = trim(htmlspecialchars(strip_tags($this->email)));

    $sql = "SELECT user_id FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

    $result = $database->query($sql);
    $user_id = $database->fetch_row($result);

    return empty($user_id);
  }

  // Saving new data in our database
  public function register_user() {
    global $database;

    $this->name = trim(htmlspecialchars(strip_tags($this->name)));
    $this->surname = trim(htmlspecialchars(strip_tags($this->surname)));
    $this->email = trim(htmlspecialchars(strip_tags($this->email)));
    $this->password = trim(htmlspecialchars(strip_tags($this->password)));
    $this->gender = trim(htmlspecialchars(strip_tags($this->gender)));
    $this->birthday = trim(htmlspecialchars(strip_tags($this->birthday)));
    $this->city = trim(htmlspecialchars(strip_tags($this->city)));
    $this->phone_no = trim(htmlspecialchars(strip_tags($this->phone_no)));


    $sql = "INSERT INTO $this->table (name, surname, email, password, gender, phone_no, city, birthday) VALUES (
      '".$database->escape_value($this->name)."',
      '".$database->escape_value($this->surname)."',
      '".$database->escape_value($this->email)."',
      '".password_hash($database->escape_value($this->password), PASSWORD_BCRYPT)."',
      '".$database->escape_value($this->gender)."',
      '".$database->escape_value($this->phone_no)."',
      '".$database->escape_value($this->city)."',
      '".$database->escape_value($this->birthday)."'
    )";

    $user_saved = $database->query($sql);

    if ($user_saved) {
      return true;
    }
    else {
      return false;
    }
  }

  // Login Function
  public function login(){
    global $database;

    $this->email = trim(htmlspecialchars(strip_tags($this->email)));
    $this->password = trim(htmlspecialchars(strip_tags($this->password)));

    $sql = "SELECT * FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

    $result = $database->query($sql);
    $user = $database->fetch_row($result);

    if (empty($user)) {
      return "User doesn't exist.";
    }
    else {
      if (password_verify($this->password, $user['password'])) {
        unset($user['password']);
        return $user;
      }
      else{
        return "Password doesn't match";
      }
    }
  }

  public function an_user() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  // method to return the list of seller
  public function all_users() {
    global $database;

    $sql = "SELECT user_id, username, email, password, phone_no, address FROM $this->table";

    $result = $database->query($sql);

    return $database->fetch_array($result);
  }

  // update user for shop_id
  public function update_shop_id() {
    global $database;

    $sql = "UPDATE $this->table SET shop_id = '" .(int) $this->shop_id. "' WHERE user_id = '" .(int) $this->user_id. "'";

    $user_saved = $database->query($sql);

    if ($user_saved) {
      return true;
    }
    else {
      return false;
    }
  }
}

$user = new User();
