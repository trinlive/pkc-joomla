 $(document).ready(function(e) {
 // delete the entry once we have confirmed that it should be deleted
	$('.delete').click(function() {

    	$(this).closest('tr');
		$('.confirm_delete').attr('id', $(this).attr('id'));
		//$('.delete').unbind("click");
       
		$('.confirm_delete').click(function(){
			var id = $(this).attr('id');
			var promotion_id_list = id.split('_');
			var promotion_id = promotion_id_list[1];
			$.ajax({
				type: 'POST',
				url: site_url_admin+'/promotion/delete',
				data: {
                    promotion_id : promotion_id
                },
				beforeSend: function() {
					 
				},
				success: function(data) {
					window.location = site_url_admin+'/promotion/lists';
				}
			});	 
			
		});
		
  
    });

     $('.type_delete').click(function() {
         $(this).closest('tr');
         $('.confirm_delete').attr('id', $(this).attr('id'));
         //$('.delete').unbind("click");

         $('.confirm_delete').click(function(){
             var id = $(this).attr('id');
             var promotion_id_list = id.split('_');
             var promotion_id = promotion_id_list[2];
             var promotion_type_id = promotion_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/promotion/type',
                 data: {
                     promotion_id : promotion_id,
                     promotion_type_id : promotion_type_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/promotion/type/'+promotion_id;
                 }
             });

         });


     });

     $('.priceplan_delete').click(function() {
         $(this).closest('tr');
         $('.confirm_delete').attr('id', $(this).attr('id'));
         //$('.delete').unbind("click");

         $('.confirm_delete').click(function(){
             var id = $(this).attr('id');
             var promotion_id_list = id.split('_');
             var promotion_id = promotion_id_list[2];
             var promotion_price_plan_id = promotion_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/promotion/priceplan',
                 data: {
                     promotion_id : promotion_id,
                     promotion_price_plan_id : promotion_price_plan_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/promotion/priceplan/'+promotion_id;
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
             var promotion_id_list = id.split('_');
             var promotion_id = promotion_id_list[2];
             var promotion_package_id = promotion_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/promotion/package',
                 data: {
                     promotion_id : promotion_id,
                     promotion_package_id : promotion_package_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/promotion/package/'+promotion_id;
                 }
             });

         });


     });

     $('.number_delete').click(function() {
         $(this).closest('tr');
         $('.confirm_delete').attr('id', $(this).attr('id'));
         //$('.delete').unbind("click");

         $('.confirm_delete').click(function(){
             var id = $(this).attr('id');
             var promotion_id_list = id.split('_');
             var promotion_id = promotion_id_list[2];
             var promotion_number_id = promotion_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/promotion/number',
                 data: {
                     promotion_id : promotion_id,
                     promotion_number_id : promotion_number_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/promotion/number/'+promotion_id;
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