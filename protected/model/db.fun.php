<?php

/**
  *连接数据库并选择具体的数据库项目
*/
function connect($db="30890dbZ523j",$domain="121.40.34.175",$username="30890_fM2374",$password="RN5DjaHscbTRfIr"){
	//第一步:连接数据库服务器
   $conn = mysql_connect($domain,$username,$password) or die("您数据库服务器连接失败");
   //第二步：选择数据库
   $db = mysql_select_db($db) or die("数据库项目不存在");
   //第三步：设置传输编码
    mysql_query("set names utf8");
}

/**
*select()  查询单条记录
*/
function select($table,$where){
	$sql = "SELECT * FROM `$table` WHERE $where";
  
    //第五步：执行sql语句
    $result = mysql_query($sql); //如果查询成功返回资源类型   如果sql错误,则返回false
   
    $arr =mysql_fetch_assoc($result);
    return $arr;
}

/**
* 查询多条记录
*/
function selects($table,$where='1'){ //默认查询所有
   $sql = "SELECT * FROM `$table` WHERE $where ";
   $resource = mysql_query($sql);
    $arr =array();
    while($r = mysql_fetch_assoc($resource)){
      $arr[]=$r;
    }
    return $arr;

}

/**
*insert()  新增数据
*/
function insert($arr,$table){
  $kstring="";
  $vstring="";
  foreach($arr as $k=>$v){
     $kstring.="`$k`,";
     $vstring.="'$v',";

  }
  $kstring=substr($kstring,0,-1); //将最后一个,去除
  $vstring=substr($vstring,0,-1);//将最后一个,去除

   $sql ="INSERT INTO `$table` ($kstring) VALUES($vstring)";
   mysql_query($sql);
   return mysql_affected_rows(); //返回数据库影响的函数
}

/**
*insert()  修改数据
*/
function update($arr,$table,$id){
  $cstring="";
  foreach($arr as $k=>$v){
    $cstring.="`$k`='$v',";
  }
    $cstring=substr($cstring,0,-1); //将最后一个,去除
    $sql1="UPDATE `$table` SET $cstring WHERE `id`=$id  ";
    $result=mysql_query($sql1);
    return mysql_affected_rows();
}

/**
*delete()  删除数据
*/
function  delete($table,$id){
    $sql ="DELETE FROM `$table` WHERE `id`=$id";
    mysql_query($sql);
    return mysql_affected_rows();
     
}

/**
*counts()  查询数据库总条数
*/
function counts($table,$where=""){
 if(!$where){
   $sql1="SELECT COUNT(*) AS `count` FROM `$table`"; //查询数据库总条数
 }else{
    $sql1="SELECT COUNT(*) AS `count` FROM `$table` WHERE $where";
 }
 
  $resource1 = mysql_query($sql1);
   
   $result = mysql_fetch_assoc($resource1);

  $totalnum =$result["count"]; //获取数据库总记录条数
  return $totalnum;
}
?>