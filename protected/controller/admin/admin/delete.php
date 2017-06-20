<?php
if(!empty($_GET["id"])){
	$id=$_GET["id"];
    $res = delete("admin",$id);
     if($res>0){
          
     	 header("location:index.php?admin=admin&m=admin&a=index");
     }
}




?>