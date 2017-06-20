<?php

$category =getCategory();

view("category/index","admin",array("arr"=>$category));


?>