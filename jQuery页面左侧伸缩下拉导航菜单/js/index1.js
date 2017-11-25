$(function(){
	$('.nav-item>a').on('click',function(){
		if(!$('.nav').hasClass('nav-mini')){
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
		}
	});
	//nav-mini切换
    $('#mini').on('click',function(){
        if (!$('.nav').hasClass('nav-mini')) {
            $('.nav-item.nav-show').removeClass('nav-show');
            $('.nav-item').children('ul').removeAttr('style');
            $('.nav').addClass('nav-mini');
        }else{
            $('.nav').removeClass('nav-mini');
        }
    });

});