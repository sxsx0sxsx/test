<?php
$contact=select("contact_us","`id`=1");

if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){//判断是否为ajax请求
	$code =$_POST["code"];
	if(strtolower($code)==strtolower($_SESSION["VerifyCode"])){         
		     echo 1;die;//验证码正确 
	}else{
			 echo 2;die;//验证码错误
		 }

} 
if(!empty($_POST)){
	$arr=array(
	"name"=>$_POST["name"],
	"email"=>$_POST["email"],
	"phone"=>$_POST["phone"],
	"message"=>$_POST["message"],
	"time"=>time()
	);
	$result=insert($arr,"message");
	
}

view("contact/contact","site",array("contact"=>$contact));
?>