<?php
Class ModelMahasiswa extends CI_Model{

    public function show()
    {
        $this->db->select('*'); //take1
        $this->db->from('mahasiswa'); //take1
        $this->db->join('jurusan', 'mahasiswa.kd_jurusan = jurusan.kd_jurusan'); //take1
        $data = $this->db->get(); //take1
        return $data; //take1
    }

    public function show_one($id)
    {
        $this->db->select('*'); //take2
        $this->db->from('mahasiswa'); //take2
        $this->db->join('jurusan', 'mahasiswa.kd_jurusan = jurusan.kd_jurusan'); //take2
        $this->db->where('nim_mhs', $id); //take2
        $data = $this->db->get(); //take2
        return $data; //take2
    }  

    public function add()
    {
        $data = [
            'nim_mhs' => $this->input->post('nim_mhs'),
            'nm_mhs' => $this->input->post('nm_mhs'),
            'tanla_mhs' => $this->input->post('tanla_mhs'),
            'jk_mhs' => $this->input->post('jk_mhs'),
            'notelp_mhs' => $this->input->post('notelp_mhs'),
            'alamat_mhs' => $this->input->post('alamat_mhs'),
            'kd_jurusan' => $this->input->post('kd_jurusan'),
        ];
        return $this->db->insert('mahasiswa',$data);
    }

    public function edit($id)
    {
        $data=$this->db->get_where('mahasiswa',array('nim_mhs'=>$id));
        return $data;
    }

    public function update($nim_mhs, $nm_mhs, $tanla_mhs, $jk_mhs, $notelp_mhs, $alamat_mhs, $kd_jurusan)
    {
        $data=[
            'nm_mhs' => $nm_mhs,
            'tanla_mhs' => $tanla_mhs,
            'jk_mhs' => $jk_mhs,
            'notelp_mhs' => $notelp_mhs,
            'alamat_mhs' => $alamat_mhs,
            'kd_jurusan' => $kd_jurusan,
         ];
         $this->db->where('nim_mhs',$nim_mhs);
         return $this->db->update('mahasiswa',$data);

    }

    public function delete($nim_mhs)
    {

        $nim_mhs = $nim_mhs;
        $this->db->where('nim_mhs',$nim_mhs);
        return $this->db->delete('mahasiswa');

    }    

}
?>