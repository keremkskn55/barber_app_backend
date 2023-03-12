<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Appointment {
  private $table = 'appointment';

  public $app_id;
  public $shop_id;
  public $worker_id;
  public $user_id;
  public $date;
  public $start_hour;
  public $taken_hour;
  public $note;
  public $price;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function add_appointment(){
    global $database;

      $this->date = trim(htmlspecialchars(strip_tags($this->date)));
      $this->note = trim(htmlspecialchars(strip_tags($this->note)));

      $sql = "INSERT INTO $this->table (shop_id, worker_id, user_id, date, start_hour, taken_hour, note, price) VALUES (
        '".(int) $this->shop_id."',
        '".(int) $this->worker_id."',
        '".(int) $this->user_id."',
        '".$database->escape_value($this->date)."',
        '".(int) $this->start_hour."',
        '".(int) $this->taken_hour."',
        '".$database->escape_value($this->note)."',
        '".(double) $this->price."'
      )";

      $app_saved = $database->query($sql);

      if ($app_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function a_appointment() {
    global $database;

    $this->date = trim(htmlspecialchars(strip_tags($this->date)));

    $sql = "SELECT * FROM $this->table WHERE user_id = '" .(int) $this->user_id. "' AND worker_id = '" .(int) $this->worker_id. "' AND shop_id = '" .(int) $this->shop_id. "' AND date = '".$database->escape_value($this->date)."' AND start_hour = '" .(int) $this->start_hour. "'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function a_reserved_appointment() {
    global $database;

    $this->date = trim(htmlspecialchars(strip_tags($this->date)));

    $sql = "SELECT * FROM $this->table WHERE worker_id = '" .(int) $this->worker_id. "' AND shop_id = '" .(int) $this->shop_id. "' AND date = '".$database->escape_value($this->date)."' AND start_hour = '" .(int) $this->start_hour. "'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function appointments_for_shop() {
    global $database;

    $sql = "SELECT appointment.app_id, appointment.shop_id, appointment.worker_id, appointment.user_id, appointment.date, appointment.start_hour, appointment.taken_hour, appointment.note, appointment.price,
worker.worker_name AS worker_name,
user.name AS user_name, user.surname AS user_surname
FROM `appointment`
            INNER JOIN `worker`
            ON `appointment`.`worker_id` = `worker`.`worker_id`
            INNER JOIN `user`
            ON `appointment`.`user_id` = `user`.`user_id`
            WHERE `appointment`.`shop_id` = 2
            ORDER BY `appointment`.`date` DESC, `appointment`.`start_hour` DESC";


            // $sql = "SELECT * FROM `appointment`
            //         INNER JOIN `worker`
            //         ON `appointment`.`worker_id` = `worker`.`worker_id`
            //         INNER JOIN `user`
            //         ON `appointment`.`user_id` = `user`.`user_id`
            //         WHERE `appointment`.`shop_id` = '" .(int) $this->shop_id. "'
            //         ORDER BY `appointment`.`date` DESC, `appointment`.`start_hour` DESC";

    $result = $database->query($sql);
    return $database->fetch_array($result);
  }

}

$appointment = new Appointment();
