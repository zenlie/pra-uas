<?php
Class Barang extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->Model('Model_barang');
    }

     public function index()
     {
         $this->template->load('template','barang/index');
     }
}

?>