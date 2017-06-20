<?php

  //print_r($_SESSION["level"]);die;

  $arr = selects("level");
  for($i=0;$i<count($arr);$i++){
 $arr[$i]["time"]=date("y-m-d",$arr[$i]["time"]);
 }

  view("level/index","admin",array("arr"=>$arr));
?>