//点击全选
$(".select_all").click(function(){
    var status = $(this).is(":checked");  //获取当前复选框的状态
    // is(":checked") 判断是否被选中 如果选中返回true  未被选中返回false
   if(status){
   	  $(".level p input[type='checkbox']").attr("checked",true);
   }else{
   	   $(".level p input[type='checkbox']").attr("checked",false);
   }

})

//点击模块
$(".module").click(function(){
   var status =$(this).is(":checked");
   if(status){ 
   	  $(this).siblings().attr("checked",true); //设置当前的同辈被选中
   }else{
   	  $(this).siblings().attr("checked",false);//设置当前的同辈不被选中
   }
select_all()

})

//点击模块对应的方法
$(".action").click(function(){
	  var status = $(this).is(":checked");
	  if(status){
	  	  $(this).siblings(".module").attr("checked",true);
	  }else{
	  	    //代表当前的同级元素最多只有被选中（该选中的只可能是模块） 设置模块不被选中
	  	  if($(this).siblings("input:checked").length<=1){
             $(this).siblings(".module").attr("checked",false);
	  	  }
	  }

	select_all()
})

function select_all(){
	  var checked_num = $(".level input:checked").length; //获取复选框被选中的个数
	  if(checked_num ==$(".level input").length){
	  	  $(".select_all").attr("checked",true);
	  }else{
	  	   $(".select_all").attr("checked",false);
	  }
}