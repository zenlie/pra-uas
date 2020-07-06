<?php
Class ModelNilai extends CI_Model{

    public function show()
    {
        $this->db->select('*'); //take1
        $this->db->from('nilai'); //take1
        $this->db->join('mahasiswa', 'nilai.nim_mhs = mahasiswa.nim_mhs'); //take1
        $this->db->join('matakuliah', 'nilai.kd_matkul = matakuliah.kd_matkul'); //take1
        $data = $this->db->get(); //take1
        return $data; //take1
    }

    public function show_one($id)
    {
        $this->db->select('*'); //take2
        $this->db->from('nilai'); //take2
        $this->db->join('mahasiswa', 'nilai.nim_mhs = mahasiswa.nim_mhs'); //take2
        $this->db->join('matakuliah', 'nilai.kd_matkul = matakuliah.kd_matkul'); //take2
        $this->db->where('id_nilai', $id); //take2
        $data = $this->db->get(); //take2
        return $data; //take2
    }  

    public function add()
    {
        $data = [
            'id_nilai' => $this->input->post('id_nilai'),
            'nilai' => $this->input->post('nilai'),
            'nim_mhs' => $this->input->post('nim_mhs'),
            'kd_matkul' => $this->input->post('kd_matkul'),
        ];
        return $this->db->insert('nilai',$data);
    }

    public function edit($id)
    {
        $data=$this->db->get_where('nilai',array('id_nilai'=>$id));
        return $data;
    }

    public function update($id_nilai, $nilai, $nim_mhs, $kd_matkul)
    {
        $data=[
            'nilai' => $nilai,
            'nim_mhs' => $nim_mhs,
            'kd_matkul' => $kd_matkul,
         ];
         $this->db->where('id_nilai',$id_nilai);
         return $this->db->update('nilai',$data);

    }

    public function delete($id_nilai)
    {

        $id_nilai = $id_nilai;
        $this->db->where('id_nilai',$id_nilai);
        return $this->db->delete('nilai');

    }    

}
?>