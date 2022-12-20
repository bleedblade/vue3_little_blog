<?php
session_start();

if(@$_SESSION['isLogin'] != 1){
    die(respon("403","未登录"));
}

?>