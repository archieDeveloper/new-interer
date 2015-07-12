<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Callback_model extends CI_Model
{

  public function get()
  {
    $sql = "SELECT * FROM `callback`";
    $query = $this->db->query($sql);
    $result = $query->result();
    if (!$result) {
      return false;
    }
    return $result;
  }

  public function add($name, $number, $start_time, $end_time, $froze = 0)
  {
    $sql = "INSERT INTO `callback` (`name`, `number`, `start_time`, `end_time`, `froze`) VALUES (?, ?, ?, ?, ?)";
    $data = array($name, $number, $start_time, $end_time, $froze);
    $query = $this->db->query($sql, $data);
    return false;
  }
}