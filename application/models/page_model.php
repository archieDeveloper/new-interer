<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {

  public function get_pages_list() {
    $sql = "SELECT * FROM `store_page`";
    $data = array();
    $query = $this->db->query($sql, $data);
    return $query->result();
  }

  public function get_page($name_page) {
    $sql = "SELECT * FROM `store_page` WHERE `name` = ?";
    $data = array($name_page);
    $query = $this->db->query($sql, $data);

    if ($query->num_rows() < 1){ return false; }
    $result = $query->result();
    return $result[0];
  }

}