
      $(".cate select").live("change",function(){
        
          $(this).nextAll().remove(); //将后面的所有同辈元素删除
          var id =$(this).val(); //获取当前select的id
          if(id==-1){ //代表用户点击的是上一级
             var previd = $(this).prev().val(); //获取前面一个select对应的id的值
             if(previd){
               $(".pid").val(previd);
             }else{ //如果previd值为空，则代表当前分类修改顶级分类
                $(".pid").val(0);
             }


          }else{
          $.ajax({
             type:"GET",
             url:"index.php?admin=admin&m=login&a=getnext",
             data:"id="+id,
             dataType:"json",
             success:function(msg){
               if(msg.length>0){
                var str="<select>";
                str+="<option value='-1'>上一级</option>";
                for(var i=0;i<msg.length;i++){
                   str+="<option value='"+msg[i].id+"'>"+msg[i].name+"</option>"
                }
                str+="</select>";
                $(".cate").append(str);
              
              }

                $(".pid").val(id); //设置当前分类的pid值
             }

          })
        }

      })

