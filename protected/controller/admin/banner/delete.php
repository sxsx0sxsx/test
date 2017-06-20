<?php
if(!empty($_GET["id"])){
	$id=$_GET["id"];
	
	$arr = select("banner","`id`=$id"); //查询该id对应的记录
     $image =$arr["image"];
     $thumb_image=$arr["thumb_image"];
     $water_image=$arr["water_image"];

     $res = delete("banner",$id);
     if($res>0){
          
     	 unlink($image); //删除文件
         unlink($thumb_image);
         unlink($water_image);

     	 header("location:index.php?admin=admin&m=banner&a=index");
     }
}


?>