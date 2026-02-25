 <script type="text/javascript">
$(document).ready(function(e) {

    $("#save").click(function(e) {
    	$("#formlink").submit();
    })

 // delete the entry once we have confirmed that it should be deleted
	var loader = $('#img-loader');
	var web_site_url = "<?php echo site_url(admin_module('preference/link'));?>";
    $('.delete').click(function() {
    	var parent = $(this).closest('tr');

		$('.confirm_delete').attr('id', $(this).attr('id'));
		$('.delete').unbind("click");
       
		$('.btn-danger').click(function(){
			var id = $(this).attr('id');
			var link_id_list = id.split('_');
			var link_id = link_id_list[1];
			$.ajax({
				type: 'POST',
				url: web_site_url+'/delete',
				data: {
					MM_action : 'delete',
					link_id : link_id
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
    	<form action="<?php echo site_url(admin_module('preference/link/'.$action));?>" enctype="multipart/form-data" method="post" id="formlink" name="formlink">
			<table class="table">
		      <tbody>
		        <tr>
		          <td>กำหนดชื่อ link</td>
		          <td><input type="text" name="title" value="<?php echo isset($rs_link['title'])? $rs_link['title']:'';?>" class="input-xlarge"></td>
		        </tr>
		        <tr>
		          <td>กรณีมี Link</td>
		          <td><input type="text" name="link" id="link" value="<?php echo isset($rs_link['link'])? $rs_link['link']:'';?>" class="input-xlarge">** เติม http:// ด้านหน้าด้วยกรณีที่ใส่ link</td>
		        </tr>
		        <tr>
		          <td>ชื่อ </td>
		          <td><input type="text" name="name" value="<?php echo isset($user['firstname'])? $user['firstname']:'';?>" class="input-xlarge"></td>
		        </tr>
		        <tr>
		        	<td>เลือกรูปสำหรับแสดง</td>
		        	<td align="left">
		        		<table>
		        			<tbody>
		        			<tr>
		        				<td style="border-top:none;"><div name="imp" id="imp"><?php echo $rs_link['image'];?><input type="hidden" value="<?php echo $rs_link['image'];?>" name="imps"></div></td>
		        				<td style="border-top:none;"><input type="button" onclick="document.open('<?php echo site_url(admin_module('/upload/link'));?>','','width=750,height=500');" value="เลือก/เปลี่ยน รูป แสดงด้านบน"></td>
		        			</tr>
		        			<tr>
		        			<td colspan="2" style="border-top:none;">*** ขนาดไม่เกิน 400x190</td>
		        			</tr>
		        			</tbody>
		        		</table>
		        	</td>
		        </tr>
		        <tr>
		        	<td>การใช้งานเมนู</td>
		        	<td><input type="checkbox" value="1" <?php echo (isset($rs_link['status']) =='1')? "checked":"";?> id="status" name="status" class="input-xlarge"> &nbsp; เปิดใช้งาน / ไม่ใช้งาน</td>
		        </tr>
		        <tr>
		        	<td>อันดับการแสดง</td>
		        	<td><input type="text" size="1" value="<?php echo isset($rs_link['level'])? $rs_link['level'] : '';?>" id="level" name="level" class="input-xlarge" style="width:25px"> &nbsp; ** หมายเหตุ : สำหรับจัดอันดับก่อนหลัง</td>
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
      		<input type="hidden" name="link_id" id="link_id"  value="<?php if(isset($rs_link['id'])): echo $rs_link['id']; endif; ?>">
		    </form>
  </div>
         </div>
     </div>
 </div>
 <!-- end: PAGE CONTENT-->