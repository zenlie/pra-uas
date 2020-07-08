<?php 

header("Access-Controll-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");

Class ApiNilai extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        // $this->load->helper('authentication');        
        $this->load->Model('ModelNilai');
    }

    public function index(){
        $req = $_SERVER['REQUEST_METHOD'];
        switch ($req) {
            case 'GET':
                $data = $this->ModelNilai->show()->result();  //show semua
                if ($this->input->get('id_nilai') != '') {  // validate id_jadwal
                    $id_nilai = $this->input->get('id_nilai'); // get id jdwl
                    $data = $this->ModelNilai->show_one($id_nilai)->result_array(); //show one
                }
                echo json_encode($data); // if id_nilai kosong = shpw semua, if id_nilai tidak kosong = show one
            break;
            
            case 'POST':
                $data = $this->ModelNilai->add();
 
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

            default:
                # code...
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
                    $result = $this->ModelNilai->show_one($id_nilai)->result();
                    $data = $this->ModelNilai->update($id_nilai, $nilai, $nim_mhs, $kd_matkul);
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
                    $result = $this->ModelNilai->show_one($id_nilai)->result();         
                    if (count($result) == 1) {
                       $data = $this->ModelNilai->delete($id_nilai);
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