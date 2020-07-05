<?php
Class Transaksi extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->Model('Model_barang');
    }

    public function index()
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kd_barang = penjualan.kode_barang');
        $this->db->where('status',0);
        $data['penjualan']=$this->db->get()->result();
        $this->template->load('template','penjualan/index',$data);

    }

    public function add()
    {
        $data=[
            'kode_pelanggan' => $this->input->post('kode_pelanggan'),
            'kode_barang'    => $this->input->post('kode_barang'),
            'jumlah'         => $this->input->post('jumlah'),
            'keterangan'     => $this->input->post('keterangan')
        ];
        $this->db->insert('penjualan',$data);
        redirect('Transaksi');
    }

    public function cancel()
    {
        $id=$this->uri->segment(3);
        $this->db->where('id_jual',$id);
        $this->db->delete('penjualan');
        redirect('Transaksi');
    }

    public function selesai()
    {
        $update=[
            'status'=>1
        ];
        $this->db->where('status',0);
        $this->db->update('penjualan',$update);
        redirect('Transaksi');
    }
}
?>