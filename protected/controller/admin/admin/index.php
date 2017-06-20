<?php
 $sql = "SELECT `admin`.*,`name` FROM `admin` LEFT JOIN `level` ON `admin`.`level`=`level`.`id`";
   $resource = mysql_query($sql);
    $arr =array();
    while($r = mysql_fetch_assoc($resource)){
      $arr[]=$r;
    }
  

  view("admin/index","admin",array("arr"=>$arr));

?>