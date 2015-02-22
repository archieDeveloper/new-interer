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

  public function add_portfolio($img) {
    $sql = "INSERT INTO `portfolio` (`img`,`category_link`) VALUES (?,'no-category')";
    $data = array($img);
    $this->db->query($sql, $data);
    return $this->db->insert_id();
  }

  public function edit_title_portfolio($id, $title) {
    $sql = "UPDATE `portfolio` SET `title` = ? WHERE `id` = ?";
    $data = array($title, $id);
    $this->db->query($sql, $data);
  }

  public function trash_portfolio($id) {
    $sql = "UPDATE `portfolio` SET `trash` = 1 WHERE `id` = ?";
    $data = array($id);
    $this->db->query($sql, $data);
  }

  public function no_trash_portfolio($id) {
    $sql = "UPDATE `portfolio` SET `trash` = 0 WHERE `id` = ?";
    $data = array($id);
    $this->db->query($sql, $data);
  }

  public function edit_category_portfolio($id, $name) {
    $sql = "UPDATE `portfolio` SET `category_link` = (SELECT `link` FROM `category_portfolio` WHERE `name` = ?) WHERE `id` = ?";
    $data = array($name, $id);
    $this->db->query($sql, $data);
  }

  public function get_portfolio($link = null, $num_page = 1, $num_rows = 5) {
    $start = ($num_page * $num_rows) - $num_rows;
    if(is_null($link)){
      $sql = "SELECT * FROM `portfolio` LEFT JOIN `category_portfolio` ON `portfolio`.`category_link` = `category_portfolio`.`link` WHERE `trash` = 0 ORDER BY `id` DESC LIMIT ?,?";
      $data = array($start, $num_rows);
      $query = $this->db->query($sql, $data);
      if (!$query) { return false; }
      return $query->result();
    }
    $sql = "SELECT * FROM `portfolio` LEFT JOIN `category_portfolio` ON `portfolio`.`category_link` = `category_portfolio`.`link` WHERE `portfolio`.`category_link` = ? AND `trash` = 0 ORDER BY `id` DESC LIMIT ?,?";
    $data = array($link, $start, $num_rows);
    $query = $this->db->query($sql, $data);
    if (!$query) { return false; }
    return $query->result();
  }

  public function get_num_portfolio($link = null, $num_rows = 5) {
    if(is_null($link)){
      $sql = "SELECT * FROM `portfolio` WHERE `trash` = 0";
      $query = $this->db->query($sql);
      $num_news = ceil($query->num_rows()/$num_rows);
      return $num_news;
    }
    $sql = "SELECT * FROM `portfolio` WHERE `portfolio`.`category_link` = ? AND `trash` = 0";
    $data = array($link);
    $query = $this->db->query($sql, $data);
    $num_news = ceil($query->num_rows()/$num_rows);
    return $num_news;
  }

  public function get_list_category_portfolio() {
    $sql = "SELECT * FROM `category_portfolio` ORDER BY `position`";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function get_current_portfolio($id) {
    $sql = "SELECT * FROM `portfolio` WHERE `id` = ?";
    $data = array($id);
    $query = $this->db->query($sql,$data);
    $result = $query->result();
    if (!$result) { return false; }
    if (!isset($result[0])) { return false; }
    return $result[0];
  }

  /*public function get_portfolio_category($type) {
    $sql = "SELECT * FROM `portfolio` WHERE `type` = ? ORDER BY `id` DESC";
    $data = array($type);
    return $this->db->query($sql, $data);
  }

  public function get_portfolio($type_array = array()) {
    $data = array();
    foreach ($type_array as $current_type) {
      $data[] = $this->get_portfolio_category($current_type);
    }
    return $data;
  }*/

  public function del($name){
    $sql = "DELETE FROM `portfolio` WHERE `name` = ?";
    $data = array($name);
    $this->db->query($sql, $data);
  }

  public function position_rewrite($data_links) {
    $sql = "UPDATE `category_portfolio` SET `position` =  ? WHERE `link` = ?";
    foreach($data_links as $position => $link){
      $data = array($position, $link);
      $this->db->query($sql, $data);
    }
  }
}
