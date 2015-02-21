<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    public function register($user_data) {
        if(!$this->select_user($user_data)){
            $sql = "INSERT INTO `users` (`uid`,`first_name`,`last_name`,`network`) VALUES (?,?,?,?);";
            $data = array($user_data['uid'], $user_data['first_name'], $user_data['last_name'], $user_data['network']);
            $query = $this->db->query($sql, $data);
        }
    }

    public function select_user($user_data) {
        if (!empty($user_data['uid']) && !empty($user_data['network'])) {
            $sql = "SELECT * FROM `users` WHERE `uid` = ? and `network` = ? LIMIT 1";
            $data = array($user_data['uid'], $user_data['network']);
            $query = $this->db->query($sql, $data);
            return $query->result();
        }
        return true;
    }
}