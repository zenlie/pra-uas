<?php 

header("Access-Controll-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");

Class ApiMahasiswa extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        // $this->load->helper('authentication');
        $this->load->Model('ModelMahasiswa');
    }

    public function index(){
        $req = $_SERVER['REQUEST_METHOD'];
        switch ($req) {
            case 'GET':
                $data = $this->ModelMahasiswa->show()->result();  //take1
                if ($this->input->get('nim_mhs') != '') {  //take 1 take2
                    $nim_mhs = $this->input->get('nim_mhs'); //take 1 take2
                    $data = $this->ModelMahasiswa->show_one($nim_mhs)->result_array(); //take2
                } //take2
                echo json_encode($data); //take2
            break;
            
            case 'POST':
                $data = $this->ModelMahasiswa->add();
 
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
                    $result = $this->ModelMahasiswa->show_one($nim_mhs)->result();
                    $data = $this->ModelMahasiswa->update($nim_mhs, $nm_mhs, $tanla_mhs, $jk_mhs, $notelp_mhs, $alamat_mhs, $kd_jurusan);
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
                    $result = $this->ModelMahasiswa->show_one($nim_mhs)->result();         
                    if (count($result) == 1) {
                       $data = $this->ModelMahasiswa->delete($nim_mhs);
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