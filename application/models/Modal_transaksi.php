<?php
Class Model_transaksi extends CI_Model{

    public function show_transaksi()
    {
        $data=$this->db->get('tbl_transaksi');
        return $data;
    }

    public function show_one_transaksi($id)
    {
        $data=$this->db->get_where('tbl_transaksi',array('id_transaksi'=>$id));
        return $data;
    }

    public function add()
    {
        $data=[
            'id_transaksi' => $this->input->post('id_transaksi'),
            'id_pelanggan'        => $this->input->post('id_pelanggan'),
            'id_user'  => $this->input->post('id_user'),
            'tgl_transaksi'  => $this->input->post('tgl_transaksi'),
         ];
         return $this->db->insert('tbl_transaksi',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('tbl_transaksi',array('id_transaksi'=>$id));
        return $data;
    }

    public function update($id_transaksi, $id_pelanggan, $id_user, $tgl_transaksi)
    {
        $data=[
            'id_pelanggan' => $id_pelanggan,
            'id_user' => $id_user,
            'tgl_transaksi' => $tgl_transaksi,

         ];
         $this->db->where('id_transaksi',$id_transaksi);
         return $this->db->update('tbl_transaksi',$data);

    }

    public function delete($id_transaksi)
    {

        $id_transaksi = $id_transaksi;
        $this->db->where('id_transaksi',$id_transaksi);
        return $this->db->delete('tbl_transaksi');

    }    

}
?>