<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public function get_feedback() {
        $sql = "SELECT * FROM `feedback`";
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!$result) { return false; }
        return $result;
    }

    public function add_feedback($name, $number, $address, $start_time, $end_time) {
        $sql = "INSERT INTO `feedback` (`name`, `number`, `address`, `start_time`, `end_time`) VALUES (?, ?, ?, ?, ?)";
        $data = array($name, $number, $address, $start_time, $end_time);
        $query = $this->db->query($sql, $data);
        return false;
    }
}