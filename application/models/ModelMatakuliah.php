<?php
Class ModelMatakuliah extends CI_Model{

    public function show()
    {
        $data=$this->db->get('matakuliah');
        return $data;
    }

    public function show_one($id)
    {
        $data=$this->db->get_where('matakuliah',array('kd_matkul'=>$id));
        return $data;
    }

    public function add()
    {
        $data = [
            'kd_matkul' => $this->input->post('kd_matkul'),
            'nm_matkul' => $this->input->post('nm_matkul'),
            'sks' => $this->input->post('sks'),
        ];
        return $this->db->insert('matakuliah',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('matakuliah',array('kd_matkul'=>$id));
        return $data;
    }

    public function update($kd_matkul, $nm_matkul, $sks)
    {
        $data=[
            'nm_matkul' => $nm_matkul,
            'sks' => $sks,
         ];
         $this->db->where('kd_matkul',$kd_matkul);
         return $this->db->update('matakuliah',$data);

    }

    public function delete($kd_matkul)
    {

        $kd_matkul = $kd_matkul;
        $this->db->where('kd_matkul',$kd_matkul);
        return $this->db->delete('matakuliah');

    }    

}
?>