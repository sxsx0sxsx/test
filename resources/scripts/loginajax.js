//验证用户名
$("input[name='username']").blur(function(){
    var user_error= $(".user_error").html();
    var password = $("input[name='password']").val();
    var username = $("input[name='username']").val();
    var url = window.location.href;
   $.ajax({
     type:"POST",
     url:"index.php?admin=admin&m=login&a=login",
     data:"username="+username,
     success:function(msg){
     	 if(msg==1){
     	 	 $(".user_error").html("用户名不存在");
     	 }else if(msg==3){
            $(".user_error").html("用户名未输入");
         }else{
     	 	 $(".user_error").html("");
     	 }
     }

   })
})
//验证密码  :条件 有用户名才验证 没用户名不验证
  $("input[name='password']").blur(function(){
      var url = window.location.href;
      var user_error= $(".user_error").html();
      var password = $("input[name='password']").val();
      var username = $("input[name='username']").val();
      if(user_error==""){ //用户名输入正确 验证密码
         $.ajax({
            type:"POST",
            url:"index.php?admin=admin&m=login&a=login",
            data:"username="+username+"&password="+password,
            success:function(msg){
                if(msg==2){
                $(".pass_error").html("密码错误");
                }else if(msg==4){
                    $(".pass_error").html("密码为空");
                }else{
                    $(".pass_error").html("");
                }
            }
         })

      }

  })

//验证验证码是否正确
$("input[name='code']").change(function(){
   var code =$("input[name='code']").val();
   var password = $("input[name='password']").val();
   var username = $("input[name='username']").val();
   var url =window.location.href;
    $.ajax({
            type:"POST",
            url:"index.php?admin=admin&m=login&a=login",
            data:"code="+code+"&username="+username+"&password="+password,
            success:function(msg){
               if(msg==6){
                  $(".code_error").html("验证码错误");
               }else{
                  $(".code_error").html("");
                  
               }
            }
   })

})

//给form表单绑定提交事件，当用户名密码 验证输入正确提交
$("form").submit(function(){
    var username = $("input[name='username']").val();
       if(username==""){
          $(".user_error").html("您用户名不能为空")
       }
   var password =$("input[name='password']").val();
     if(password==""){
        $(".pass_error").html("密码不能为空");
     }
   var code =$("input[name='code']").val();
   if(code==""){
     $(".code_error").html("验证码不能为空");
   }


   var user_error=  $(".user_error").html();
   var pass_error = $(".pass_error").html();
   var code_error = $(".code_error").html();

   if(user_error.length!=0||pass_error.length!=0||code_error.length!=0){

      return false;
   }

})