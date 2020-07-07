<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login/login');
    }


    public function setSession()
    {
        // echo "Set Session";
            // $newdata = array(
            //     'username'  => 'johndoe',
            //     'email'     => 'johndoe@some-site.com',
            //     'logged_in' => TRUE
            // );
            // $this->session->set_userdata($newdata);
        // $this->session->set_userdata('some_name', "gaga");

        $this->load->library('password');       
        $this->db->select('*');
        $this->db->where('email', $post['email']);
        $query = $this->db->get('users');
        $userInfo = $query->row();
        
        // if(!$this->password->validate_password($post['password'], $userInfo->password)){
        //     error_log('Unsuccessful login attempt('.$post['email'].')');
        //     return false;
            
        // http://localhost/pra-uas/Api/ApiRuangan?kd_ruangan=R1
    }

    public function showSession()
    {
        // var_dump($this->session->userdata); 
        // var_dump($this->session->userdata['username']); 
        // echo $this->session->userdata['username'];

        foreach ($this->session->userdata as $key => $value) {
            echo $value."<br>";
        }
    }

    public function destroySession()
    {
        $this->session->sess_destroy();
    }


}
