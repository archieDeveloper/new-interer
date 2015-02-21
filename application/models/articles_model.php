<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model extends CI_Model {

	public function get_current_article($id = null) {
        if ($id == null) { return false; }
		$article_id = $id;
		$sql = "SELECT * FROM `news` WHERE `id` = ? LIMIT 1";
		$data = array($article_id);
		$query = $this->db->query($sql, $data);
		$result = $query->result();
		if (!$result) { return false; }
        return $result[0];
	}

    public function get_news($num_page = 1, $num_rows = 5){
    	$start = ($num_page * $num_rows) - $num_rows;
        $sql = "SELECT * FROM `news` WHERE `trash` = 0 ORDER BY `id` DESC LIMIT ?,?";
        $data = array($start, $num_rows);
        $query = $this->db->query($sql, $data);
        $result = $query->result();
        if (!$result) { return false; }
        return $result;
    }

    public function get_num_news($num_rows = 5) {
    	$sql = "SELECT * FROM `news` WHERE `trash` = 0";
        $query = $this->db->query($sql);
        $num_news = ceil($query->num_rows()/$num_rows);
        return $num_news;
    }

    public function add_new($title, $date, $text) {
        $sql = "INSERT INTO `news` (`title`,`date`, `text`, `trash`) VALUES (?,?,?,0)";
        $data = array($title, $date, $text);
        $this->db->query($sql, $data);

        $sql = "SELECT * FROM `news` WHERE `id` = ? LIMIT 1";
        $data = array($this->db->insert_id());
        $query = $this->db->query($sql, $data);
        $result = $query->result();
        return $result[0];
    }

    public function edit_new($id, $title, $date, $text) {
        $sql = "UPDATE `news` SET `title` = ?, `date` = ?, `text` = ? WHERE `id` = ?";
        $data = array($title, $date, $text, $id);
        $this->db->query($sql, $data);

        $sql = "SELECT * FROM `news` WHERE `id` = ? LIMIT 1";
        $data = array($id);
        $query = $this->db->query($sql, $data);
        $result = $query->result();
        return $result[0];
    }

    public function trash_new($id){
        $sql = "UPDATE `news` SET `trash` = 1 WHERE `id` = ?";
        $data = array($id);
        $this->db->query($sql, $data);
    }

    public function no_trash_new($id){
        $sql = "UPDATE `news` SET `trash` = 0 WHERE `id` = ?";
        $data = array($id);
        $this->db->query($sql, $data);
    }
}