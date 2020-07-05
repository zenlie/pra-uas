<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Class ApiDosen extends CI_Controller{

    function __construct() {
        parent::__construct();
        // $this->load->helper('authentication');
        $this->load->Model('ModelDosen');
    }

    public function index()
    {
        $req = $_SERVER['REQUEST_METHOD'];
        // var_dump($_SERVER['REQUEST_METHOD']); die;
        switch ($req) {
            // di execute dari get - break
            case 'GET': 
                $data = $this->ModelDosen->show()->result();
                if ($this->input->get('id_barang') != '') {
                    $id_barang = $this->input->get('id_barang');
                    $data = $this->ModelDosen->show_one_barang($id_barang)->result();
                }
                echo json_encode($data);
            break;

          case 'POST':
               $data = $this->ModelDosen->add();

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
               $barang = $this->ModelDosen->show_one($nip_dosen)->result();
               $data = $this->ModelDosen->update($nip_dosen, $nm_dosen, $tanla_dosen, $jk_dosen, $notelp_dosen, $alamat_dosen);
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
               $barang = $this->ModelDosen->show_one($nip_dosen)->result();         
               if (count($barang) == 1) {
                  $data = $this->ModelDosen->delete($nip_dosen);
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