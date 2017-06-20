<?php
  function page($table,$url,$page_num="8",$fix_num="5",$join_col="",$join_table="",$join_on="",$order="`time` DESC",$where=''){
  
  $curpage = !empty($_GET["curpage"])?$_GET["curpage"]:1; //获取当前页码数，如果当前页码数不存在，则从第一页开始
  
 
  $totalnum =counts($table,$where); //调用总记录条数函数

  $totalpage = ceil($totalnum/$page_num);//计算总页码数

   $curpage =$curpage>$totalpage?$totalpage:$curpage;

 //首页
  $page ='<a href="'.$url.'&curpage=1" title="First Page">&laquo; 第一页</a>';
  //前一页
  $previous =$curpage-1; //前一页
  //如果上一页大于等于1，则显示上一页 ，否则不显示上一页
  if($previous>=1){
     $page.='<a href="'.$url.'&curpage='.$previous.'" title="Previous Page">&laquo; 上一页</a>';
  }
  //具体页码数
  $startpage = $curpage-floor($fix_num/2); //开始的页码
  $endpage = $curpage+floor($fix_num/2); //结束的页码
  //开始位置的下标小于1，则开始位置从1开始，结束为固定页码数
  if($startpage<1){
     $startpage=1;
     $endpage = $fix_num;
  }
  //结束位置的下标大于总页码，则结束位置为总页码数，开始位置为总页码-固定页码数+1
  if($endpage>$totalpage){
      $endpage=$totalpage;
      $startpage= $endpage-$fix_num+1;
  }

 //结束页码小于固定页码，则开始页码从1开始  结束页码等于从页码
  if($endpage<$fix_num){
      $startpage=1; 
      $endpage = $totalpage; 
  }

  for($i=$startpage;$i<=$endpage;$i++){
    if($i==$curpage){ //判断页码是否为当前页码，如果是则class中添加current
       $page.='<a href="'.$url.'&curpage='.$i.'" class="number current" title="'.$i.'">'.$i.'</a>';
    }else{
      $page.='<a href="'.$url.'&curpage='.$i.'" class="number" title="'.$i.'">'.$i.'</a>';
    }

  }
 
  //下一页
  $next = $curpage+1;
  //下一页如果小于等于总页码，显示下一页，否则不显示下一页
  if($next<=$totalpage){
   $page.='<a href="'.$url.'&curpage='.$next.'" title="Next Page">下一页 &raquo;</a>';
  } 
  //尾页
  $page.='<a href="'.$url.'&curpage='.$totalpage.'" title="Last Page">最后一页 &raquo;</a>';

  $start=($curpage-1)*$page_num;//代表查询Limit开始的位置
  if(!$where){
    if(empty($join_table)){
       $sql2 ="SELECT * FROM `$table` ORDER BY $order LIMIT $start,$page_num";
    }else{
      $sql2 ="SELECT $join_col FROM `$table` LEFT JOIN `$join_table` ON $join_on ORDER BY $order LIMIT $start,$page_num";
    } 
 }else{
     if(empty($join_table)){
      $sql2 ="SELECT * FROM `$table` WHERE $where ORDER BY $order LIMIT $start,$page_num ";
    }else{
       $sql2 ="SELECT $join_col FROM `$table` LEFT JOIN `$join_table` ON $join_on WHERE $where ORDER BY $order LIMIT $start,$page_num ";
    }
 }
  $resource2 = mysql_query($sql2);

  $arr =[];
  while($r = mysql_fetch_assoc($resource2)){
      $arr[]=$r;
  }

  return array("arr"=>$arr,"page"=>$page,"curpage"=>$curpage);
   
}



function page_site($table,$url,$page_num="8",$fix_num="5",$order="`time` DESC",$where=''){
  
  $curpage = !empty($_GET["curpage"])?$_GET["curpage"]:1; //获取当前页码数，如果当前页码数不存在，则从第一页开始
  
 
  $totalnum =counts($table,$where); //调用总记录条数函数

  $totalpage = ceil($totalnum/$page_num);//计算总页码数

   $curpage =$curpage>$totalpage?$totalpage:$curpage;

 //首页
  $page ='<ul><li class="one"><a href="'.$url.'&curpage=1" title="First Page">首页</a></li>';
  //前一页
  $previous =$curpage-1; //前一页
  //如果上一页大于等于1，则显示上一页 ，否则不显示上一页
  if($previous>=1){
     $page.='<li class="one"><a href="'.$url.'&curpage='.$previous.'" title="Previous Page">上一页</a></li>';
  }
  //具体页码数
  $startpage = $curpage-floor($fix_num/2); //开始的页码
  $endpage = $curpage+floor($fix_num/2); //结束的页码
  //开始位置的下标小于1，则开始位置从1开始，结束为固定页码数
  if($startpage<1){
     $startpage=1;
     $endpage = $fix_num;
  }
  //结束位置的下标大于总页码，则结束位置为总页码数，开始位置为总页码-固定页码数+1
  if($endpage>$totalpage){
      $endpage=$totalpage;
      $startpage= $endpage-$fix_num+1;
  }

 //结束页码小于固定页码，则开始页码从1开始  结束页码等于从页码
  if($endpage<$fix_num){
      $startpage=1; 
      $endpage = $totalpage; 
  }

  for($i=$startpage;$i<=$endpage;$i++){
    if($i==$curpage){ //判断页码是否为当前页码，如果是则class中添加present
       $page.='<li class="present"><a href="'.$url.'&curpage='.$i.'"  title="'.$i.'">'.$i.'</a></li>';
    }else{
      $page.='<li><a href="'.$url.'&curpage='.$i.'"  title="'.$i.'">'.$i.'</a></li>';
    }

  }
 
  //下一页
  $next = $curpage+1;
  //下一页如果小于等于总页码，显示下一页，否则不显示下一页
  if($next<=$totalpage){
   $page.='<li class="one"><a href="'.$url.'&curpage='.$next.'" title="Next Page">下一页</a></li>';
  } 
  //尾页
  $page.='<li class="one"><a href="'.$url.'&curpage='.$totalpage.'" title="Last Page">尾页</a></li></ul>';

  $start=($curpage-1)*$page_num;//代表查询Limit开始的位置
  if(!$where){
  $sql2 ="SELECT * FROM `$table` ORDER BY $order LIMIT $start,$page_num";
 }else{
   
    $sql2 ="SELECT * FROM `$table` WHERE $where ORDER BY $order LIMIT $start,$page_num ";
 }
  $resource2 = mysql_query($sql2);

  $arr =[];
  while($r = mysql_fetch_assoc($resource2)){
      $arr[]=$r;
  }

  return array("arr"=>$arr,"page"=>$page,"curpage"=>$curpage);
   
}
?>