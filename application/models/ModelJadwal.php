<?php
Class ModelJadwal extends CI_Model{

    public function show()
    {
        $this->db->select('*'); //take1
        $this->db->from('jadwal'); //take1
        $this->db->join('jurusan', 'jadwal.nip_dosen = jurusan.nip_dosen'); //take1
        $data = $this->db->get(); //take1
        return $data; //take1
    }

    public function show_one($id)
    {
        $this->db->select('*'); //take2
        $this->db->from('jadwal'); //take2
        $this->db->join('jurusan', 'jadwal.nip_dosen = jurusan.nip_dosen'); //take2
        $this->db->where('id_jdwl', $id); //take2
        $data = $this->db->get(); //take2
        return $data; //take2
    }  

    public function add()
    {
        $data = [
            'id_jdwl' => $this->input->post('id_jdwl'),
            'hari_jdwl' => $this->input->post('hari_jdwl'),
            'jam_jdwl' => $this->input->post('jam_jdwl'),
            'kd_matkul' => $this->input->post('kd_matkul'),
            'kd_ruangan' => $this->input->post('kd_ruangan'),
            'nip_dosen' => $this->input->post('nip_dosen'),
        ];
        return $this->db->insert('jadwal',$data);
    }

    public function edit($id)
    {
        $data=$this->db->get_where('jadwal',array('id_jdwl'=>$id));
        return $data;
    }

    public function update($id_jdwl, $hari_jdwl, $jam_jdwl, $kd_matkul, $kd_ruangan, $nip_dosen)
    {
        $data=[
            'hari_jdwl' => $hari_jdwl,
            'jam_jdwl' => $jam_jdwl,
            'kd_matkul' => $kd_matkul,
            'kd_ruangan' => $kd_ruangan,
            'nip_dosen' => $nip_dosen,
         ];
         $this->db->where('id_jdwl',$id_jdwl);
         return $this->db->update('jadwal',$data);

    }

    public function delete($id_jdwl)
    {

        $id_jdwl = $id_jdwl;
        $this->db->where('id_jdwl',$id_jdwl);
        return $this->db->delete('jadwal');

    }    

}
?>