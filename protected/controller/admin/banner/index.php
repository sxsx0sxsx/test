<?php

 $sql = "SELECT * FROM `banner` ORDER BY `time` DESC ";
   $resource = mysql_query($sql);
    $arr =array();
    while($r = mysql_fetch_assoc($resource)){
      $arr[]=$r;
    }




 for($i=0;$i<count($arr);$i++){
 $arr[$i]["time"]=date("y-m-d",$arr[$i]["time"]);
 }


//print_r($arr);die;




 

 view("banner/index","admin",array("arr"=>$arr));

?>