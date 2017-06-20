$(function(){


   //给每一个分页的a绑定点击事件
    $(".pagination a").live("click",function(){ 

    /*针对1.9以下较低版本
      如果是1.9以上版本低于1.11用on
      如果版本太高，大于等于1.11  $("document").on("事件","目标元素"，函数)
    */
    	//先获取请求的url地址
    	var url = $(this).attr("href");
       $.ajax({
         url:url,
         dataType:"json", //声明php传递过来的数据是json格式，将json格式的字符串转化为数组或者对象
         success:function(msg){
          
             var page = msg.page;
             $(".pagination").html(page); //更改分页页码内容
             var str="";
             for(var i=0;i<msg.arr.length;i++){ //i表示arr数组的下标
                str+='<tr>';
                str+='<td>';
                str+='<input type="checkbox" />';
                str+='</td>';
                str+='<td>'+msg.arr[i].time+'</td>';
                str+='<td><a href="#" title="title">'+msg.arr[i].pro_name+'</a></td>';
                str+='<td><img src="'+msg.arr[i].image+'" style="height:100px;width:100px"/></td>';
                str+='<td>'+msg.arr[i].name+'</td>';
                str+='<td>';
                  
                  str+='<a href="index.php?admin=admin&m=product&a=update&id='+msg.arr[i].id+'&curpage='+msg.curpage+'" title="Edit">';
                  str+='<img src="resources/images/icons/pencil.png" alt="Edit" /></a> ';
                  str+='<a href="index.php?admin=admin&m=product&a=delete&id='+msg.arr[i].id+'&curpage='+msg.curpage+'" title="Delete">';
                  str+='<img src="resources/images/icons/cross.png" alt="Delete" /></a> ';
                  str+='<a href="#" title="Edit Meta">';
                  str+='<img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a> ';
                str+='</td>';
              str+='</tr>';
                /*str+="<tr>";
                str+="<td>";
                str+='  <input type="checkbox" />';
                str+='</td>';
                str+='<td>'+msg.arr[i].id+'</td>';
                str+='<td><a href="#" title="title">'+msg.arr[i].title+'</a></td>';
                str+='<td>'+msg.arr[i].time+'</td>';
                str+='<td>'+msg.arr[i].author+'</td>';
                str+='<td>';
                str+='  <a href="index.php?admin=admin&m=news&a=update&id='+msg.arr[i].id+'&curpage='+msg.curpage+'" title="Edit">';
                str+='  <img src="resources/images/icons/pencil.png" alt="Edit" /></a> ';
                str+='  <a href="index.php?admin=admin&m=news&a=delete&id='+msg.arr[i].id+'&curpage='+msg.curpage+'" title="Delete">';
                str+='  <img src="resources/images/icons/cross.png" alt="Delete" /></a> ';
                str+=' <a href="#" title="Edit Meta">';
                str+='  <img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a> ';
                str+='</td>';
                 str+=' </tr>';*/

             }
             $("tbody").html(str); //跟新新闻列表内容
         }


       })
 

       return false;
  })

})