$(function(){ 
	var img =$('.banner ul li');
	var i = 0;
	var Button =$('.banner ol li');
	var time = setInterval(turn,1000);
  
//1.点击轮播点，切换图片
  $('.banner ol li' ).mouseover(function(){
  	   $('.banner ol li' ).removeAttr('class');
   	   $(this).attr('class','on');
   	   var i =$(this).index();
   	   img.removeAttr('class')
   	   img.eq(i).attr('class','banner_on')
   })
  
//2.自动轮播
   function turn(){
   	   if(i>=img.length-1){
   	   	   i=0;
   	   }else{
   	   	   i++;
   	   }
   	   Button.removeAttr('class');
   	   Button.eq(i).attr('class','on');
   	   
   	   img.removeAttr('class');
   	   img.eq(i).attr('class','banner_on')
   	
   }
   
})

