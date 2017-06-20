<?php
if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){ //判断是否为post请求

    //判断用户名和密码
    if(!empty($_POST["username"])){
    $username = $_POST["username"]; //获取用户名      
    $arr =select("admin","`username`='$username'"); //判断用户名是否存在    
    if(!empty($arr)){ 
        if(!empty($_POST["password"])){
            if(md5($_POST["password"])!=$arr["password"]){//判断密码是否输入正确
                echo 2;die;//密码错误输出2
            }else{
            	//验证验证码
				  if(!empty($_POST["code"])){
				      $code =$_POST["code"];
				      if(strtolower($code)==strtolower($_SESSION["VerifyCode"])){         
				         echo 5;die;//验证码正确 
				      }else{
				         echo 6;die;//验证码错误
				      }
				  }
            }
        }else{
        	echo 4; die;
        }
   
    }else{//如果用户名不存在，则返回1 ：1代表用户名不存在
       echo 1;die; //1:用户名不存在
    }
  }else{
  	echo 3;die;
  }
  
}






if(!empty($_POST)){
	$username=$_POST["username"];
	$password=MD5($_POST["password"]);
	
	$arr =select("admin","`username`='$username' AND `password`='$password'"); //判断用户名是否存在
	if($arr){
		$_SESSION["username"]=$arr["username"];
		$_SESSION["password"]=$_POST["password"];
        $level_arr =select("level","`id`=".$arr["level"]); 
          $level = $level_arr["level"]; //获取用户权限
          $_SESSION["level"]=json_decode($level); //将权限字符串转化为数组存储在session中
        if(isset($_POST["remember"])){
        	setcookie("username",$arr["username"],time()+60*30);
        	setcookie("password",$_POST["password"],time()+60*30);

        }
		header("location:index.php?admin=admin&m=login&a=index");
	}else{
		echo "<script>alert('密码或用户名错误')</script>";
	};
}

include("protected/view/admin/login/login.html");

?>