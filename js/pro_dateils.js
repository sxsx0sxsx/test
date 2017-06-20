$(function(){
	$('.probg ul li').mouseover(function(){
		$('.probg ul li').removeAttr('class');
		$(this).attr('class','on')
		var i = $(this).index();
		$('.probg ol li').removeAttr('class');
		$('.probg ol li').eq(i).attr('class','pro_on')
	})
	var i = 0;
	$('.next').click(function(){
		if(i>=$('.probg ul li').length-1){
			i=0;
		}else{
			i++
		}
		$('.probg ul li').removeAttr('class');
		$('.probg ul li').eq(i).attr('class','on')
		$('.probg ol li').removeAttr('class');
		$('.probg ol li').eq(i).attr('class','pro_on')
	})
	$('.prev').click(function(){
		if(i<=0){
			i=$('.probg ul li').length-1;
		}else{
			i--
		}
		$('.probg ul li').removeAttr('class');
		$('.probg ul li').eq(i).attr('class','on')
		$('.probg ol li').removeAttr('class');
		$('.probg ol li').eq(i).attr('class','pro_on')
	})
	var time = setInterval(turn,3000);
	function turn(){
		if(i>=$('.probg ul li').length-1){
			i=0;
		}else{
			i++
		}
		$('.probg ul li').removeAttr('class');
		$('.probg ul li').eq(i).attr('class','on')
		$('.probg ol li').removeAttr('class');
		$('.probg ol li').eq(i).attr('class','pro_on')
	}
	$('.probg').mouseover(function(){
		clearInterval(time);
	})
	$('.probg').mouseout(function(){
		time = setInterval(turn,3000);
	})
})