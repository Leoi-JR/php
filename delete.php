<?php
header("content-type:text/html;charset=utf-8");
//包含连接数据库的公共文件
require_once("./conn.php");
//获取地址栏传递的id
$id = $_GET["id"];
//构建删除的SQL语句
$sql = "DELETE FROM student where id={$id}";
//执行SQL语句
if($db->exec($sql)){
    //输出提示，3秒后跳回到列表页面
    // echo "<h2>id={$id}的信息删除成功！</h2>";
    header("refresh:0;url=./list.php");
    die();
}
?>