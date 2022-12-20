<?php

$request_content = file_get_contents("php://input");
$json_data = json_decode($request_content,true);


?>