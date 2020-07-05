<?php
Class Model_Barang extends CI_Model{

    public function show_barang()
    {
        $data=$this->db->get('tbl_barang');
        return $data;
    }

    public function show_one_barang($id)
    {
        $data=$this->db->get_where('tbl_barang',array('id_barang'=>$id));
        return $data;
    }

    public function add()
    {
        $data=[
            'id_barang' => $this->input->post('id_barang'),
            'nm_barang'        => $this->input->post('nm_barang'),
            'stok_barang'  => $this->input->post('stok_barang'),
            'harga_barang'  => $this->input->post('harga_barang'),
         ];
         return $this->db->insert('tbl_barang',$data);
    }
    public function edit($id)
    {
        $data=$this->db->get_where('tbl_barang',array('id_barang'=>$id));
        return $data;
    }

    public function update($id_barang, $nm_barang, $stok_barang, $harga_barang)
    {
        $data=[
            'nm_barang' => $nm_barang,
            'stok_barang' => $stok_barang,
            'harga_barang' => $harga_barang,

         ];
         $this->db->where('id_barang',$id_barang);
         return $this->db->update('tbl_barang',$data);

    }

    public function delete($id_barang)
    {

        $id_barang = $id_barang;
        $this->db->where('id_barang',$id_barang);
        return $this->db->delete('tbl_barang');

    }    

}
?>