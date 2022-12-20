<?php

include("base/isLogin.php");
$file=isset($_FILES['file'])?$_FILES['file']:null;
include("base/getrespon.php");
include("base/conn_sql.php");
include("base/getjson.php");
if($file){
    $arr=explode('.',$file['name']);
    // echo $arr[count($arr)-1];//获取文件后缀
    $article_image = md5($file['name'].time()).'.'.$arr[count($arr)-1];
    // echo $filename;//重命名文件，大概是这种格式：89f06f296c839fa6ef0512f9f60e678e.jpg
    move_uploaded_file($file['tmp_name'],'../src/'.$article_image);
}

$article_title=isset($_POST['title'])?$_POST['title']:die(respon("998","标题为空"));
$article_content=isset($_POST['content'])?$_POST['content']:die(respon("998","内容为空"));
$article_author=@$_SESSION['username'];

include_once("base/getDatetime.php");

$create_time=$dt;
$status="1";

$sql = "INSERT INTO `article`(`title`,`content`,`author_name`,`image`,`create_time`,`status`) VALUES (?,?,?,?,?,?)";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ssssss", $article_title,$article_content,$article_author,$article_image,$create_time,$status);

$stmt->execute();

if($stmt->affected_rows == 0){

    die(respon("998","新建文章错误"));

}else if ($stmt->affected_rows == 1){
    print(respon("200","新建文章成功"));
}


?>