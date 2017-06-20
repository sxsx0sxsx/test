$(function(){
  var a=0;
  var b=0;
  var c=0;
  var d=0;
  var e=0;
  $("#name").blur(function(){//验证姓名是否为空
    if($("#name").val()==""||$("#name").val()=="姓名"){
        alert("姓名不能为空");a=0;
    }else{
        a=1;
    }
  })

  $("#email").blur(function(){//验证邮箱格式是否正确
    if($("#email").val()==""||$("#email").val()=="邮箱"){
        alert("邮箱不能为空");b=0;
    }else if(!$("#email").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
        alert("邮箱格式不正确");b=0;
    }else{
        b=1;
    }
  })

  $("#phone").blur(function(){//验证电话格式是否正确
    if($("#phone").val()==""||$("#phone").val()=="电话"){
        alert("电话不能为空");c=0;
    }else if(!$("#phone").val().match(/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i)){
        alert("电话格式不正确");c=0;
    }else{
        c=1;
    }
  })

  $("#message").blur(function(){//验证留言是否为空
    if($("#message").val()==""||$("#message").val()=="请你给我们留言"){
        alert("留言不能为空");d=0;
    }else{
        d=1;
    }
  })

  $("#code").blur(function(){
    if($("#code").val()==""||$("#code").val()=="验证码"){
        alert("验证码不能为空");e=0;
    }else{
        var code=$("#code").val();
        $.ajax({
            type:"POST",
            url:"index.php?admin=site&m=contact&a=contact",
            data:"code="+code,
            success:function(msg){
                if(msg==2){
                    alert("验证码错误");e=0
                }else{
                    e=1;
                }
            }

        })
    }
  })

  $("#myform").submit(function(){
    if(a+b+c+d+e!=5){
        return false;
    }
  })
  


})