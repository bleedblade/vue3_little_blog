<?php

$article_id = isset($_GET["id"])?$_GET["id"]:die("<script>window.location.href = '../article.html'</script>");

include("base/getjson.php");
include("base/getrespon.php");
include("base/conn_sql.php");


$sql = "SELECT * FROM `article` WHERE id = ?";
$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $article_id);

$stmt->execute();
$result = $stmt->get_result();
if($stmt->affected_rows == 0){
    // die(respon("998","新建文章错误"));
    die("<script>window.location.href = '/article.html'</script>");
}
$row = $result->fetch_assoc();
echo respon("200","获取成功",$row);
?>