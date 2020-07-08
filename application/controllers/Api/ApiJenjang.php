<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Class ApiJenjang extends CI_Controller{

    function __construct() {
        parent::__construct();
      //   $this->load->helper('authentication');
        $this->load->Model('ModelJenjang');
    }

    public function index()
    {
        $req = $_SERVER['REQUEST_METHOD'];
        // var_dump($_SERVER['REQUEST_METHOD']); die;
        switch ($req) {
            // di execute dari get - break
            case 'GET': 
                $data = $this->ModelJenjang->show()->result();
                if ($this->input->get('kd_jenjang') != '') {
                    $kd_jenjang = $this->input->get('kd_jenjang');
                    $data = $this->ModelJenjang->show_one($kd_jenjang)->result_array();
                }
                echo json_encode($data);
            break;

          case 'POST':
               $data = $this->ModelJenjang->add();

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
               $result = $this->ModelJenjang->show_one($kd_jenjang)->result();
               $data = $this->ModelJenjang->update($kd_jenjang, $nm_jenjang);
               if (count($result) == 1) {
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
               $result = $this->ModelJenjang->show_one($kd_jenjang)->result();         
               if (count($result) == 1) {
                  $data = $this->ModelJenjang->delete($kd_jenjang);
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