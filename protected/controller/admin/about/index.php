<?php


 //$arr=selects("about_us");
$sql="SELECT `about_us`.*,`name` FROM `about_us` LEFT JOIN `category` ON `about_us`.`category`=`category`.`id` ";
$resource = mysql_query($sql);
  $arr =[];
  while($r = mysql_fetch_assoc($resource)){
      $arr[]=$r;
  }
for($i=0;$i<count($arr);$i++){
  $arr[$i]["image"]=json_decode($arr[$i]["image"])[0];
  $arr[$i]["time"]=date("y-m-d",$arr[$i]["time"]);
}

 view("about/index","admin",array("arr"=>$arr));

?>