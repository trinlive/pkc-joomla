// JavaScript Document
$(document).ready(function(){
// delete the entry once we have confirmed that it should be deleted
	var loader = $('#img-loader');
	var web_site_url = "http://localhost/pk/";
    $('.delete').click(function() {
    	var parent = $(this).closest('tr');

		$('.confirm_delete').attr('id', $(this).attr('id'));
		$('.delete').unbind("click");
       
		$('.btn-danger').click(function(){
			var id = $(this).attr('id');
			var menu_id_list = id.split('_');
			var menu_id = menu_id_list[1];
			$.ajax({
				type: 'POST',
				url: web_site_url+'/action',
				data: {
					MM_action : 'delete',
					menu_id : menu_id
                },
				beforeSend: function() {
					 loader.show();
				},
				success: function(data) {
					loader.hide();
					window.location = web_site_url;
				}
			});	 
			
		});
		
  
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