<?php
$arr=select("contact_us","`id`=1");
if(!empty($_POST)){
	$result = update($_POST,"contact_us",1);
	if($result>=0){
   	  header("location:index.php?admin=admin&m=contact&a=index");
   }else{
   	  echo "<script>alert('您修改失败')</script>";
   }
}


view("contact/update","admin",array("arr"=>$arr));


?>