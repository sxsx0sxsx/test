<?php
if(!empty($_GET["id"])){ //判断是否传递id
 $id=$_GET["id"];
  
  $arr=select("banner","`id`=$id");
}
  if(!empty($_POST)){
    unset($_POST["check"]);
    if(!empty($_FILES["image"]["name"])){ //判断是否有上传图片
     //var_dump($_FILES);die;
      unlink($arr["image"]);
      unlink($arr["thumb_image"]);
      unlink($arr["water_image"]);

       $images_type = ["image/gif","image/jpg","image/jpeg","image/png"];
       if(!in_array($_FILES["image"]["type"],$images_type)){ //判断一个值是否在数组中。

             die("您上传的必须为图片");
       }
       if($_FILES["image"]["size"]>2*1024*1024){
          die("您上传的文件不能大于2M");
      }

     
      $year =date("Y",time()); //查找当年
      $month =date("m",time()); //查找月份
       $path ="upload/banner/$year/$month/"; //永久的路径
       $name = time().rand(1000,9999).$_FILES["image"]["name"]; //设置图片上传之后的新的名称
       
       if(!file_exists($path)){ //判断路径是否存在
            
           mkdir($path,0777,true); //如果路径不存在，则生成路径 777最大的权限(删除 新增 修改 查询)
       }
       move_uploaded_file($_FILES["image"]["tmp_name"],$path.$name); //将图片从临时路径中转移到永久的路径中
       //生成缩略图
        $thumb_name =  time().rand(1000,9999)."thumb_".$_FILES["image"]["name"];
        $path_thumb = thumb($path.$name,$path.$thumb_name);
        //生成水印图
        $water_name =  time().rand(1000,9999)."water_".$_FILES["image"]["name"];
        $path_water = water($path.$name,$path.$water_name,"shuiyin.png");
        
       $_POST["image"] =$path.$name;
       $_POST["thumb_image"] =$path_thumb;
       $_POST["water_image"] =$path_water;
     }
       $_POST["time"]=time();
       $result =update($_POST,"banner",$id); //调用修改函数
       if($result){
          header("location:index.php?admin=admin&m=banner&a=index");
       }else{
          echo "<script>alert('banner图修改失败')</script>";
       }

    
  
  
}
  
  $arr1["arr"]=$arr;
view("banner/update","admin",$arr1);
?>