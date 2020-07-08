<?php
class ModelLogin extends CI_Model{

    function cek_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $login = $this->db->get('user')->result();
        return $login;
    }

    function createSecretKeys($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $result = $this->db->get('api_keys')->result();
        if (count($result) != 1) {
            $api_keys = $this->generateRandomString(25);
            $insert = [
                'id_user' => $data['id_user'],
                'key' => $api_keys,
                'level' => 1,
                'ignore_limits' => 1,
                'is_private_key' => 1,
                'ip_addresses' => $this->get_client_ip(),
                'date_created' => date('Y-m-d')
            ];
            $this->db->insert('api_keys',$insert);
            $this->session->userdata['api_keys'] = $api_keys;

        } else {
            $api_keys = $this->generateRandomString(25);
            $update=[
                'key' => $api_keys,
                'date_created' => date('Y-m-d')
            ];
            $this->db->where('id_user',$data['id_user']);
            $this->db->update('api_keys', $update);
            $this->session->userdata['api_keys'] = $api_keys;
        }
        redirect('dashboard');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function get_client_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_address;
    }
}

?>