<?php
if(!empty($_GET["id"])){ //判断是否传递id
 $id=$_GET["id"];
  $curpage=$_GET["curpage"]; 
  $arr=select("message","`id`=$id");
}
$arr["time"]=date("Y/m/d H:i:s",$arr["time"]);
$arr["curpage"]=$curpage;
  $arr1=["arr"=>$arr];
view("message/look","admin",$arr1);