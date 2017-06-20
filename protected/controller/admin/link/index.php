<?php

  

  $arr = selects("link");
  

  view("link/index","admin",array("arr"=>$arr));
?>