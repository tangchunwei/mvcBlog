<?php
// 定义常量
define('ROOT',dirname(__FILE__).'/../');
// 实现类的自动加载
function autoload($class){
    $path=str_replace('\\','/',$class);
    // echo ROOT.$path.'.php';
    require(ROOT.$path.'.php');
    // die;
}
spl_autoload_register('autoload');
// 获取url
if(isset($_SERVER['PATH_INFO'])){
    $pathInfo=$_SERVER['PATH_INFO'];
    $pathInfo=explode('/',$pathInfo);
    $controller=ucfirst($pathInfo[1]).'Controller';
    $action=$pathInfo[2];
}else{
    // 默认控制器方法
    $controller='IndexController';
    $action='index';
}
// 为控制器添加命名空间
$fullController='controllers\\'.$controller;
$_C=new $fullController;
$_C->$action();

// 加载视图
function view($viewFileName,$data=[]){
    // 解压数组成变量
    extract($data);
    $path=str_replace('.','/',$viewFileName).'.html';
    // 加载视图
    require(ROOT.'views/'.$path);
}
