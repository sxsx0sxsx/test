<?php

   if(!empty($_GET["id"])){

       $id =$_GET["id"];

        if(!empty($_POST)){
          //print_r($_POST);die;
           $reuslt = update($_POST,"category",$id);
           if($result>=0){
              header("location:index.php?admin=admin&m=category&a=index");
           }

        }


       $current = select("category","`id`=$id");
       $category = getTongji($id);
 //print_r($category);die;
       $category =array_reverse($category,true); //true设置数组反转时保留之前的下标
       //print_r($category);die;
       view("category/update","admin",array("current"=>$current,"category"=>$category));

   }


?>