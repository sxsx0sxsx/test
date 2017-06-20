<?php

$arr=select("contact_us","`id`=1");
  view("contact/index","admin",array("arr"=>$arr));
?>