<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio_model extends CI_Model
{

  public function add($img)
  {
    $sql = "INSERT INTO `portfolio` (`img`,`category_id`) VALUES (?,'no-category')";
    $data = array($img);
    $this->db->query($sql, $data);
    return $this->db->insert_id();
  }

  public function edit_title($id, $title)
  {
    $sql = "UPDATE `portfolio` SET `title` = ? WHERE `id` = ?";
    $data = array($title, $id);
    $this->db->query($sql, $data);
  }

  public function trash($id)
  {
    $sql = "UPDATE `portfolio` SET `trash` = 1 WHERE `id` = ?";
    $data = [$id];
    $this->db->query($sql, $data);
  }

  public function restore($id)
  {
    $sql = "UPDATE `portfolio` SET `trash` = 0 WHERE `id` = ?";
    $data = array($id);
    $this->db->query($sql, $data);
  }

  public function edit_category($id, $name)
  {
    $sql = "UPDATE `portfolio` SET `category_id` = (SELECT `id` FROM `category_portfolio` WHERE `name` = ?) WHERE `id` = ?";
    $data = array($name, $id);
    $this->db->query($sql, $data);
  }

  public function get($link = null, $num_page = 1, $num_rows = 5)
  {
    $start = ($num_page * $num_rows) - $num_rows;
    if (is_null($link)) {
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
      if (!$query) {
        return false;
      }
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
    if (!$query) {
      return false;
    }
    return $query->result();
  }

  public function get_random($link = null, $count = 1)
  {
    if (is_null($link)) {
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
              WHERE `trash` = 0 ORDER BY `portfolio`.`id` DESC LIMIT ?";
      $data = array($count);
      $query = $this->db->query($sql, $data);
      if (!$query) {
        return false;
      }
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
            ORDER BY `portfolio`.`id` DESC LIMIT ?";
    $data = array($link, $count);
    $query = $this->db->query($sql, $data);
    if (!$query) {
      return false;
    }
    return $query->result();
  }

  public function get_num($link = null, $num_rows = 5)
  {
    if (is_null($link)) {
      $sql = "SELECT * FROM `portfolio` WHERE `trash` = 0";
      $query = $this->db->query($sql);
      $num_news = ceil($query->num_rows() / $num_rows);
      return $num_news;
    }
    $sql = "SELECT * FROM `portfolio`
            WHERE `category_id` = (SELECT `id` FROM `category_portfolio` WHERE `link` = ?)
            AND `trash` = 0";
    $data = array($link);
    $query = $this->db->query($sql, $data);
    $num_news = ceil($query->num_rows() / $num_rows);
    return $num_news;
  }

  public function get_current($id)
  {
    $sql = "SELECT * FROM `portfolio` WHERE `id` = ? LIMIT 1";
    $data = array($id);
    $query = $this->db->query($sql, $data);
    $result = $query->row();
    if (!$result) {
      return false;
    }
    return $result;
  }

}