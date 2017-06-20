<?php
if(!empty($_GET["id"])){ //判断是否传递id
  $id=$_GET["id"];
  $arr=select("link","`id`=$id");
}
  if(!empty($_POST)){
       $_POST["time"]=time();
       $result =update($_POST,"link",$id); //调用修改函数
       if($result){
          header("location:index.php?admin=admin&m=link&a=index");
       }else{
          echo "<script>alert('修改失败')</script>";
       }

    
  
  
}
  
  
view("link/update","admin",array("arr"=>$arr));
?>