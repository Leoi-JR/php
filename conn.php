<?php
//（1）类的自动加载
spl_autoload_register(function($className){
    //构建文件的真实路径
    $filename = "./library/$className.class.php";
    //如果类文件存在，则包含
    if(file_exists($filename)){
        require_once($filename);
    }
});

//(2)创建数据库类的对象
$arr = array(
    "db_host" => "localhost",
    "db_user" => "root",
    "db_pass" => "root",
    "db_name" => "itcast",
    "charset" => "utf8"
);

$db = Db::getInstance($arr);
// var_dump($db);