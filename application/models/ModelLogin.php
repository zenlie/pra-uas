<?php
class ModelLogin extends CI_Model{

    function cek_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $login = $this->db->get('user')->result();
        return $login;
    }
}

?>