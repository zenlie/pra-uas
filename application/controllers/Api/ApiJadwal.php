<?php 

header("Access-Controll-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");

Class ApiJadwal extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        // $this->load->helper('authentication');
        $this->load->Model('ModelJadwal');
    }

    public function index(){
        $req = $_SERVER['REQUEST_METHOD'];
        switch ($req) {
            case 'GET':
                $data = $this->ModelJadwal->show()->result();  //take1
                if ($this->input->get('id_jdwl') != '') {  //take 1 take2
                    $id_jdwl = $this->input->get('id_jdwl'); //take 1 take2
                    $data = $this->ModelJadwal->show_one($id_jdwl)->result_array(); //take2
                } //take2
                echo json_encode($data); //take2
            break;
            
            case 'POST':
                $data = $this->ModelJadwal->add();
 
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
                    $result = $this->ModelJadwal->show_one($id_jdwl)->result();
                    $data = $this->ModelJadwal->update($id_jdwl, $hari_jdwl, $jam_jdwl, $kd_matkul, $kd_ruangan, $kd_jurusan, $nip_dosen);
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
                    $result = $this->ModelJadwal->show_one($id_jdwl)->result();         
                    if (count($result) == 1) {//jumlah count data berdasarkan id
                       $data = $this->ModelJadwal->delete($id_jdwl);
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