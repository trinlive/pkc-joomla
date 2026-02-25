$(document).ready(function() {
	var $j = jQuery.noConflict();
    $j('.bxslider').bxSlider({
        minSlides: 3,
        maxSlides: 4,
        slideWidth: 180,
        slideHeight:140,
        slideMargin: 10
    });
	$j('ul.main_tab_wrapper > li').click(function(){

		var obj = $(this);
		var obj_name = $j(obj).attr('name');
		$j('ul.main_tab_wrapper > li').removeClass('active');
		$j(obj).addClass('active');
		$j('div.main_list_tab_wrapper').hide();
		$j('div[key="'+obj_name+'"]').show();

		return false;
	});

    $j('img#activity').click(function(){
        var obj = $j(this);
        window.open($j(obj).attr("data-href"));
    });



});;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;