$(document).ready(function(){
	$(".nav ul li").eq(2).addClass("current");


$(".nuber ul li a").live("click",function(){	
	var url = $(this).attr("href");
    $.ajax({
         url:url,
         dataType:"json", //声明php传递过来的数据是json格式，将json格式的字符串转化为数组或者对象
         success:function(msg){
         	var page = msg.page;
             $(".nuber").html(page); //更改分页页码内容
             var str="";
             for(var i=0;i<msg.arr.length;i++){ //i表示arr数组的下标
             	str+='<li>'
			    str+='<a href="index.php?admin=site&m=news&a=news_details&id='+msg.arr[i].id+'" class="news_list_pic"><img src="'+msg.arr[i].image+'"></a>'
			    str+='<div>'
			    str+='<h2>'+msg.arr[i].time+'</h2>'
				str+='<h3><a href="index.php?admin=site&m=news&a=news_details&id='+msg.arr[i].id+'">'+msg.arr[i].title+'</a></h3>'
	            str+='<p>'+msg.arr[i].content+'</p>'
	            str+='<a href="index.php?admin=site&m=news&a=news_details&id='+msg.arr[i].id+'" class="check">查看详情</a>'
			    str+='</div>'
			    str+='</li>'
               
             }
             
             $(".content_bgtext ol").html(str); //跟新产品列表内容
         }

         
     })
   return false;

})

$(".about_olbg ol li a").click(function(){//显示不同类的产品
        $(".about_olbg ol li a").removeClass();
        $(this).addClass("on");
        var category=$(this).attr("name");
        var url = $(this).attr("href");        
        $.ajax({
            type:"POST",
            url:url,
            data:"category="+category,
            dataType:"json", //声明php传递过来的数据是json格式，将json格式的字符串转化为数组或者对象
            success:function(msg){
                var page = msg.page;
             $(".nuber").html(page); //更改分页页码内容
             var str="";

             for(var i=0;i<msg.arr.length;i++){ //i表示arr数组的下标            
                str+='<li>'
			    str+='<a href="index.php?admin=site&m=news&a=news_details&id='+msg.arr[i].id+'" class="news_list_pic"><img src="'+msg.arr[i].image+'"></a>'
			    str+='<div>'
			    str+='<h2>'+msg.arr[i].time+'</h2>'
				str+='<h3><a href="index.php?admin=site&m=news&a=news_details&id='+msg.arr[i].id+'">'+msg.arr[i].title+'</a></h3>'
	            str+='<p>'+msg.arr[i].content+'</p>'
	            str+='<a href="index.php?admin=site&m=news&a=news_details&id='+msg.arr[i].id+'" class="check">查看详情</a>'
			    str+='</div>'
			    str+='</li>'
             }
            
             $(".content_bgtext ol").html(str); //跟新产品列表内容
            }
            
        })

        return false;
    })


})