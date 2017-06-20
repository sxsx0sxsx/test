<?php

$arr=select("code","`id`=1");
  view("code/index","admin",array("arr"=>$arr));
?>