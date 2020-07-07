<?php
Class ModelJurusan extends CI_Model{

    public function show()
    {
        $this->db->select('*'); //take1
        $this->db->from('jurusan'); //take1
        $this->db->join('jenjang', 'jurusan.kd_jenjang = jenjang.kd_jenjang'); //take1
        $data = $this->db->get(); //take1
        return $data; //take1
    }

    public function show_one($id)
    {
        $this->db->select('*'); //take2
        $this->db->from('jurusan'); //take2
        $this->db->join('jenjang', 'jurusan.kd_jenjang = jenjang.kd_jenjang'); //take2
        $this->db->where('kd_jurusan', $id); //take2
        $data = $this->db->get(); //take2
        return $data; //take2
    }  

    public function add()
    {
        $data = [
            'kd_jurusan ' => $this->input->post('kd_jurusan'),
            'nm_jurusan' => $this->input->post('nm_jurusan'),
            'kd_jenjang' => $this->input->post('kd_jenjang'),
        ];
        return $this->db->insert('jurusan',$data);
    }

    public function edit($id)
    {
        $data=$this->db->get_where('jurusan',array('kd_jurusan'=>$id));
        return $data;
    }

    public function update($kd_jurusan, $nm_jurusan, $kd_jenjang)
    {
        $data=[
            'nm_jurusan' => $nm_jurusan,
            'kd_jenjang' => $kd_jenjang,
         ];
         $this->db->where('kd_jurusan',$kd_jurusan);
         return $this->db->update('jurusan',$data);

    }

    public function delete($kd_jurusan)
    {

        $kd_jurusan = $kd_jurusan;
        $this->db->where('kd_jurusan',$kd_jurusan);
        return $this->db->delete('jurusan');

    }    

}
?>