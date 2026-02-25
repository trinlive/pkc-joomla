 $(document).ready(function(e) {
 // delete the entry once we have confirmed that it should be deleted
	$('.delete').click(function() {

    	$(this).closest('tr');
		$('.confirm_delete').attr('id', $(this).attr('id'));
		//$('.delete').unbind("click");
       
		$('.confirm_delete').click(function(){
			var id = $(this).attr('id');
			var promotion_gift_id_list = id.split('_');
			var promotion_gift_id = promotion_gift_id_list[1];
			$.ajax({
				type: 'POST',
				url: site_url_admin+'/promotion_gift/delete',
				data: {
                    promotion_gift_id : promotion_gift_id
                },
				beforeSend: function() {
					 
				},
				success: function(data) {
					window.location = site_url_admin+'/promotion_gift/lists';
				}
			});	 
			
		});
		
  
    });


    // 
 
    
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