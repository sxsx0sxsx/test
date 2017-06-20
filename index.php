<?php

//设置路由规则
$admin = !empty($_GET["admin"])?$_GET["admin"]:"site";//获取分组名，默认访问前台
if($admin=="admin"){
	$m = !empty($_GET["m"])?$_GET["m"]:"login";
	$a = !empty($_GET["a"])?$_GET["a"]:"login";
}else{
	$m=!empty($_GET["m"])?$_GET["m"]:"index";
	$a=!empty($_GET["a"])?$_GET["a"]:"index";
}
include("protected/model/init.php");
include("protected/model/login.php");
include("protected/controller/$admin/$m/$a.php");


//print_r($site_footer);die;
?>