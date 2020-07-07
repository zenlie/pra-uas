<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Class ApiKeys extends CI_Controller{

    function __construct() {
        parent::__construct();
        // $this->load->helper('authentication');
        $this->load->Model('ModelApiKeys');
    }

    public function index()
    {
        $req = $_SERVER['REQUEST_METHOD'];
        switch ($req) {
            case 'POST':
                $data = $this->ModelApiKeys->generate();
                http_response_code(500);
                $arrResult = array(
                    'result' => false,
                    'code' => 500,
                    'message' => 'Internal Server Error'
                );
                if ($data) {
                    http_response_code(200);
                    $arrResult = array(
                        'result' => true,
                        'code' => 200,
                        'message' => 'Api keys was generated'
                    );
                }
                echo json_encode($arrResult);
            break;
        }
    }
}

?>