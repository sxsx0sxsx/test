<?php
if(!empty($_POST)){ //判断是否为post请求
    
    if(!empty($_FILES["image"]["name"])){ //判断是否有上传图片
     //var_dump($_FILES);die;
       $images_type = ["image/gif","image/jpg","image/jpeg","image/png"];
       if(!in_array($_FILES["image"]["type"],$images_type)){ //判断一个值是否在数组中。

             die("您上传的必须为图片");
       }
       if($_FILES["image"]["size"]>2*1024*1024){
          die("您上传的文件不能大于2M");
      }
      

     
    	$year =date("Y",time()); //查找当年
    	$month =date("m",time()); //查找月份
       $path ="upload/news/$year/$month/"; //永久的路径
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
       $_POST["time"]=time();
       $result = insert($_POST,"news"); //调用新增函数
       if($result){
       	  header("location:index.php?admin=admin&m=news&a=index");
       }else{
       	  echo "<script>alert('新闻新增失败')</script>";
       }

    }

}

$cate=selects("category","`pid`=2");

view("news/insert","admin",array("cate"=>$cate));
?>