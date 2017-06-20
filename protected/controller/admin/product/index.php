<?php
if(!empty($_POST["cate"])){
	$_SESSION["cate"]=$_POST["cate"];
}
  if(!isset($_SESSION["cate"])){
    $_SESSION["cate"]=3;
  }
$cate=selects("category","`pid`=3");
$check[]="";
foreach ($cate as $k => $v) {
  $check[]=$v["id"];
}

if(!in_array($_SESSION["cate"], $check)){
  $_SESSION["cate"]=3;
}

if($_SESSION["cate"]==3){
   $arr1=page("product","index.php?admin=admin&m=product&a=index",4,3,"`product`.*,`name`","category","`product`.`category`=`category`.`id`","`time` DESC");
}else{
  $i=$_SESSION["cate"];
  $arr1=page("product","index.php?admin=admin&m=product&a=index",4,3,"`product`.*,`name`","category","`product`.`category`=`category`.`id`","`time` DESC","`category`=$i");
 
}






 //$arr1=page("product","index.php?admin=admin&m=product&a=index",2,3,"`time` DESC","`delete`=0");



 $arr2=$arr1;
 for($i=0;$i<count($arr1["arr"]);$i++){
 $arr2["arr"][$i]["time"]=date("y-m-d",$arr1["arr"][$i]["time"]);
 }

$list = $arr2["arr"];
  foreach($list as $k=>$v){
    if(!empty($v["image"])){
       $image_arr = json_decode($v["image"]);
       $image = $image_arr[0];
       $arr2["arr"][$k]["image"]=$image;
    }
  }


$arr2["cate"]=$cate;



 if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){ 
   //如果该数据不为空，则代表是ajax请求
 	
    echo json_encode($arr2);die;//将数组转化为json格式的字符串

 }

 view("product/index","admin",$arr2);

?>