<?php
if(!empty($_GET["id"])){
	$id=$_GET["id"];
	$curpage=$_GET["curpage"];
	$arr=["delete"=>"1"];
	$result=update($arr,"message",$id);
	if($result>0){
		header("location:index.php?admin=admin&m=message&a=index&curpage=$curpage");
	}
}


?>