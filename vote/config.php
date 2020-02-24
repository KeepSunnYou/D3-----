<?php
/**
 * Created by PhpStorm.
 * User: sy
 * Date: 2020/2/23
 * Time: 下午 08:35
 */
$link = mysqli_connect('localhost','root','123');
if(!$link){
    echo "connect mysql error";
    exit();
}
//选择数据库名字
$db_selected  = mysqli_select_db($link,'vote');
if(!$db_selected){
    echo "selected db error!";
    exit();
}
//设置数据库字符集
$link -> query("set names utf8");