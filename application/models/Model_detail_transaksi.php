<?php
Class Model_detail_transaksi extends CI_Model{

    public function show_detail_transaksi()
    {
        $data=$this->db->get('tbl_detail_transaksi');
        return $data;
    }

    public function show_one_detail_transaksi($id)
    {
        $data=$this->db->get_where('tbl_detail_transaksi',array('id_detail_transaksi'=>$id));
        return $data;
    }

    public function add()
    {
        $data=[
            'id_detail_transaksi' => $this->input->post('id_detail_transaksi'),
            'id_transaksi'        => $this->input->post('id_transaksi'),
            'id_barang'  => $this->input->post('id_barang'),
            'qty_transaksi'  => $this->input->post('qty_transaksi'),
         ];
         return $this->db->insert('tbl_detail_transaksi',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('tbl_detail_transaksi',array('id_detail_transaksi'=>$id));
        return $data;
    }

    public function update($id_detail_transaksi, $id_transaksi, $id_barang, $qty_transaksi)
    {
        $data=[
            'id_transaksi' => $id_transaksi,
            'id_barang' => $id_barang,
            'qty_transaksi' => $qty_transaksi,

         ];
         $this->db->where('id_detail_transaksi',$id_detail_transaksi);
         return $this->db->update('tbl_detail_transaksi',$data);

    }

    public function delete($id_detail_transaksi)
    {

        $id_detail_transaksi = $id_detail_transaksi;
        $this->db->where('id_detail_transaksi',$id_detail_transaksi);
        return $this->db->delete('tbl_detail_transaksi');

    }    

}
?>