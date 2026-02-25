 <script type="text/javascript">
$(document).ready(function(e) {

    $("#save").click(function(e) {
    	$("#formintro").submit();
    })

 // delete the entry once we have confirmed that it should be deleted
	var loader = $('#img-loader');
	var web_site_url = "<?php echo site_url(admin_module('preference/intro'));?>";
    $('.delete').click(function() {
    	var parent = $(this).closest('tr');

		$('.confirm_delete').attr('id', $(this).attr('id'));
		$('.delete').unbind("click");
       
		$('.btn-danger').click(function(){
			var id = $(this).attr('id');
			var intro_id_list = id.split('_');
			var intro_id = intro_id_list[1];
			$.ajax({
				type: 'POST',
				url: web_site_url+'/delete',
				data: {
					MM_action : 'delete',
					intro_id : intro_id
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
                <form action="<?php echo site_url(admin_module('preference/intro/'.$action));?>" enctype="multipart/form-data" method="post" id="formintro" name="formintro">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>กำหนดชื่อ intro</td>
                          <td><input type="text" name="title" value="<?php echo isset($rs_intro['title'])? $rs_intro['title']:'';?>" class="input-xlarge"></td>
                        </tr>
                        <tr>
                          <td> code สีพื้นหลัง</td>
                          <td><input type="text" name="color" id="color" value="<?php echo isset($rs_intro['color'])? $rs_intro['color']:'';?>" class="input-xlarge"> <span style="color: red">ตัวอย่าง : #411e5b</span></td>
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
                                        <td style="border-top:none;"><div name="imp" id="imp"><?php echo $rs_intro['image'];?><input type="hidden" value="<?php echo $rs_intro['image'];?>" name="imps"></div></td>
                                        <td style="border-top:none;"><input type="button" onclick="document.open('<?php echo site_url(admin_module('/upload/intro'));?>','','width=750,height=500');" value="เลือก/เปลี่ยน รูป แสดงด้านบน"></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2" style="border-top:none;">*** ขนาดไม่เกิน 400x190</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>ช่วงเวลาที่แสดง</td>
                            <td>
                                <table>
                                    <tr>
                                        <td>เริ่มต้น : </td>
                                        <td><span class="input-group datetimepicker" style="width: 200px">
                                        <input type="text" name="start_date" id="start_date" data-format="dd-MM-yyyy HH:mm:ss" class="form-control" value="<?php echo (isset($rs_intro['start_date']) && $rs_intro['start_date'] != '') ? date("d-m-Y H:i:s", strtotime($rs_intro['start_date'])) : ''; ?>">
                                                    <span class="input-group-addon add-on">
                                                      <i data-time-icon="clip-clock" data-date-icon="fa fa-calendar"></i>
                                                    </span>
                                    </span></td>
                                        <td> </td>
                                        <td>สิ้นสุด : </td>
                                        <td><span class="input-group datetimepicker" style="width: 200px">
                                                <input type="text" name="end_date" id="end_date" data-format="dd-MM-yyyy HH:mm:ss"  class="form-control" value="<?php echo (isset($rs_intro['end_date']) && $rs_intro['end_date'] != '') ? date("d-m-Y H:i:s", strtotime($rs_intro['end_date'])) : ''; ?>">
                                                    <span class="input-group-addon add-on">
                                                      <i data-time-icon="clip-clock" data-date-icon="fa fa-calendar"></i>
                                                    </span>
                                            </span></td>
                                    </tr>
                                </table>



                            </td>
                        </tr>
                        <tr>
                            <td>การใช้งานเมนู</td>
                            <td><input type="checkbox" value="1" <?php echo (isset($rs_intro['status']) =='1')? "checked":"";?> id="status" name="status" class="input-xlarge"> &nbsp; เปิดใช้งาน / ไม่ใช้งาน</td>
                        </tr>
                        <tr>
                            <td>อันดับการแสดง</td>
                            <td><input type="text" size="1" value="<?php echo isset($rs_intro['level'])? $rs_intro['level'] : '';?>" id="level" name="level" class="input-xlarge" style="width:25px"> &nbsp; ** หมายเหตุ : สำหรับจัดอันดับก่อนหลัง</td>
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
                    <input type="hidden" name="intro_id" id="intro_id"  value="<?php if(isset($rs_intro['id'])): echo $rs_intro['id']; endif; ?>">
                    </form>
          </div>
         </div>
     </div>
 </div>
 <!-- end: PAGE CONTENT-->