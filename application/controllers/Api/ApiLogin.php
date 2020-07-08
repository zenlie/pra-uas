<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Class ApiLogin extends CI_Controller{

    function __construct() {
        parent::__construct();
        // $this->load->helper('authentication');
        $this->load->Model('ModelLogin');
    }

    public function index()
    {
        $req = $_SERVER['REQUEST_METHOD'];
        switch ($req) {
            case 'POST':
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $data = $this->ModelLogin->cek_login($username, $password);

                if (count($data) == 1) {
                    foreach ($data as $key => $value) {
                        $userData = array(
                            'id_user' => $value->id_user,
                            'username' => $value->username,
                            'id_usergroup ' => $value->id_usergroup,
                            'foto_user' => $value->foto_user,                            
                            'is_login' => TRUE
                        );
                    }
                    $this->session->set_userdata($userData);
                    redirect('dashboard');
                } else {
                    redirect('');
                }
            break;
        }
    }

    public function secretKeys()
    {
        $this->ModelLogin->createSecretKeys($this->session->userdata);
    }
}

?>