<?php

 unset($_SESSION["username"]); 
 unset($_SESSION["password"]); 
 setcookie("username","",0); 
 setcookie("password","",0);
 header("location:index.php?admin=admin&m=login&a=login");


?>