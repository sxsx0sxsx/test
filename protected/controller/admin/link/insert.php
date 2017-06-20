<?php
 if(!empty($_POST)){
 	  //print_r($_POST);die;
 	 
 	 $_POST["time"]=time();

 	 $result = insert($_POST,"link");
 	 if($result){
 	 	  header("location:index.php?admin=admin&m=link&a=index");
 	 }
 }
 view("link/insert","admin",array());

?>