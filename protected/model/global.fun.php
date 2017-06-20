<?php

 //加载视图
  function view($url,$admin="admin",$data=array()){
       extract($data); 
       if($admin=="admin"){//判断是否为后台
       	  //将xml文件转化为php的对象
       	  $xml = simplexml_load_file("protected/model/menu.xml");
       }
      include("protected/view/$admin/header.html");
     include("protected/view/$admin/$url.html");
     include("protected/view/$admin/footer.html");
  }
?>