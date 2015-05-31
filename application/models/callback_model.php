<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callback_model extends CI_Model {

  public function get() {
    $sql = "SELECT * FROM `callback`";
    $query = $this->db->query($sql);
    $result = $query->result();
    if (!$result) { return false; }
    return $result;
  }

  public function add($name, $number, $address, $start_time, $end_time) {
    $sql = "INSERT INTO `callback` (`name`, `number`, `address`, `start_time`, `end_time`) VALUES (?, ?, ?, ?, ?)";
    $data = array($name, $number, $address, $start_time, $end_time);
    $query = $this->db->query($sql, $data);
    return false;
  }
}