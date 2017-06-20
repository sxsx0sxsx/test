<?php

  
  $arr=select("code","`id`=1");

  if(!empty($_POST)){
    unset($_POST["check"]);
    if(!empty($_FILES["image"]["name"])){ //判断是否有上传图片
     //var_dump($_FILES);die;
      unlink($arr["image"]);

       $images_type = ["image/gif","image/jpg","image/jpeg","image/png"];
       if(!in_array($_FILES["image"]["type"],$images_type)){ //判断一个值是否在数组中。

             die("您上传的必须为图片");
       }
       if($_FILES["image"]["size"]>2*1024*1024){
          die("您上传的文件不能大于2M");
      }

       $path ="upload/code/"; //永久的路径
       $name = $_FILES["image"]["name"]; //设置图片上传之后的新的名称
       
       if(!file_exists($path)){ //判断路径是否存在
            
           mkdir($path,0777,true); //如果路径不存在，则生成路径 777最大的权限(删除 新增 修改 查询)
       }
       move_uploaded_file($_FILES["image"]["tmp_name"],$path.$name); //将图片从临时路径中转移到永久的路径中
        
       $_POST["image"] =$path.$name;
       
     }
       $_POST["time"]=time();
       $result =update($_POST,"code",1); //调用修改函数
       if($result){
          header("location:index.php?admin=admin&m=code&a=index");
       }else{
          echo "<script>alert('二维码修改失败')</script>";
       }

    
  
  
}
  
  $arr1["arr"]=$arr;
view("code/update","admin",$arr1);
?>