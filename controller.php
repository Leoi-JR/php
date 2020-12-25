<?php
//声明页面字符集
header("content-type: text/html;charset=utf-8");
//包含模型类文件
require_once("./model.class.php");

//(1)获取客户传递的参数
$type = isset($_GET["type"]) ? $_GET["type"] : 3;
//(2)调用Model获取数据，一般是模型类
$modelObj = new DateTime2();
//根据用户传递不同参数，调用不同的方法，取回不同数据
switch($type){
    case 1:
        $str = $modelObj->getDate();
        break;
    case 2:
        $str = $modelObj->getTime();
        break;
    case 3:
        $str = $modelObj->getDateTime();
        break;
    default:
        $str = $modelObj->getDateTime();
}
//(3)调用View来显示数据
include "./view.html";