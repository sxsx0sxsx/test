<?php
if(!empty($_GET["id"])){
	$id=$_GET["id"];
	$arr=select("product","`id`=$id");
	$arr["image"]=json_decode($arr["image"]);
	$category=select("category","`id`=".$arr["category"]);
}




view("product/pro_details","site",array("arr"=>$arr,"category"=>$category));


?>