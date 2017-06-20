$(function(){
$(".nav ul li").eq(1).addClass("current");

$(".about_olbg ol li a").click(function(){
  var url = $(this).attr("href");
  var category=$(this).attr("name");
  $(".about_olbg ol li a").removeClass();
  $(this).addClass("on");
  $.ajax({
  	type:"GET",
    url:url,
    data:"category="+category, 
    dataType:"json",
    success:function(msg){
      var str='<img src="'+msg.image+'" />';
      var str1=msg.content;
      $(".about_img").html(str);
      $(".about_texts").html(str1);



    }
  })
  return false
})












})