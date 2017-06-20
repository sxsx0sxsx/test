<?php
  $arr1=page("message","index.php?admin=admin&m=message&a=index",8,3,"","","","`time` DESC","`delete`=0");
 $arr2=$arr1;
 for($i=0;$i<count($arr1["arr"]);$i++){
 $arr2["arr"][$i]["time"]=date("y-m-d H:i:s",$arr1["arr"][$i]["time"]);
 $arr2["arr"][$i]["message"]=mb_substr($arr1["arr"][$i]["message"],0,20,"utf-8");
 }
if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"])){ 
   //如果该数据不为空，则代表是ajax请求
 	
    echo json_encode($arr2);die;//将数组转化为json格式的字符串

 }

  
view("message/index","admin",$arr2);

?>