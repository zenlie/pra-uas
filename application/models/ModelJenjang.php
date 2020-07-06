<?php
Class ModelJenjang extends CI_Model{

    public function show()
    {
        $data=$this->db->get('jenjang');
        return $data;
    }

    public function show_one($id)
    {
        $data=$this->db->get_where('jenjang',array('kd_jenjang'=>$id));
        return $data;
    }

    public function add()
    {
        $data = [
            'kd_jenjang ' => $this->input->post('kd_jenjang'),
            'nm_jenjang' => $this->input->post('nm_jenjang'),
        ];
        return $this->db->insert('jenjang',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('jenjang',array('kd_jenjang'=>$id));
        return $data;
    }

    public function update($kd_jenjang, $nm_jenjang)
    {
        $data=[
            'nm_jenjang' => $nm_jenjang,
         ];
         $this->db->where('kd_jenjang',$kd_jenjang);
         return $this->db->update('jenjang',$data);

    }

    public function delete($kd_jenjang)
    {

        $kd_jenjang = $kd_jenjang;
        $this->db->where('kd_jenjang',$kd_jenjang);
        return $this->db->delete('jenjang');

    }    

}
?>