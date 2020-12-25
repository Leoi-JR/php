<?php
//定义一个日期时间类
class DateTime2{
    public function getDate(){
        return date("Y-m-d");
    }

    public function getTime(){
        return date("H:i:s");
    }

    public function getDateTime(){
        return date("Y-m-d H:i:s");
    }
}