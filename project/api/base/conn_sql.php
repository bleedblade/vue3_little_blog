<?php

$mysql_server="localhost";
$mysql_username="root";
$mysql_password="root";
$mysql_database="project";
//建立数据库链接

$mysqli = new mysqli($mysql_server,$mysql_username,$mysql_password,$mysql_database) or die(respon("998","数据库链接错误"));

?>