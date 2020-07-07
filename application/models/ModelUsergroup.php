<?php
Class ModelUsergroup extends CI_Model{

    public function show()
    {
        $data=$this->db->get('usergroup');
        return $data;
    }

    public function show_one($id)
    {
        $data=$this->db->get_where('usergroup',array('id_usergroup'=>$id));
        return $data;
    }

    public function add()
    {
        $data = [
            'id_usergroup ' => $this->input->post('id_usergroup'),
            'nm_usergroup' => $this->input->post('nm_usergroup'),
        ];
        return $this->db->insert('usergroup',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('usergroup',array('id_usergroup'=>$id));
        return $data;
    }

    public function update($id_usergroup, $nm_usergroup)
    {
        $data=[
            'nm_usergroup' => $nm_usergroup,
         ];
         $this->db->where('id_usergroup',$id_usergroup);
         return $this->db->update('usergroup',$data);

    }

    public function delete($id_usergroup)
    {

        $id_usergroup = $id_usergroup;
        $this->db->where('id_usergroup',$id_usergroup);
        return $this->db->delete('usergroup');

    }    

}
?>