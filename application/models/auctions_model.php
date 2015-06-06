<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auctions_model extends CI_Model {

  public function get_auctions_list()
  {
    $sql = "SELECT `auctions`.*, `users`.`first_name`, `users`.`last_name` FROM `auctions` LEFT JOIN `users` ON `auctions`.`id_user_rate` = `users`.`id`";
    $data = array();
    $query = $this->db->query($sql, $data);
    return $query->result();
  }

  public function get_current_lot()
  {
    $lot_id = $this->uri->ruri_to_assoc()['lot'];
    $sql = "SELECT `auctions`.*, `users`.`first_name`, `users`.`last_name` FROM `auctions` LEFT JOIN `users` ON `auctions`.`id_user_rate` = `users`.`id` WHERE `auctions`.`id` = ?";
    $data = array($lot_id);
    $query = $this->db->query($sql, $data);
    return $query->result();
  }

  public function get_user_lot()
  {
    $lot_id = $this->uri->ruri_to_assoc()['lot'];
    $sql = "SELECT `rate`.*, `users`.`first_name`, `users`.`last_name` FROM `rate` LEFT JOIN `users` ON `rate`.`user_id` = `users`.`id` WHERE `lot_id` = ? ORDER BY `date_time` DESC";
    $data = array($lot_id);
    $query = $this->db->query($sql, $data);
    return $query;
  }

  public function set_rate($new_rate, $user_data)
  {
    $lot_id = $this->uri->ruri_to_assoc()['lot'];
    $sql = "UPDATE `auctions` SET `rate` = ?, `id_user_rate` = (SELECT `id` FROM `users` WHERE `network` = ? AND `uid` = ?) WHERE ? > `rate` AND `id` = ?";
    $data = array($new_rate, $user_data['network'], $user_data['uid'], $new_rate, $lot_id, $lot_id);
    $query = $this->db->query($sql, $data);
    $result = $this->db->affected_rows();
    if ($result) {
      date_default_timezone_set('MST');
      $sql = "INSERT INTO `rate` (`user_id`,`date_time`,`lot_id`,`user_rate`) VALUES ((SELECT `id` FROM `users` WHERE `network` = ? AND `uid` = ?),?,?,?)";
      $data = array($user_data['network'], $user_data['uid'],date("Y-m-d H:i:s"), $lot_id, $new_rate);
      $query = $this->db->query($sql, $data);
    }
    return $result;
  }
}
