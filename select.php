<?php
header("content-type:text/html;charset=utf-8");
//包含连接数据库的公共文件
require_once("./conn.php");

list("s"=>$s, "e"=>$e)=$_GET;
if(!isset($s)){
  $sql = "SELECT * FROM singer WHERE s_score>= $s;";
}
elseif(!isset($e)){
  $sql = "SELECT * FROM singer WHERE s_score<= $e;";
}
else{
  $sql = "SELECT * FROM singer WHERE s_score>= $s and s_score<= $e;";
}

//执行SQL语句
if($db->fetchAll($sql)){
    //输出提示，3秒后跳回到列表页面
    // echo "<h2>id={$id}的信息删除成功！</h2>";
    header("refresh:0;url=./list.php?");
    die();