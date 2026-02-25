 <script type="text/javascript">
 jQuery(document).ready(function(e) {

    $("#save").click(function(e) {
    	$("#formhighlight").submit();
    })

 // delete the entry once we have confirmed that it should be deleted
	var loader = $('#img-loader');
	var web_site_url = "<?php echo site_url(admin_module('preference/highlight'));?>";
    $('.delete').click(function() {
    	var parent = $(this).closest('tr');

		$('.confirm_delete').attr('id', $(this).attr('id'));
		$('.delete').unbind("click");
       
		$('.btn-danger').click(function(){
			var id = $(this).attr('id');
			var highlight_id_list = id.split('_');
			var highlight_id = highlight_id_list[1];
			$.ajax({
				type: 'POST',
				url: web_site_url+'/delete',
				data: {
					MM_action : 'delete',
					highlight_id : highlight_id
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
                <form action="<?php echo site_url(admin_module('preference/highlight/'.$action));?>" enctype="multipart/form-data" method="post" id="formhighlight" name="formhighlight">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>กำหนดชื่อ highlight</td>
                          <td><input type="text" name="name" value="<?php echo isset($rs_highlight['name'])? $rs_highlight['name']:'';?>" class="input-xlarge"></td>
                        </tr>
                        <tr>
                          <td>
                          <input name="type" value="link" id="sllink" type="radio" <?php echo ($rs_highlight['type'] == 'link')?'checked="checked"':'';?>>&nbsp;แบบใส่ลิ้งค์เอง</td>
                          <td><input onclick="document.getElementById('sllink').checked=true;" type="text" name="link" id="link" value="<?php echo isset($rs_highlight['url'])? $rs_highlight['url']:'';?>" class="input-xlarge"></td>
                        </tr>
                        <?php if(isset($rs_content)):?>
                        <tr>
                          <td><input id="slcontent" type="radio" value="content" name="type" <?php echo ($rs_highlight['type'] == 'content')?'checked="checked"':'';?>>&nbsp;แบบเลือก content</td>
                          <td><select onclick="document.getElementById('slcontent').checked=true;" name="content" id="content" class="input-xlarge">
                          <?php foreach ($rs_content as $rows):?>
                          <option value="<?php echo $rows['id'];?>" <?php if($rs_highlight['type']== 'content' && $rs_highlight['content']== $rows['id']){ echo 'selected="selected"';}?>><?php echo $rows['name'];?></option>
                          <?php endforeach;?>
                          </select></td>
                        </tr>
                        <?php endif;?>
                        <tr>
                          <td>ตำแหน่งการแสดงของเมนู</td>
                          <td>
                          <input type="radio" <?php echo ($rs_highlight['position'] =='left')? "checked":"";?> value="left" id="position" name="position">แสดงตำแหน่งซ้ายมือ&nbsp;&nbsp;&nbsp;
                          <input type="radio" <?php echo ($rs_highlight['position'] =='right')? "checked":"";?> value="right" id="position" name="position">แสดงตำแหน่งขวามือ&nbsp;&nbsp;&nbsp;
                          <input type="radio" <?php echo ($rs_highlight['position'] =='express')? "checked":"";?> value="express" id="position" name="position">แสดงตำแหน่งข่าวด่วน
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="slmain" class="input-xlarge" <?php echo ($rs_highlight['level'] == 'main')?'checked="checked"':'';?> value="main" name="level">&nbsp;กำหนดเป็นเมนูหลัก</td>
                            <td align="left">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td style="border-top:none;"><div name="imp" id="imp"><?php echo $rs_highlight['header'];?><input type="hidden" value="<?php echo $rs_highlight['header'];?>" name="imps"></div></td>
                                        <td style="border-top:none;"><input type="button" onclick="document.open('<?php echo site_url(admin_module('/upload/header'));?>','','width=750,height=500');document.getElementById('slmain').checked=true;" value="เลือก/เปลี่ยน รูป แสดงด้านบน"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>การใช้งานเมนู</td>
                            <td><input type="checkbox" value="1" <?php echo (isset($rs_highlight['status']) =='1')? "checked":"";?> id="status" name="status" class="input-xlarge"> &nbsp; เปิดใช้งาน / ไม่ใช้งาน</td>
                        </tr>
                        <tr>
                            <td>อันดับการแสดง</td>
                            <td><input type="text" size="1" value="<?php echo isset($rs_highlight['indexs'])? $rs_highlight['indexs'] : '';?>" id="index" name="index" class="input-xlarge" style="width:25px"> &nbsp; ** หมายเหตุ : สำหรับจัดอันดับก่อนหลัง</td>
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
                    <input type="hidden" name="highlight_id" id="highlight_id"  value="<?php if(isset($rs_highlight['id'])): echo $rs_highlight['id']; endif; ?>">
                    </form>
          </div>
         </div>
     </div>
 </div>
 <!-- end: PAGE CONTENT-->