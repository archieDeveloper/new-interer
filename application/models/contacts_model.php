<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_model extends CI_Model {

  public function get_contacts() {
    $sql = "SELECT * FROM `contacts` LEFT JOIN `contact_groups` ON `contacts`.`group_id` = `contact_groups`.`id`";
    $query = $this->db->query($sql);
    $result = $query->result();
    if (!$result) { return false; }
    $group_array = array();
    foreach ($result as $key => $value) {
      $group_array[$value->name][] = $value;
    }
    return $group_array;
  }
}