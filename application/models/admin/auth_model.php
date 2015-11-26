<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

  public function login($login, $pass) {
    $sql = "SELECT `id`,`hash_password`,`salt` FROM `admin` WHERE `login` = ?";
    $data = [
      $login
    ];
    $query = $this->db->query($sql, $data);
    if ($query->num_rows() <= 0) {
      return false;
    }
    foreach ($query->result() as $row) {
      $user_data = $this->hashpass->enhash($pass, $row->salt);
      if($user_data['hash_pass'] != $row->hash_password) {
        return false;
      }
      return $row->id;
    }
  }

  public function reg($login, $pass) {
    $data_name = $this->hashPass->enhash($pass);
    $sql = "INSERT INTO `admin` (`login`, `hash_password`, `salt`)
            VALUES (?, ?, ?)";
    $data = [
      $login,
      $data_name['hash_pass'],
      $data_name['salt']
    ];
    $this->db->query($sql, $data);
  }
}