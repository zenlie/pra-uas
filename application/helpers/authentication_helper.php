<?php
$headers = apache_request_headers();

$secret_key = '';
$authentication = false;

foreach ($headers as $header => $value) {
    if ($header == 'secret_key') {
        $secret_key = $value;
    }
}
if ($secret_key != '') {
    $CI = get_instance();

    $CI->load->model('ModelApiKeys');
    $data = $CI->ModelApiKeys->show_one($secret_key)->result();
    (count($data) != 0) ? $authentication = true : $authentication = false;
}
if (!$authentication) {
    http_response_code(401);
    $arrResult = array(
        'result' => false,
        'code' => 401,
        'message' => 'Secret Key is invalid'
    );
    echo json_encode($arrResult);
    exit();
}