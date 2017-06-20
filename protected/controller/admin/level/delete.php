<?php
if(!empty($_GET["id"])){
	$id=$_GET["id"];
    $res = delete("level",$id);
     if($res>0){
          
     	 header("location:index.php?admin=admin&m=level&a=index");
     }
}




?>