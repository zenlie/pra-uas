<?php
Class Model_user extends CI_Model{

    public function check_secret_key($secret_key)
    {
        $data=$this->db->get_where('tbl_user',array('sk_user'=>$secret_key));
        return $data;
    }

    public function show_user()
    {
        $data=$this->db->get('tbl_user');
        return $data;
    }

    public function show_one_user($id)
    {
        $data=$this->db->get_where('tbl_user',array('id_user'=>$id));
        return $data;
    }

    public function add()
    {
        $data=[
            'id_user' => $this->input->post('id_user'),
            'nm_user'        => $this->input->post('nm_user'),
            'username'  => $this->input->post('username'),
            'password'  => $this->input->post('password'),
            'email_user' => $this->input->post('email_user'),
            'level_user'  => $this->input->post('level_user'),
            'sk_user'  => $this->input->post('sk_user'),

         ];
         return $this->db->insert('tbl_user',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('tbl_user',array('id_user'=>$id));
        return $data;
    }

    public function update($id_user, $nm_user, $username, $password, $email_user, $level_user, $sk_user)
    {
        $data=[
            'nm_user' => $nm_user,
            'username' => $username,
            'password' => $password,
            'email_user' => $email_user,
            'level_user' => $level_user,
            'sk_user' => $sk_user,            

         ];
         $this->db->where('id_user',$id_user);
         return $this->db->update('tbl_user',$data);

    }

    public function delete($id_user)
    {

        $id_user = $id_user;
        $this->db->where('id_user',$id_user);
        return $this->db->delete('tbl_user');

    }    

}
?>