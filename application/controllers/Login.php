<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH.'controllers/Api/ApiLogin.php';

class Login extends ApiLogin
{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login/login');
    }


    
    public function process_login()
    {
        var_dump($this->index());
    }
}
