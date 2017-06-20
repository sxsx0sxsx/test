<?php
  if(!empty($_GET["id"])){
  	 $id =$_GET["id"]; 
  	 //获取该id对应的下一级分类
  	  $next = selects("category","`pid`=$id");

  	  echo json_encode($next);
  }

?>