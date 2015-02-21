<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_auth_model extends CI_Model {

    //метод проверки логина и пароля
    public function login($login, $pass)
    {
        $sql = "SELECT `id`,`hash_password`,`salt` FROM `store_admins` WHERE `login` = ?";
        $data = array($login);
        $query = $this->db->query($sql, $data);
        
        if ($query->num_rows() < 1){ return false; }
        foreach ($query->result() as $row){
            $user_data = $this->hash_pass->enhash($pass, $row->salt);
            if($user_data['hash_pass'] != $row->hash_password){ return false; }
            return $row->id;
        }
    }
    
    public function reg($login, $pass)
    {
        $data_name = $this->hash_pass->enhash($pass);
        $sql = "INSERT INTO `store_admins` (`login`, `hash_password`, `salt`)
                VALUES (?, ?, ?);";
        $data = array($login, $data_name['hash_pass'], $data_name['salt']);
        $this->db->query($sql, $data);
    }
}