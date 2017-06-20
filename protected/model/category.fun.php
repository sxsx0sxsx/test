<?php
//获取顶级分类的函数
  function getCategory($pid=0,$category=array(),$level=0){ //$level表示层级

  $sql ="SELECT * FROM `category` WHERE `pid`=$pid"; //查找顶级分类
  $resources = mysql_query($sql);
  $arr=[];//存放顶级分类
  while($r =mysql_fetch_assoc($resources)){
  	  $arr[]=$r; //将顶级分类添加到分类树中
  }

if(!empty($arr)){
 // 循环顶级分类  查找二级分类
foreach($arr as $k1=>$v1){
	 //拼接|-
	$str="<span style='color:red'>";
	for($i=0;$i<$level;$i++){
       $str.="|--";
	}
	$str.="</span>";
	$v1["name"]=$str.$v1["name"];
    $category[]=$v1; //将顶级分类添加到分类树中

     $category=getCategory($v1["id"],$category,$level+1);
    
  }
}
  return $category;
}


 function  getTongji($id,$category=array()){
            if($id>0){ //递归的条件是id必须大于0
            $current = select("category","`id`=$id");  //获取当前分类信息

           $tongji = selects("category","`pid`=".$current['pid']); //查找当前分类的所有同级分类
           $category[$id]=$tongji;

           $category = getTongji($current["pid"],$category);
           }
           return $category;
       }
?>