<?php 
include("base/getjson.php");
include("base/getrespon.php");
$username=isset($json_data['username'])?$json_data['username']:die(respon("998","用户名为空"));
$password=isset($json_data['password'])?$json_data['password']:die(respon("998","密码为空"));
$repassword=isset($json_data['repassword'])?$json_data['repassword']:die(respon("998","确认密码为空"));


if($password != $repassword){
    die(respon("998","密码和确认密码不一致"));
}
// else if(!preg_match("/^1[3456789]\d{9}$/", $tele)){
//     die(respon("998","手机号格式错误"));
// }

include_once("base/conn_sql.php");

$sql = "SELECT * FROM `user` WHERE username = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if($stmt->affected_rows != 0){
    die(respon("998","用户已存在"));
}
include_once("base/getDatetime.php");

$create_time=$dt;
$last_login=$dt;
$status="1";

$sql = "INSERT INTO `user`(`username`,`password`,`create_time`,`last_login`,`status`) VALUES (?,?,?,?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssssd", $username,$password,$create_time,$last_login,$status);
$stmt->execute();
if($stmt->affected_rows == 0){
    die(respon("998","新建用户错误"));
}
else if($stmt->affected_rows == 1){
    echo respon("200","新建用户成功");
}
session_start();
@$_SESSION['username']=$username;
@$_SESSION['isLogin']=1;
@$_SESSION['role']='user';
?>