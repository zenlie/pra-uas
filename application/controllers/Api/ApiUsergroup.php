<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Class ApiUsergroup extends CI_Controller{

    function __construct() {
        parent::__construct();
        // $this->load->helper('authentication');
        $this->load->Model('ModelUsergroup');
    }

    public function index()
    {
        $req = $_SERVER['REQUEST_METHOD'];
        // var_dump($_SERVER['REQUEST_METHOD']); die;
        switch ($req) {
            // di execute dari get - break
            case 'GET': 
                $data = $this->ModelUsergroup->show()->result();
                if ($this->input->get('id_usergroup') != '') {
                    $id_usergroup = $this->input->get('id_usergroup');
                    $data = $this->ModelUsergroup->show_one($id_usergroup)->result();
                }
                echo json_encode($data);
            break;

          case 'POST':
               $data = $this->ModelUsergroup->add();

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
               $result = $this->ModelUsergroup->show_one($id_usergroup)->result();
               $data = $this->ModelUsergroup->update($id_usergroup, $nm_usergroup);
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
               $result = $this->ModelUsergroup->show_one($id_usergroup)->result();         
               if (count($result) == 1) {
                  $data = $this->ModelUsergroup->delete($id_usergroup);
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