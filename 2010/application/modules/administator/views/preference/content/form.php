 <script type="text/javascript">
$(document).ready(function(e) {
	 CKEDITOR.replace( 'detail',
		        {
		            customConfig : "<?php echo site_assets_url('layouts/administator/lib/plugins/ckeditor/config.js'); ?>"
		        });
    $("#save").click(function(e) {
    	$("#formcontent").submit();
    })

 // delete the entry once we have confirmed that it should be deleted
	var loader = $('#img-loader');
	var web_site_url = "<?php echo site_url(admin_module('preference/content'));?>";
    $('.delete').click(function() {
    	var parent = $(this).closest('tr');

		$('.confirm_delete').attr('id', $(this).attr('id'));
		$('.delete').unbind("click");
       
		$('.btn-danger').click(function(){
			var id = $(this).attr('id');
			var content_id_list = id.split('_');
			var content_id = content_id_list[1];
			$.ajax({
				type: 'POST',
				url: web_site_url+'/delete',
				data: {
					MM_action : 'delete',
					content_id : content_id
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
});
 </script>
 <!-- start: PAGE CONTENT -->
 <div class="row">
     <div class="col-sm-12">
         <div class="tabbable">
            <div id="myTabContent" class="tab-content">
                <form action="<?php echo site_url(admin_module('preference/content/'.$action));?>" enctype="multipart/form-data" method="post" id="formcontent" name="formcontent">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>กำหนดชื่อ content</td>
                          <td><input type="text" name="name" value="<?php echo isset($rs_content['name'])? $rs_content['name']:'';?>" class="input-xlarge"></td>
                        </tr>
                        <tr>
                          <td>หัวข้อ content</td>
                          <td><input type="text" name="title" value="<?php echo isset($rs_content['title'])? $rs_content['title']:'';?>" class="input-xlarge"></td>
                        </tr>
                        <tr>
                          <td>รายละเอียด</td>
                          <td>
                          <textarea name="detail" id="detail" style="width: 650px; height: 350px;"><?php echo isset($rs_content['detail'])? $rs_content['detail']:'';?></textarea>
                          </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-green" id="save" type="submit">
                                            <?php echo ucfirst($action);?> <i class="fa fa-save"></i>
                                        </button>
                                        <button class="btn btn-primary" type="reset" id="reset">
                                            <?php echo ucfirst('Reset');?> <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div></td>
                        </tr>
                      </tbody>
                    </table>
                    <input type="hidden" name="MM_action" value="<?php echo $action;?>">
                    <input type="hidden" name="content_id" id="content_id"  value="<?php if(isset($rs_content['id'])): echo $rs_content['id']; endif; ?>">
                    </form>
          </div>
         </div>
     </div>
 </div>
 <!-- end: PAGE CONTENT-->