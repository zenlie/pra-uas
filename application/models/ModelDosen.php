<?php
Class ModelDosen extends CI_Model{

    public function show()
    {
        $data=$this->db->get('dosen');
        return $data;
    }

    public function show_one($id)
    {
        $data=$this->db->get_where('dosen',array('nip_dosen'=>$id));
        return $data;
    }

    public function add()
    {
        $data = [
            'nip_dosen' => $this->input->post('nip_dosen'),
            'nm_dosen' => $this->input->post('nm_dosen'),
            'tanla_dosen' => $this->input->post('tanla_dosen'),
            'jk_dosen' => $this->input->post('jk_dosen'),
            'notelp_dosen' => $this->input->post('notelp_dosen'),
            'alamat_dosen' => $this->input->post('alamat_dosen'),
        ];
        return $this->db->insert('dosen',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('dosen',array('nip_dosen'=>$id));
        return $data;
    }

    public function update($nip_dosen, $nm_dosen, $tanla_dosen, $jk_dosen, $notelp_dosen, $alamat_dosen)
    {
        $data=[
            'nm_dosen' => $nm_dosen,
            'tanla_dosen' => $tanla_dosen,
            'jk_dosen' => $jk_dosen,
            'notelp_dosen' => $notelp_dosen,
            'alamat_dosen' => $alamat_dosen,

         ];
         $this->db->where('nip_dosen',$nip_dosen);
         return $this->db->update('dosen',$data);

    }

    public function delete($nip_dosen)
    {

        $nip_dosen = $nip_dosen;
        $this->db->where('nip_dosen',$nip_dosen);
        return $this->db->delete('dosen');

    }    

}
?>