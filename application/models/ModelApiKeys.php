<?php
Class ModelApiKeys extends CI_Model{


    public function show_one($secret_key)
    {
        $data=$this->db->get_where('api_keys',array('key'=>$secret_key));
        return $data;
    }

}
?>