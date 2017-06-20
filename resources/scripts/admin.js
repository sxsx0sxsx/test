$(function(){
  var a=0;
  var b=0;
  var c=0;
  $("#username").blur(function(){//验证姓名是否为空
    if($("#username").val()==""){
        alert("姓名不能为空");a=0;
    }else{
        var username=$("#username").val();

        $.ajax({
            type:"GET",
            url:"index.php?admin=admin&m=admin&a=insert",
            data:"username="+username,
            success:function(msg){
                if(msg==1){
                    alert("用户名已存在");a=0;
                }else{
                    a=1;
                }
            }

        })
    }
  })

  $("#password").blur(function(){//验证密码是否为空
    if($("#password").val()==""){
        alert("密码不能为空");
    }
  })

  $("#password1").blur(function(){//验证密码是否正确
  	var password = $("#password").val();
  	var password1 = $("#password1").val();
  	if(password==password1){
  		b=1;
  	}else{
  		alert("两次密码不一样");b=0;
  	}
  })

  $("#email").blur(function(){//验证邮箱格式是否正确
    if($("#email").val()==""){
        alert("邮箱不能为空");c=0;
    }else if(!$("#email").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
        alert("邮箱格式不正确");c=0;
    }else{
        c=1;
    }
  })

  $("#myform").submit(function(){
    if(a+b+c!=3){
        return false;
    }
  })





})