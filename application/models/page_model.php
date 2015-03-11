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
    $sql = "INSERT INTO `portfolio` (`img`,`category_id`) VALUES (?,'no-category')";
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
    $sql = "UPDATE `portfolio` SET `category_id` = (SELECT `id` FROM `category_portfolio` WHERE `name` = ?) WHERE `id` = ?";
    $data = array($name, $id);
    $this->db->query($sql, $data);
  }

  public function get_portfolio($link = null, $num_page = 1, $num_rows = 5) {
    $start = ($num_page * $num_rows) - $num_rows;
    if(is_null($link)){
      $sql = "SELECT
              `portfolio`.`id`,
              `portfolio`.`category_id`,
              `portfolio`.`img`,
              `portfolio`.`title`,
              `portfolio`.`trash`,
              `category_portfolio`.`link`,
              `category_portfolio`.`name`,
              `category_portfolio`.`position`
              FROM `portfolio` LEFT JOIN `category_portfolio`
              ON `portfolio`.`category_id` = `category_portfolio`.`id`
              WHERE `trash` = 0 ORDER BY `portfolio`.`id` DESC LIMIT ?,?";
      $data = array($start, $num_rows);
      $query = $this->db->query($sql, $data);
      if (!$query) { return false; }
      return $query->result();
    }
    $sql = "SELECT
            `portfolio`.`id`,
            `portfolio`.`category_id`,
            `portfolio`.`img`,
            `portfolio`.`title`,
            `portfolio`.`trash`,
            `category_portfolio`.`link`,
            `category_portfolio`.`name`,
            `category_portfolio`.`position`
            FROM `portfolio` LEFT JOIN `category_portfolio`
            ON `portfolio`.`category_id` = `category_portfolio`.`id`
            WHERE `category_portfolio`.`link` = ? AND `trash` = 0
            ORDER BY `portfolio`.`id` DESC LIMIT ?,?";
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
    $sql = "SELECT * FROM `portfolio`
            WHERE `category_id` = (SELECT `id` FROM `category_portfolio` WHERE `link` = ?)
            AND `trash` = 0";
    $data = array($link);
    $query = $this->db->query($sql, $data);
    $num_news = ceil($query->num_rows()/$num_rows);
    return $num_news;
  }

  public function get_list_category_portfolio() {
    $sql = "SELECT *
            FROM `category_portfolio`
            ORDER BY `position`";
    $sql = "SELECT `category_portfolio`.*, COUNT(`portfolio`.`id`) AS `amount`
            FROM `category_portfolio` LEFT JOIN `portfolio`
            ON (`portfolio`.`category_id`=`category_portfolio`.`id` AND `portfolio`.`trash` = 0)
            GROUP BY `category_portfolio`.`id`
            ORDER BY `category_portfolio`.`position`";

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

  public function del($name){
    $sql = "DELETE FROM `portfolio` WHERE `name` = ?";
    $data = array($name);
    $this->db->query($sql, $data);
  }

  public function position_rewrite($data_id) {
    $sql = "UPDATE `category_portfolio` SET `position` = ? WHERE `id` = ?";
    foreach($data_id as $position => $id) {
      $data = array($position, $id);
      $this->db->query($sql, $data);
    }
  }

  public function update_category_portfolio($id,$name,$desc,$slug){
    $sql = "SELECT `id`, `name`, `description`, `link` FROM `category_portfolio` WHERE (`link` = ? OR `name` = ?) AND (`id` != ?) LIMIT 1";
    $data = array($slug, $name, $id);
    $query = $this->db->query($sql, $data);

    if(!$query->num_rows()){
      $sql = "UPDATE `category_portfolio` SET `name` =  ?, `description` = ?, `link` = ? WHERE `id` = ? LIMIT 1";
      $data = array($name,$desc,$slug,$id);
      if ($this->db->query($sql, $data)){
        return 0; //нет ошибок
      }
      return 1; //неизвесная ошибка
    }

    $row = $query->row();
    if ($row->name == $name){
      return 2; //ошибка совпадает имя
    } elseif ($row->link == $slug) {
      return 3; //ошибка совпадает ярлык
    }
    return 1; //неизвесная ошибка
  }
}