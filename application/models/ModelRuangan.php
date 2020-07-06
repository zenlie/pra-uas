<?php
Class ModelRuangan extends CI_Model{

    public function show()
    {
        $data=$this->db->get('ruangan');
        return $data;
    }

    public function show_one($id)
    {
        $data=$this->db->get_where('ruangan',array('kd_ruangan'=>$id));
        return $data;
    }

    public function add()
    {
        $data = [
            'kd_ruangan ' => $this->input->post('kd_ruangan'),
            'nm_ruangan' => $this->input->post('nm_ruangan'),
        ];
        return $this->db->insert('ruangan',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('ruangan',array('kd_ruangan'=>$id));
        return $data;
    }

    public function update($kd_ruangan, $nm_ruangan)
    {
        $data=[
            'nm_ruangan' => $nm_ruangan,
         ];
         $this->db->where('kd_ruangan',$kd_ruangan);
         return $this->db->update('ruangan',$data);

    }

    public function delete($kd_ruangan)
    {

        $kd_ruangan = $kd_ruangan;
        $this->db->where('kd_ruangan',$kd_ruangan);
        return $this->db->delete('ruangan');

    }    

}
?>