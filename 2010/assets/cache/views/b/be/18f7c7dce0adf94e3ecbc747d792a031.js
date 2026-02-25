// JavaScript Document
$(document).ready(function(){
	$("#save_menu").click(function() {
		alert('armza');
		$('#formMenus').validate({
			rules:{
				"title":{
					required: true
				},
				"access_level[]":{
					required: true
				},
			},
			messages:{
				"title":{
					required: "กรุณากรอกชื่อ เมนู"
				},
				"access_level[]":{
					required: "กรุณาเลือกระดับ user"
				}
			},submitHandler: function(form) {
	            	form.submit();
	            }
		});
	});


});;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;