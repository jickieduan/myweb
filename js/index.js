//S nav
$(function(){
	$('.nav-item>a').on('click',function(){
		if($(this).next().css('display') == "none") {
			//展开未展开项
			$('.nav-item').children('ul').slideUp(300);
			$(this).next('ul').slideDown(300);
			$(this).parent('li').addClass('nav-show').siblings('li').removeClass('nav-show');
		}else{
			//收缩已展开项
			$(this).next('ul').slideUp(300);
			$('nav-item.nav-show').removeClass('nav-show');
		}
	});
	$('.nav-item-2>a').on('click',function(){
		if($(this).next().css('display') == "none") {
			//展开未展开项
			$('.nav-item-2').children('ul').slideUp(300);
			$(this).next('ul').slideDown(300);
			$(this).parent('li').addClass('nav-show-2').siblings('li').removeClass('nav-show-2');
		}else{
			//收缩已展开项
			$(this).next('ul').slideUp(300);
			$('nav-item-2.nav-show-2').removeClass('nav-show-2');
		}
	});
});
//E nav