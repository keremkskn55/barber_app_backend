<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Order {
  private $table = 'app_order';

  public $app_id;
  public $service_id;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function add_order(){
    global $database;

      $sql = "INSERT INTO $this->table (app_id, service_id) VALUES (
        '".(int) $this->app_id."',
        '".(int) $this->service_id."'
      )";

      $order_saved = $database->query($sql);

      if ($order_saved) {
        return true;
      }
      else {
        return false;
      }
  }

  public function orders_for_shop() {
    global $database;

    $sql = "SELECT app_order.app_id, app_order.service_id, service.service_name FROM app_order
            INNER JOIN service
            ON app_order.service_id = service.service_id
            WHERE app_order.app_id = '".(int) $this->app_id."'
";

    $result = $database->query($sql);
    return $database->fetch_array($result);
  }
}

$order = new Order();
