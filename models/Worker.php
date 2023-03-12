<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

// Class Student Start
class Worker{
  private $table = 'worker';

public $worker_id;
public $shop_id;
public $worker_name;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function add_new_worker() {
    global $database;

      $this->worker_name = trim(htmlspecialchars(strip_tags($this->worker_name)));

      $sql = "INSERT INTO $this->table (shop_id, worker_name) VALUES (
        '".(int) $this->shop_id."',
        '".$database->escape_value($this->worker_name)."'
      )";

      $worker_saved = $database->query($sql);

      if ($worker_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function a_worker() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE shop_id = '" .(int) $this->shop_id. "' AND worker_name = '".$database->escape_value($this->worker_name)."'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function some_workers() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE shop_id = '".$this->shop_id."'";

    $result = $database->query($sql);
    return $database->fetch_array($result);
  }
}

$worker = new Worker();
