<?php
if(!empty($_GET["id"])){ //判断是否传递id
  $id=$_GET["id"];
  $curpage=$_GET["curpage"]; 
  $arr=select("product","`id`=$id");
  $arr["image"]=json_decode($arr["image"]);
  $arr["thumb_image"]=json_decode($arr["thumb_image"]); 
  $arr["water_image"]=json_decode($arr["water_image"]); //产品所对应的原图的数组
  $cate=selects("category","`pid`=3");
  if(!empty($_POST)){
 /*  print_r($_POST);
    print_r($_FILES);die;*/
    $images=array();//存储需要上传的图片的路径
    $thumb_images =array(); //存储需要上传的图片的缩略图的路径
    $water_images=array(); //存储需要上传的图片的水印图的路径
    $images_style =["image/jpg","image/gif","image/png","image/jpeg"];
    if(!empty($_POST["check_images"])){ //判断是否有上传图片
       $check_images = $_POST["check_images"]; //存储需要上传图片的下标
       unset($_POST["check_images"]);
      $year =date('Y',time());
       $month =date('m',time());
       $path="upload/products/$year/$month/";//图片上传的路径
       if(!file_exists($path)){ //判断路径是否存在，不存在则生成路径
          mkdir($path,0777,true); 
       }
         //存储需要上传的图片的路径
       for($i=0;$i<count($_FILES["image"]["name"]);$i++){ //i表示图片的下标
          //判断该图片是否需要上传 ：判断图片对应的下标是否在$check_images 数组中
       	  if(in_array($i,$check_images)){ //如果判断成功，代表图片需要上传
       	  	  //判断图片格式
              if(!in_array($_FILES["image"]["type"][$i],$images_style)){
              	 die("文件上传格式错误，上传格式只能为图片");
              }
             //判断图片大小
              if($_FILES["image"]["size"][$i]>2*1024*1024){ //上传图片大小单位b
              	 die("文件大小不能超过2M");
              }
              
              $name = time().rand(1000,9999).$_FILES["image"]["name"][$i]; //设置图片的新名称
              //将临时图片存储到服务器永久路径中去
              move_uploaded_file($_FILES["image"]["tmp_name"][$i], $path.$name); 
              $images[] = $path.$name;
              //生成缩略图
              $thumb_name =  time().rand(1000,9999)."thumb_".$_FILES["image"]["name"][$i];
              $path_thumb = thumb($path.$name,$path.$thumb_name);
              $thumb_images[]=$path_thumb;

              //生成水印图
              $water_name =  time().rand(1000,9999)."water_".$_FILES["image"]["name"][$i];
              $path_water = water($path.$name,$path.$water_name,"shuiyin.png");
              $water_images[]=$path_water;
       	  }
       }
        //将保存图片的数组转化为json格式的字符串存储在数据库中       
   }

  
       $ready_check_images = $_POST["ready_check_images"]; //存储需要上传图片的下标
       unset($_POST["ready_check_images"]);
       for($i=0;$i<count($arr["image"]);$i++){ //i表示图片的下标
       	if(in_array($i,$ready_check_images)){
       		$images[] = $arr["image"][$i];
          $thumb_images[]=$arr["thumb_image"][$i];
          $water_images[]=$arr["water_image"][$i];
       	}else{
       		unlink($arr["image"][$i]);
          unlink($arr["thumb_image"][$i]);
          unlink($arr["water_image"][$i]);
       	}
       }
   

   $_POST["image"]=json_encode($images);
   $_POST["thumb_image"]=json_encode($thumb_images);
   $_POST["water_image"]=json_encode($water_images);
   $_POST["time"]=time();
   $result = update($_POST,"product",$id);
   if($result>0){
   	  header("location:index.php?admin=admin&m=product&a=index&curpage=$curpage");
   }else{
   	  echo "<script>alert('您修改失败')</script>";
   }

  }

  $arr1["cate"]=$cate;
  $arr1["arr"]=$arr;
  view("product/update","admin",$arr1);
}