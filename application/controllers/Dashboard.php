<?php
class Dashboard extends CI_Controller{

    function __construct() {
        parent::__construct();
        if (! isset($this->session->userdata['is_login'])) {
            redirect('');
        }
    }
     public function index()
     {
        $this->load->view('dashboard');
     }
}

?>