<?php
 if(!empty($_GET["id"])){
 	 $id= $_GET["id"]; 
 	 $arr = getcategory($id);//获取id该id对应的子

 	 //删除子元素
 	 foreach($arr as $k=>$v){
 	 	 delete("category",$v['id']);
 	 }
   
     //删除当前id对应的记录
     delete("category",$id);
     header("location:index.php?admin=admin&m=category&a=index");
  
 }

?>