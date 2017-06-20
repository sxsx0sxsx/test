<?php
if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){
    if(!empty($_GET["code"])){
	 $code =md5($_GET["code"]);
     if($code==$_COOKIE["emailcode"]){
     	 echo 3;die;
     }else{
     	  echo 4;die;
     }
    }

     if(!empty($_POST["change_user"])){
        $username=$_POST["change_user"];
        $arr=select("admin","`username`='$username'");
        if($arr){
            $_SESSION["change_user"]=$arr["username"];
            $_SESSION["change_email"]=$arr["email"];
            $_SESSION["change_id"]=$arr["id"];
            echo 1;die;
        }else{
            echo 2;die;
        }

     }
}

if(!empty($_POST["password"])){
    $_POST["password"] =md5($_POST["password"]);
    $_POST["username"] =$_SESSION["change_user"];
    $id=$_SESSION["change_id"];
	$result = update($_POST,"admin",$id);
         if($result>0){
             
              header("location:index.php?admin=admin&m=login&a=login");
         }
	/*$username = $_POST["username"];
	$_POST["password"] =md5($_POST["password"]);
    $arr =select("admin","`username`='$username'");
    if($arr["email"]==$_POST["email"]){
    	 $result = update($_POST,"admin","`id`=".$arr['id']);
    	 if($result>0){
    	 	 
    	 	  header("location:index.php?admin=admin&m=login&a=login");
    	 }
    }*/
}
include("protected/view/admin/login/password.html");
?>