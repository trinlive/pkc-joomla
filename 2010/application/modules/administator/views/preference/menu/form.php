<script type="text/javascript">
$(document).ready(function(e) {

    $("#save").click(function(e) {
    	$("#formmenu").submit();
    })

 // delete the entry once we have confirmed that it should be deleted
	var loader = $('#img-loader');
	var web_site_url = "<?php echo site_url(admin_module('preference/menu'));?>";
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
				url: web_site_url+'/delete',
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
});
 </script>
<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-sm-12">
        <div class="tabbable">
            <div id="myTabContent" class="tab-content">
                <form action="<?php echo site_url(admin_module('preference/menu/'.$action));?>" enctype="multipart/form-data" method="post" id="formmenu" name="formmenu">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>กำหนดชื่อ menu</td>
                          <td><input type="text" name="name" value="<?php echo isset($rs_menu['name'])? $rs_menu['name']:'';?>" class="input-xlarge"></td>
                        </tr>
                        <tr>
                          <td>
                          <input name="type" value="link" id="sllink" type="radio" <?php echo ($rs_menu['type'] == 'link')?'checked="checked"':'';?>>&nbsp;แบบใส่ลิ้งค์เอง</td>
                          <td><input onclick="document.getElementById('sllink').checked=true;" type="text" name="link" id="link" value="<?php echo isset($rs_menu['url'])? $rs_menu['url']:'';?>" class="input-xlarge"></td>
                        </tr>
                        <?php if(isset($rs_content)):?>
                        <tr>
                          <td><input id="slcontent" type="radio" value="content" name="type" <?php echo ($rs_menu['type'] == 'content')?'checked="checked"':'';?>>&nbsp;แบบเลือก content</td>
                          <td><select onclick="document.getElementById('slcontent').checked=true;" name="content" id="content" class="input-xlarge">
                          <?php foreach ($rs_content as $rows):?>
                          <option value="<?php echo $rows['id'];?>" <?php if($rs_menu['type']== 'content' && $rs_menu['content']== $rows['id']){ echo 'selected="selected"';}?>><?php echo $rows['name'];?></option>
                          <?php endforeach;?>
                          </select></td>
                        </tr>
                        <?php endif;?>
                        <tr>
                          <td>ตำแหน่งการแสดงของเมนู</td>
                          <td><select id="position" name="position" class="input-xlarge">
                                <option value="index" <?php echo ($rs_menu['position'] == 'index')?'selected="selected"':'';?>>แสดงในหน้าแรกเสมอ</option>
                                <option value="sub" <?php echo ($rs_menu['position'] == 'sub')?'selected="selected"':'';?>>แสดงในหน้าย่อย</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="slmain" class="input-xlarge" <?php echo ($rs_menu['level'] == 'main')?'checked="checked"':'';?> value="main" name="level">&nbsp;กำหนดเป็นเมนูหลัก</td>
                            <td align="left">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td style="border-top:none;"><div name="imp" id="imp"><?php echo $rs_menu['header'];?><input type="hidden" value="<?php echo $rs_menu['header'];?>" name="imps"></div></td>
                                        <td style="border-top:none;"><input type="button" onclick="document.open('<?php echo site_url(admin_module('/upload/header'));?>','','width=750,height=500');document.getElementById('slmain').checked=true;" value="เลือก/เปลี่ยน รูป แสดงด้านบน"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php if(isset($main_menu)):?>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<input class="input-xlarge" <?php echo ($rs_menu['level'] == 'sub')?'checked="checked"':'';?> type="radio" id="slsub" value="sub" name="level">&nbsp;กำหนดเป็นเมนูย่อย</td>
                            <td>เลือกเมนูหลัก
                            <select id="sub" name="sub" onclick="document.getElementById('slsub').checked=true;" class="input-xlarge">
                            <?php foreach ($main_menu as $rows):?>
                            <?php if($rs_menu['id']!=$rows['id']):?>
                                <option value="<?php echo $rows['id'];?>" <?php if($rs_menu['level']== 'sub' && $rs_menu['sub']== $rows['id']){ echo 'selected="selected"';}?>><?php echo $rows['name'];?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                            </select>
                            </td>
                        </tr>
                        <?php endif;?>
                        <?php if(isset($sub_menu)):?>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<input class="input-xlarge" type="radio" id="slsubs" value="link" <?php echo ($rs_menu['level'] == 'link')?'checked="checked"':'';?> name="level">&nbsp;กำหนดเป็นลิ้งค์</td>
                            <td>เลือกเมนูหลัก
                            <select id="subs" name="subs" onclick="document.getElementById('slsubs').checked=true;" class="input-xlarge">
                            <?php foreach ($sub_menu as $rows):?>
                            <?php if($rs_menu['id']!=$rows['id']):?>
                                <option value="<?php echo $rows['id'];?>" <?php if($rs_menu['level']== 'sub' && $rs_menu['sub']== $rows['id']){ echo 'selected="selected"';}?>><?php echo $rows['name'];?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                            </select>
                            </td>
                        </tr>
                        <?php endif;?>
                        <tr>
                            <td>การใช้งานเมนู</td>
                            <td><input type="checkbox" value="1" <?php echo (isset($rs_menu['status']) =='1')? "checked":"";?> id="status" name="status" class="input-xlarge"> &nbsp; เปิดใช้งาน / ไม่ใช้งาน</td>
                        </tr>
                        <tr>
                            <td>อันดับการแสดง</td>
                            <td><input type="text" size="1" value="<?php echo isset($rs_menu['indexs'])? $rs_menu['indexs'] : '';?>" id="index" name="index" class="input-xlarge" style="width:25px"> &nbsp; ** หมายเหตุ : สำหรับจัดอันดับก่อนหลังของ เมนู</td>
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
                    <input type="hidden" name="menu_id" id="menu_id"  value="<?php if(isset($rs_menu['id'])): echo $rs_menu['id']; endif; ?>">
                    </form>


          </div>

        </div>
    </div>
</div>
<!-- end: PAGE CONTENT-->