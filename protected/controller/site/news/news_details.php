<?php
if(!empty($_GET["id"])){
	$id=$_GET["id"];
	$arr=select("news","`id`=$id");
	$time=$arr['time'];
	$category=$arr['category'];
    $arr["time"]=date("y-m-d",$arr["time"]);

	//上一页
	$sql = "SELECT * FROM `news` WHERE `time`>$time AND `category`=$category ORDER BY `time` ASC LIMIT 1";
	$result = mysql_query($sql); 
    $arr1 =mysql_fetch_assoc($result);
    if($arr1){
    	$pre='<h4>上一篇:<a href="index.php?admin=site&m=news&a=news_details&id='.$arr1["id"].'">'.$arr1["title"].'</a></h4>';
    }else{
    	$pre='<h4>上一篇:没有了</h4>';
    }

    //下一页
    $sql1 = "SELECT * FROM `news` WHERE `time`<$time AND `category`=$category ORDER BY `time` DESC LIMIT 1";
	$result1 = mysql_query($sql1); 
    $arr2 =mysql_fetch_assoc($result1);
    if($arr2){
    	$next='<h4>下一篇:<a href="index.php?admin=site&m=news&a=news_details&id='.$arr2["id"].'">'.$arr2["title"].'</a></h4>';
    }else{
    	$next='<h4>下一篇:没有了</h4>';
    }




}
view("news/news_details","site",array("arr"=>$arr,"pre"=>$pre,"next"=>$next));


?>