<?php

$cate=selects("category","`pid`=2");
$a=$cate[0]["id"];
if(isset($_SESSION["news_cate"])){
	$i=$_SESSION["news_cate"];
    $arr=page_site("news","index.php?admin=site&m=news&a=news",8,3,"`time` DESC","`category`=$i");
}else{
	
	$arr=page_site("news","index.php?admin=site&m=news&a=news",8,3,"`time` DESC","`category`=$a");
}


for($i=0;$i<count($arr["arr"]);$i++){
 $arr["arr"][$i]["time"]=date("y-m-d",$arr["arr"][$i]["time"]);
 $arr["arr"][$i]["content"]=mb_substr($arr["arr"][$i]["content"],0,200,"utf-8");
 }
$arr["cate"]=$cate;

if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){ 
   //如果该数据不为空，则代表是ajax请求
 	if(!empty($_POST)){
 		$category=$_POST["category"];
 		$_SESSION["news_cate"]=$category;
 		$arr=page_site("news","index.php?admin=site&m=news&a=news",8,3,"`time` DESC","`category`=$category");
 		for($i=0;$i<count($arr["arr"]);$i++){
			 $arr["arr"][$i]["time"]=date("y-m-d",$arr["arr"][$i]["time"]);
			 $arr["arr"][$i]["content"]=mb_substr($arr["arr"][$i]["content"],0,200,"utf-8");
		   }
 	
 		echo json_encode($arr);die;
 	}
    echo json_encode($arr);die;//将数组转化为json格式的字符串

 }

//print_r($arr);die;

view("news/news","site",$arr);


?>