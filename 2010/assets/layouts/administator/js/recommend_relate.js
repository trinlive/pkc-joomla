 $(document).ready(function(e) {
 // delete the entry once we have confirmed that it should be deleted
	$('.delete').click(function() {
    	$(this).closest('tr');
		$('.confirm_delete').attr('id', $(this).attr('id'));
		//$('.delete').unbind("click");
       
		$('.confirm_delete').click(function(){
			var id = $(this).attr('id');
			var recommend_relate_id_list = id.split('_');
			var recommend_relate_id = recommend_relate_id_list[1];
			$.ajax({
				type: 'POST',
				url: site_url_admin+'/recommend_relate/delete',
				data: {
                    recommend_relate_id : recommend_relate_id
                },
				beforeSend: function() {
					 
				},
				success: function(data) {
					window.location = site_url_admin+'/recommend_relate/lists';
				}
			});	 
			
		});
		
  
    });

     $('.package_delete').click(function() {
         $(this).closest('tr');
         $('.confirm_delete').attr('id', $(this).attr('id'));
         //$('.delete').unbind("click");

         $('.confirm_delete').click(function(){
             var id = $(this).attr('id');
             var recommend_relate_id_list = id.split('_');
             var recommend_relate_id = recommend_relate_id_list[2];
             var recommend_relate_package_id = recommend_relate_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/recommend_relate/package',
                 data: {
                     recommend_relate_id : recommend_relate_id,
                     recommend_relate_package_id : recommend_relate_package_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/recommend_relate/package/'+recommend_relate_id;
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