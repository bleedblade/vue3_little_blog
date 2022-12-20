<?php
include("base/getjson.php");
include("base/getrespon.php");
include("base/conn_sql.php");
if(isset($json_data['keyword'])){
    // $keyword=$json_data['keyword'];
    // $sql = "SELECT * FROM `article` where title like '%?%' or content like '%?%' order by create_time DESC ";
    // $stmt = $mysqli->prepare($sql);
    // $stmt->bind_param("ss", $keyword,$keyword);
    // $stmt->execute();
    // $result = $stmt->get_result();

    $keyword=$json_data['keyword'];
    $like = '%'.$keyword.'%';
    // $sql = "SELECT * FROM `article` where title like concat('%', :keyword, '%') or content like concat('%', :keyword, '%') order by create_time DESC ";
    $sql = "SELECT * FROM `article` where title like ? or content like ? order by create_time DESC ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $like,$like);
    $stmt->execute();
    $result = $stmt->get_result();
    



    $result_arr=array();
    while($row = $result->fetch_assoc()) {
        array_push($result_arr,$row);
    }

    echo respon("200",$msg,$result_arr);
}else{
    $sql = "SELECT * FROM `article` order by create_time DESC";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("d", $page);
    $stmt->execute();
    $result = $stmt->get_result();
    $result_arr=array();
    while($row = $result->fetch_assoc()) {
        array_push($result_arr,$row);
    }
    echo respon("200",$msg,$result_arr);
}


?>