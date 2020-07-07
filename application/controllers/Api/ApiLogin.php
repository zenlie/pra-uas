<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Class ApiLogin extends CI_Controller {

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
                        echo $value->username;
                    }
                    die;
                    redirect('dashboard');
                }else {
                    redirect('login');
                }
                // echo json_encode($arrResult);
            break;
        }
    }
}

?>