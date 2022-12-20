<?php


function respon($code=null,$msg=null,$data=null){
    $respon_data=[
        "code"=>$code,
        "msg"=>$msg,
        "data"=>$data
    ];
    // $json_string = json_encode($respon_data,JSON_FORCE_OBJECT);
    $json_string = json_encode($respon_data,JSON_UNESCAPED_UNICODE);
    header("Content-Type: application/json");
    return $json_string;
}


?>