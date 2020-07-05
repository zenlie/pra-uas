<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Class ApiBarang extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->helper('authentication');
        $this->load->Model('Model_transaksi');
    }

    public function index()
    {
       $req = $_SERVER['REQUEST_METHOD'];
       
       switch ($req) {
          case 'GET':
               $data = $this->Model_transaksi->show_transaksi()->result();
               if ($this->input->get('id_transaksi') != '') {
                  $id_transaksi = $this->input->get('id_transaksi');
                  $data = $this->Model_transaksi->show_one_transaksi($id_transaksi)->result();
               }
               echo json_encode($data);
            break;

          case 'POST':
               $data = $this->Model_transaksi->add();

               http_response_code(500);
               $arrResult = array(
                  'result' => false,
                  'code' => 500,
                  'message' => 'Internal Server Error'
               );

               if ($data == 1) {
                  http_response_code(201);
                  $arrResult = array(
                     'result' => true,
                     'code' => 201,
                     'message' => 'Data Was Created'
                  );         
         
               }
               echo json_encode($arrResult);
             break;

          case 'PUT':
               $putfp = fopen('php://input', 'r');
               $putdata = '';
               while($data = fread($putfp, 1024))
                  $putdata .= $data;
               fclose($putfp);

               $var = json_decode($putdata);
               foreach ($var as $key => $value) {
                  $$key = $value;
               }
               http_response_code(404);
               $arrResult = array(
                  'result' => false,
                  'code' => 404,
                  'message' => 'Data Not Found'
               );
               $barang = $this->Model_transaksi->show_one_transaksi($id_transaksi)->result();
               $data = $this->Model_transaksi->update($id_transaksi, $id_pelanggan, $id_user, $tgl_transaksi);
               if (count($barang) == 1) {
                  http_response_code(200);
                  $arrResult = array(
                     'result' => true,
                     'code' => 200,
                     'message' => 'Data Was Updated'
                  );
               }
               echo json_encode($arrResult);

             break;

          case 'DELETE':
               $putfp = fopen('php://input', 'r');
               $putdata = '';
               while($data = fread($putfp, 1024))
                  $putdata .= $data;
               fclose($putfp);
               $var = json_decode($putdata);
               foreach ($var as $key => $value) {
                  $$key = $value;
               }

               http_response_code(404);
               $arrResult = array(
                  'result' => false,
                  'code' => 404,
                  'message' => 'Data Not Found'
               );
               $barang = $this->Model_transaksi->show_one_transaksi($id_transaksi)->result();         
               if (count($barang) == 1) {
                  $data = $this->Model_transaksi->delete($id_transaksi);
                  http_response_code(202);
                  $arrResult = array(
                     'result' => true,
                     'code' => 202,
                     'message' => 'Data Was Deleted'
                  );

               }
               echo json_encode($arrResult);

             break;
       }
   }
}

?>