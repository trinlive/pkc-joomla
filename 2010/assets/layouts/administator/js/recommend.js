 $(document).ready(function(e) {

 // delete the entry once we have confirmed that it should be deleted
	$('.delete').click(function() {

    	$(this).closest('tr');
		$('.confirm_delete').attr('id', $(this).attr('id'));
		//$('.delete').unbind("click");
       
		$('.confirm_delete').click(function(){
			var id = $(this).attr('id');
			var recommend_id_list = id.split('_');
			var recommend_id = recommend_id_list[1];
			$.ajax({
				type: 'POST',
				url: site_url_admin+'/recommend/delete',
				data: {
                    recommend_id : recommend_id
                },
				beforeSend: function() {
					 
				},
				success: function(data) {
					window.location = site_url_admin+'/recommend/lists';
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
             var recommend_id_list = id.split('_');
             var recommend_id = recommend_id_list[2];
             var recommend_type_id = recommend_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/recommend/type',
                 data: {
                     recommend_id : recommend_id,
                     recommend_type_id : recommend_type_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/recommend/type/'+recommend_id;
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
             var recommend_id_list = id.split('_');
             var recommend_id = recommend_id_list[2];
             var recommend_price_plan_id = recommend_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/recommend/priceplan',
                 data: {
                     recommend_id : recommend_id,
                     recommend_price_plan_id : recommend_price_plan_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/recommend/priceplan/'+recommend_id;
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
             var recommend_id_list = id.split('_');
             var recommend_id = recommend_id_list[2];
             var recommend_package_id = recommend_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/recommend/package',
                 data: {
                     recommend_id : recommend_id,
                     recommend_package_id : recommend_package_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/recommend/package/'+recommend_id;
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
             var recommend_id_list = id.split('_');
             var recommend_id = recommend_id_list[2];
             var recommend_number_id = recommend_id_list[3];
             $.ajax({
                 type: 'POST',
                 url: site_url_admin+'/recommend/number',
                 data: {
                     recommend_id : recommend_id,
                     recommend_number_id : recommend_number_id
                 },
                 beforeSend: function() {

                 },
                 success: function(data) {
                     window.location = site_url_admin+'/recommend/number/'+recommend_id;
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