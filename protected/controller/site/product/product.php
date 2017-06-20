<?php
$cate=selects("category","`pid`=3");
$a=$cate[0]["id"];
if(isset($_SESSION["pro_cate"])){
	$i=$_SESSION["pro_cate"];
    $arr=page_site("product","index.php?admin=site&m=product&a=product",8,5,"`time` DESC","`category`=$i");
}else{
	
	$arr=page_site("product","index.php?admin=site&m=product&a=product",8,5,"`time` DESC","`category`=$a");
}


for($i=0;$i<count($arr["arr"]);$i++){
 $arr["arr"][$i]["image"]=json_decode($arr["arr"][$i]["image"])[0];
 $arr["arr"][$i]["thumb_image"]=json_decode($arr["arr"][$i]["thumb_image"])[0];
 $arr["arr"][$i]["water_image"]=json_decode($arr["arr"][$i]["water_image"])[0];
 }

 $arr["cate"]=$cate;

if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){ 
   //如果该数据不为空，则代表是ajax请求
 	if(!empty($_POST)){
 		$category=$_POST["category"];
 		$_SESSION["pro_cate"]=$category;
 		$arr=page_site("product","index.php?admin=site&m=product&a=product",8,5,"`time` DESC","`category`=$category");
 		for($i=0;$i<count($arr["arr"]);$i++){
			 $arr["arr"][$i]["image"]=json_decode($arr["arr"][$i]["image"])[0];
			 $arr["arr"][$i]["thumb_image"]=json_decode($arr["arr"][$i]["thumb_image"])[0];
			 $arr["arr"][$i]["water_image"]=json_decode($arr["arr"][$i]["water_image"])[0];
 		}
 		echo json_encode($arr);die;
 	}
    echo json_encode($arr);die;//将数组转化为json格式的字符串

 }

//var_dump($arr);die;

view("product/product","site",$arr);


?>