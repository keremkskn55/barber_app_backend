<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Comment {
  private $table = 'comment';

  public $comment_id;
  public $shop_id;
  public $user_id;
  public $detail;
  public $date;
  public $detailed_date;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function add_comment(){
    global $database;

      $this->service_name = trim(htmlspecialchars(strip_tags($this->detail)));
      $this->work_hour = trim(htmlspecialchars(strip_tags($this->date)));
      $this->work_hour = trim(htmlspecialchars(strip_tags($this->detailed_date)));

      $sql = "INSERT INTO $this->table (shop_id, user_id, detail, date, detailed_date) VALUES (
        '".(int) $this->shop_id."',
        '".(int) $this->user_id."',
        '".$database->escape_value($this->detail)."',
        '".$database->escape_value($this->date)."',
        '".$database->escape_value($this->detailed_date)."'
      )";

      $comment_saved = $database->query($sql);

      if ($comment_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function show_comment() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE shop_id = '" .(int) $this->shop_id. "' ORDER BY detailed_date DESC";

    $result = $database->query($sql);
    return $database->fetch_array($result);
  }

  public function count_comment() {
    global $database;

    $sql = " SELECT COUNT(comment_id) AS num_com
    FROM $this->table
    WHERE shop_id = '".(int) $this->shop_id."'
    ";

    $count_fav_saved = $database->query($sql);

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

}

$comment = new Comment();
