<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

// Class Student Start
class Shop_Hour{
  private $table = 'shop_hour';

public $shop_id;
public $day;
public $start_hour;
public $finish_hour;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function add_new_shop_hour() {
    global $database;

      $this->day = trim(htmlspecialchars(strip_tags($this->day)));
      $this->start_hour = trim(htmlspecialchars(strip_tags($this->start_hour)));
      $this->finish_hour = trim(htmlspecialchars(strip_tags($this->finish_hour)));

      $sql = "INSERT INTO $this->table (shop_id, day, start_hour, finish_hour) VALUES (
        '".(int) $this->shop_id."',
        '".$database->escape_value($this->day)."',
        '".$database->escape_value($this->start_hour)."',
        '".$database->escape_value($this->finish_hour)."'
      )";

      $shop_hour_saved = $database->query($sql);

      if ($shop_hour_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function fetch_shop_hours() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE shop_id = '".$this->shop_id."'";

    $result = $database->query($sql);
    return $database->fetch_array($result);
  }
}

$shop_hour = new Shop_Hour();
