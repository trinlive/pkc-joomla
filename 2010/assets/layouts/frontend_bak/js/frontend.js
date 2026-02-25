$(document).ready(function() {
	var $j = jQuery.noConflict();
	$j('.bxslider').bxSlider({
		  mode: 'fade',
		  captions: true,
		  auto: true,
		  controls: false
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