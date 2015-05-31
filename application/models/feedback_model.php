<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model {

  public function get() {
    $sql = "SELECT * FROM `feedback`";
    $query = $this->db->query($sql);
    $result = $query->result();
    if (!$result) { return false; }
    return $result;
  }

  public function add($name, $email, $number, $topic, $text) {
    $sql = "INSERT INTO `feedback` (`name`, `email`, `phone`, `topic`, `text`) VALUES (?, ?, ?, ?, ?)";
    $data = array($name, $email, $number, $topic, $text);
    $query = $this->db->query($sql, $data);
    return false;
  }
}