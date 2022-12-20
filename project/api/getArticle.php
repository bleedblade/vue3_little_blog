<?php
session_start();
$isLogin="200";
if(isset($_SESSION) && @$_SESSION['isLogin'] == 1){
    $isLogin="201";
}
$page=isset($_GET['page'])?$_GET['page']:1;
include("base/getrespon.php");
if(preg_match("/^[0-9]*$/", $page) != 1){
    $page=1;
}
$page=intval($page);
$page=($page-1)*15;
include("base/conn_sql.php");
$sql = "SELECT * FROM `article` order by create_time DESC LIMIT ?,15";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("d", $page);
$stmt->execute();
$result = $stmt->get_result();
if($stmt->affected_rows < 15){
    $msg = "已到底";
}
$result_arr=array();
while($row = $result->fetch_assoc()) {
    array_push($result_arr,$row);
}
// $json_string = json_encode($result_arr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_FORCE_OBJECT);
// $json_string = stripcslashes($json_string);


// echo $json_string;
echo respon($isLogin,$msg,$result_arr);
?>