<?php
$arr=array();

//找三张最新的banner图
$sql1 = "SELECT * FROM `banner` ORDER BY `time` DESC LIMIT 0,3 ";
$resource1 = mysql_query($sql1);
$banner =array();
while($r1 = mysql_fetch_assoc($resource1)){
  $banner[]=$r1;
}
$arr["banner"]=$banner;

//找四条最新产品
$sql2 = "SELECT * FROM `product` ORDER BY `time` DESC LIMIT 0,4 ";
$resource2 = mysql_query($sql2);
$product =array();
while($r2 = mysql_fetch_assoc($resource2)){
  $product[]=$r2;
}
for($i=0;$i<count($product);$i++){
 $product[$i]["image"]=json_decode($product[$i]["image"])[0];
 }
$arr["product"]=$product;

//找公司介绍
$about_us=select("about_us","`id`=6");
$about_us["image"]=json_decode($about_us["image"]);
$arr["about_us"]=$about_us;

//找三条最新新闻
$sql3 = "SELECT * FROM `news` ORDER BY `time` DESC LIMIT 0,3 ";
$resource3 = mysql_query($sql3);
$news =array();
while($r3 = mysql_fetch_assoc($resource3)){
  $news[]=$r3;
}
for($i=0;$i<count($news);$i++){
 $news[$i]["time"]=date("y-m-d",$news[$i]["time"]);
 }
$arr["news"]=$news;


view("index/index","site",$arr);
?>