<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

// Class Student Start
class Worker_Hour{
  private $table = 'worker_hour';

public $worker_id;
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

  public function add_new_worker_hour() {
    global $database;

      $this->day = trim(htmlspecialchars(strip_tags($this->day)));

      $sql = "INSERT INTO $this->table (worker_id, day, start_hour, finish_hour) VALUES (
        '".(int) $this->worker_id."',
        '".$database->escape_value($this->day)."',
        '".(int) $this->start_hour."',
        '".(int) $this->finish_hour."'
      )";

      $worker_hour_saved = $database->query($sql);

      if ($worker_hour_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function some_workers_hour_related_day() {
    global $database;

    $this->day = trim(htmlspecialchars(strip_tags($this->day)));

    $sql = "SELECT * FROM $this->table WHERE worker_id = '".$this->worker_id."' AND day = '".$database->escape_value($this->day)."'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
    // $result = $database->query($sql);
    // return $database->fetch_array($result);
  }
}

$worker_hour = new Worker_Hour();
