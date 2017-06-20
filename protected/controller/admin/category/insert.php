<?php
  if(!empty($_POST)){
  	  $result = insert($_POST,"category");
  	  if($result>0){
  	  	 header("location:index.php?admin=admin&m=category&a=index");
  	  }
  }

  $category = getCategory();
  //print_r($category);die;
  view("category/insert","admin", array("category"=>$category));

?>