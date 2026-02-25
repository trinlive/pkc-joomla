 $(document).ready(function(e) {
 // delete the entry once we have confirmed that it should be deleted
	$('.delete').click(function() {
    	$(this).closest('tr');
		$('.confirm_delete').attr('id', $(this).attr('id'));
		//$('.delete').unbind("click");
       
		$('.confirm_delete').click(function(){
			var id = $(this).attr('id');
			var menu_id_list = id.split('_');
			var menu_id = menu_id_list[1];
			$.ajax({
				type: 'POST',
				url: site_url_admin+'/menu/delete',
				data: {
					menu_id : menu_id
                },
				beforeSend: function() {
					 
				},
				success: function(data) {
					window.location = site_url_admin+'/menu/lists';
				}
			});	 
			
		});
		
  
    });
    // 
 
    
});
 
 function newtb_privilege(tbn) {
		var tableName = tbn;
		var tbs=document.getElementById(tableName); 
		var myNumRow = tbs.rows.length;
		var myNumCol = tbs.rows[0].cells.length; 
		tbs.insertRow(myNumRow);
		tbs.rows[myNumRow].insertCell();
		tbs.rows[myNumRow].cells[0].innerHTML= "<div class=\"form-group\" style=\"margin-left: 0px;\"><div class=\"col-sm-3\" style=\"padding-left: 0px;\"><input type=\"text\" placeholder=\"Action\" id=\"privilege_action\" class=\"form-control\" name=\"privilege_action[]\" ></div><div class=\"col-sm-6\" style=\"padding-left: 0px;\"><input type=\"text\" placeholder=\"Description\" id=\"privilege_description\" class=\"form-control\" name=\"privilege_description[]\" ></div><div class=\"col-sm-3\" style=\"padding-left: 0px;\"><select name=\"privilege_type[]\" id=\"privilege_type\" class=\"form-control\"><option value=\"N\">Default</option><option value=\"Y\">Sub</option></select></div>";
};;
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