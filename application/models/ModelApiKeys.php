<?php
Class ModelApiKeys extends CI_Model{

    public function generate()
    {
        $data = [
            'id_user' => $this->input->post('id_user'),
            'key' => $this->generateRandomString(15),
            'level' => 1,
            'ignore_limits' => 1,
            'is_private_key' => 1,
            'ip_addresses' => $this->get_client_ip(),
            'date_created' => date('Y-m-d')
        ];
        return $this->db->insert('api_keys',$data);
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