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
                http_response_code(500);
                $arrResult = array(
                    'result' => false,
                    'code' => 500,
                    'message' => 'Internal Server Error'
                );
                if (count($data) == 1) {
                    http_response_code(200);
                    $arrResult = array(
                        'result' => true,
                        'code' => 200,
                        'message' => 'Login was successful',
                        'data' => $data
                    );
                }
                echo json_encode($arrResult);
            break;
        }
    }

    public function clogin()
    {
        echo "ApiLogin";
    }
}

?>