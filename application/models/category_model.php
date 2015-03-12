<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

  public function get_list() {
    $sql = "SELECT `category_portfolio`.*, COUNT(`portfolio`.`id`) AS `amount`
            FROM `category_portfolio` LEFT JOIN `portfolio`
            ON (`portfolio`.`category_id`=`category_portfolio`.`id` AND `portfolio`.`trash` = 0)
            GROUP BY `category_portfolio`.`id`
            ORDER BY `category_portfolio`.`position`";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function position_rewrite($data_id) {
    $sql = "UPDATE `category_portfolio` SET `position` = ? WHERE `id` = ?";
    foreach($data_id as $position => $id) {
      $data = array($position, $id);
      $this->db->query($sql, $data);
    }
  }

  public function update($id,$name,$desc,$slug){
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

  public function add($name,$desc,$slug){
    $sql = "SELECT `id`, `name`, `description`, `link` FROM `category_portfolio` WHERE `link` = ? OR `name` = ? LIMIT 1";
    $data = array($slug, $name);
    $query = $this->db->query($sql, $data);

    if(!$query->num_rows()){
      $sql = "UPDATE `category_portfolio` SET `position` = `position`+1";
      $data = array($name,$desc,$slug);
      $this->db->query($sql, $data);

      $sql = "INSERT INTO `category_portfolio` (`link`, `name`, `description`, `position`) VALUES (?, ?, ?, 0)";
      $data = array($name,$desc,$slug);
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