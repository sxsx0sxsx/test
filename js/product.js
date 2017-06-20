$(document).ready(function(){
	$(".nav ul li").eq(3).addClass("current");

 $(".about_olbg ol li a").click(function(){//显示不同类的产品
        $(".about_olbg ol li a").removeClass();
        $(this).addClass("on");
        var category=$(this).attr("name");
        var lei=$(this).html();
        var url = $(this).attr("href");        
        $.ajax({
            type:"POST",
            url:url,
            data:"category="+category,
            dataType:"json", //声明php传递过来的数据是json格式，将json格式的字符串转化为数组或者对象
            success:function(msg){
                var page = msg.page;
             $(".page").html(page); //更改分页页码内容
             var str="";

             for(var i=0;i<msg.arr.length;i++){ //i表示arr数组的下标
             
                str+='<li>';
               str+='<a href="index.php?admin=site&m=product&a=pro_details&id='+msg.arr[i].id+'" >';
                str+='<img src="'+msg.arr[i].image+'" >';
                str+='</a>';
                str+='<a class="pro_list" href="index.php?admin=site&m=product&a=pro_details&id='+msg.arr[i].id+'">'+msg.arr[i].pro_name+'</a>';
                str+='</li>';

             }
            
             $("#img").html(str); //跟新产品列表内容
             
             $("li.on a").html(lei);
            }
            
        })

        return false;
    })


$(".page ul li a").live("click",function(){
	
	var url = $(this).attr("href");
    $.ajax({
         url:url,
         dataType:"json", //声明php传递过来的数据是json格式，将json格式的字符串转化为数组或者对象
         success:function(msg){
         	var page = msg.page;
             $(".page").html(page); //更改分页页码内容
             var str="";
             for(var i=0;i<msg.arr.length;i++){ //i表示arr数组的下标
                str+='<li>';
			   str+='<a href="index.php?admin=site&m=product&a=pro_details&id='+msg.arr[i].id+'" >';
			    str+='<img src="'+msg.arr[i].image+'" >';
			    str+='</a>';
			    str+='<a class="pro_list" href="index.php?admin=site&m=product&a=pro_details&id='+msg.arr[i].id+'">'+msg.arr[i].pro_name+'</a>';
			    str+='</li>';

             }
             
             $("#img").html(str); //跟新产品列表内容
         }

         
     })
   return false;

})

})