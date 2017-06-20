<?php
 if(!empty($_POST)){
 	  //print_r($_POST);die;
 	 $_POST["level"] = json_encode($_POST['level']); //将数组转化为json格式字符串
 	 $_POST["time"]=time();

 	 $result = insert($_POST,"level");
 	 if($result){
 	 	  header("location:index.php?admin=admin&m=level&a=index");
 	 }
 }
 view("level/insert","admin",array());

?>