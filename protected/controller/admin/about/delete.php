<?php
if(!empty($_GET["id"])){
	$id=$_GET["id"];
	
	$arr = select("about_us","`id`=$id"); //查询该id对应的记录
     $image = json_decode($arr["image"]);
     $thumb_image = json_decode($arr["thumb_image"]);
     $water_image =json_decode($arr["water_image"]);
     
     $res = delete("about_us",$id);
     if($res>0){
         //循环删除原图 缩略图 水印图
          for($i=0;$i<count($image);$i++){
             unlink($image[$i]);
             unlink($thumb_image[$i]);
             unlink($water_image[$i]);

         }
     	 header("location:index.php?admin=admin&m=about&a=index");
     }
}


?>