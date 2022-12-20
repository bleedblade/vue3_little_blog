<?php

include("base/isLogin.php");
include("base/getrespon.php");
include("base/conn_sql.php");


$article_id=isset($_GET['id'])?$_GET['id']:die(respon("998","未选择文章id"));
$sql = "DELETE from `article` where id = ?" ;
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $article_id);
$stmt->execute();

if($stmt->affected_rows == 0){

    die(respon("998","删除文章错误"));

}else if ($stmt->affected_rows == 1){
    print(respon("200","删除文章成功"));
}


?>