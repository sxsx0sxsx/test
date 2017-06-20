<?php

 //从权限表中获取所有的权限
$arr = selects("level");
if(!empty($_POST)){	 
	$_POST["password"]=md5($_POST["password"]);
 	 $result = insert($_POST,"admin");
 	 if($result){
 	 	  header("location:index.php?admin=admin&m=admin&a=index");
 	 }
 }

 if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){
 	$username=$_GET["username"];
    $arr1=select("admin","`username`='$username'");   
 	if($arr1){
 		echo 1;die;
 	}else{
 		echo 2;die;
 	}
 }
view("admin/insert","admin",array("arr"=>$arr))
?>