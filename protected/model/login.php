<?php
if($a=="login"){
		if(!isset($_SESSION['name'])){
		$_SESSION['name']="";
	}
	if(!isset($_SESSION['word'])){
		$_SESSION['word']="";
	}

	if(!empty($_SESSION["username"]) || !empty($_COOLIE["username"])){
		header("location:index.php?admin=admin&m=login&a=index");
	}
}else if($admin=="admin"&&$a!="login"){
		if(empty($_SESSION["username"]) && empty($_COOKIE["username"])){ 
			if($a!="password"&&$a!="sendemail"){
	     header("location:index.php?admin=admin&m=login&a=login");
	   }
	  }
	  if(empty($_SESSION["username"]) && !empty($_COOLIE["username"])){
		$_SESSION["username"]=$_COOLIE["username"];
	}

	//-----权限验证开始  判断用户是否存在该权限 ，不存在则需要中断程序
      if($m!="login" && $admin=="admin"){
        
       $xml = simplexml_load_file("protected/model/menu.xml"); //获取xml文件数据
          $module_level=0; //模块的权限
          $action_level =0; //操作的权限
       foreach($xml->controller as $k=>$v){
       
          if($v->name->attributes()->en==$m){
              $module_level = $v->name->attributes()->level;
               foreach($v->action  as $k1=>$v1){
                  if($v1->name->attributes()->en ==$a){
                      $action_level=$v1->name->attributes()->level;
                  }
               }
          }
       }
    

       if(!in_array($module_level,$_SESSION["level"])||!in_array($action_level,$_SESSION["level"])){
     
         
            header("location:index.php?admin=admin&m=login&a=redirect");
            die;
            //注意：权限判断跳转完毕必须中断程序
       }
      }
       //------权限验证结束






	  if(!empty($_SESSION["username"])){ 
	     $user = $_SESSION["username"];
	  }else if(!empty($_COOKIE["username"])){

	     $user = $_COOKIE["username"];
	  }
}





?>