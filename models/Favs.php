<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Favs {
  private $table = 'favs';

  public $fav_id;
  public $cus_id;
  public $shop_id;
  public $worker_id;

  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  public function change_shop_fav() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE cus_id = '" .(int) $this->cus_id. "' AND shop_id = '" .(int) $this->shop_id. "' AND worker_id IS NULL";

    $result = $database->query($sql);
    $fav = $database->fetch_row($result);

    if (empty($fav)) {
      $sql = "INSERT INTO $this->table (cus_id, shop_id) VALUES (
        '".(int) $this->cus_id."',
        '".(int) $this->shop_id."'
      )";

      $fav_saved = $database->query($sql);

      if ($fav_saved) {
        return true;
      }
      else {
        return false;
      }
    }
    else {
      $sql = "DELETE FROM $this->table
      WHERE cus_id = '".(int) $this->cus_id."' AND shop_id = '".(int) $this->shop_id."' AND worker_id IS NULL";

      $fav_saved = $database->query($sql);

      if ($fav_saved) {
        return true;
      }
      else {
        return false;
      }
    }
  }

  public function change_worker_fav() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE cus_id = '" .(int) $this->cus_id. "' AND shop_id = '" .(int) $this->shop_id. "' AND worker_id = '" .(int) $this->worker_id. "'";

    $result = $database->query($sql);
    $fav = $database->fetch_row($result);

    if (empty($fav)) {
      $sql = "INSERT INTO $this->table (cus_id, shop_id, worker_id) VALUES (
        '".(int) $this->cus_id."',
        '".(int) $this->shop_id."',
        '".(int) $this->worker_id."'
      )";

      $fav_saved = $database->query($sql);

      if ($fav_saved) {
        return true;
      }
      else {
        return false;
      }
    }
    else {
      $sql = "DELETE FROM $this->table
      WHERE cus_id = '".(int) $this->cus_id."' AND shop_id = '".(int) $this->shop_id."' AND worker_id = '".(int) $this->worker_id."'";

      $fav_saved = $database->query($sql);

      if ($fav_saved) {
        return true;
      }
      else {
        return false;
      }
    }
  }

  public function a_shop_fav() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE cus_id = '" .(int) $this->cus_id. "' AND shop_id = '" .(int) $this->shop_id. "' AND worker_id IS NULL";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function a_worker_fav() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE cus_id = '" .(int) $this->cus_id. "' AND shop_id = '" .(int) $this->shop_id. "' AND worker_id = '" .(int) $this->worker_id. "'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function count_shop_fav() {
    global $database;

    $sql = " SELECT COUNT(fav_id) AS num_fav
    FROM $this->table
    WHERE shop_id = '".(int) $this->shop_id."' AND worker_id IS NULL
    ";

    $count_fav_saved = $database->query($sql);

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function count_worker_fav() {
    global $database;

    $sql = " SELECT COUNT(fav_id) AS num_fav
    FROM $this->table
    WHERE shop_id = '".(int) $this->shop_id."' AND worker_id = '".(int) $this->worker_id."'
    ";

    $count_fav_saved = $database->query($sql);

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

}

$favs = new Favs();
