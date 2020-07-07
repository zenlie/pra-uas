<?php
Class ModelUser extends CI_Model{

    public function show()
    {
        $data=$this->db->get('user');
        return $data;
    }

    public function show_one($id)
    {
        $this->db->select('*'); //take2
        $this->db->from('user'); //take2
        $this->db->join('usergroup', 'user.id_usergroup = usergroup.id_usergroup'); //take2
        $this->db->where('id_usergroup', $id); //take2
        $data = $this->db->get(); //take2
        return $data; //take2
    }  

    public function add()
    {
        $data = [
            'id_user' => $this->input->post('id_user'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'foto_user' => $this->input->post('foto_user'),
            'id_usergroup' => $this->input->post('id_usergroup'),
        ];
        return $this->db->insert('user',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('user',array('id_user'=>$id));
        return $data;
    }

    public function update($id_user, $username, $password, $foto_user, $id_usergroup)
    {
        $data=[
            'username' => $username,
            'password' => $password,
            'foto_user' => $foto_user,
            'id_usergroup' => $id_usergroup,

         ];
         $this->db->where('id_user',$id_user);
         return $this->db->update('user',$data);

    }

    public function delete($id_user)
    {

        $id_user = $id_user;
        $this->db->where('id_user',$id_user);
        return $this->db->delete('user');

    }    

}
?>