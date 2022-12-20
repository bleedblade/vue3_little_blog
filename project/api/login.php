<?php

session_start();
include("base/getrespon.php");
if(@$_SESSION['isLogin'] == 1){
    die(respon("302","已登录，返回首页"));
}
include("base/getjson.php");

include("base/conn_sql.php");

$login_username=isset($json_data['username'])?$json_data['username']:die(respon("998","用户名为空"));
$login_password=isset($json_data['password'])?$json_data['password']:die(respon("998","密码为空"));

$sql = "SELECT * FROM `user` WHERE username = ? AND password = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $login_username, $login_password);
$stmt->execute();
$result = $stmt->get_result();
if($stmt->affected_rows == 0){
    die(respon("403","失败"));
}else if($stmt->affected_rows == 1){
    echo respon("200","登录成功");
}
mysqli_close($mysqli);
@$_SESSION['username']=$login_username;
@$_SESSION['isLogin']=1;

?>