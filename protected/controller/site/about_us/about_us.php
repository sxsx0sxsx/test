<?php
$cate=selects("category","`pid`=1");
$i=$cate[1]["id"];
$arr=select("about_us","`category`=$i");

if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){ 
   //如果该数据不为空，则代表是ajax请求
	$category=$_GET["category"];
	$arr=select("about_us","`category`=$category");
	$arr["image"]=json_decode($arr["image"])[0];
	echo json_encode($arr);die;

}


$arr["image"]=json_decode($arr["image"])[0];    
//var_dump($arr);die;

view("about_us/about_us","site",array("arr"=>$arr,"cate"=>$cate));


?>