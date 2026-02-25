 <script type="text/javascript">
$(document).ready(function() {

	$("#save").click(function(e) {
    	$("#formUsers").submit();
    })
    	$.validator.addMethod("passwdFormat",function(value,element) {
    		var re = /^[a-zA-Z0-9@]+$/;
    		if(re.test(value)) { return true; } else { return false; }
    	},"ไม่สามารถใช้ ภาษาไทย และคอมม่า");
    	$('#formUsers').validate({
    		rules:{
    			first_name:{
    				required: true
    			},
    			last_name:{
    				required: true
    			},
    			role:{
    				required: true
    			},
    			email:{
    				required: true,
    				email: true,
    				remote: {
    					url: "<?php echo site_url(admin_module('preference/check_email')); ?>",
    					type: "get",
    					data: {
    						email: function() {
    							return $("#email").val();
    						},
    						user_id: function(){
    							return $("#user_id").val();
    						}
    					}	
    				}
    			},
    			username:{
    				required: true,
    				remote: {
    					url: "<?php echo site_url(admin_module('preference/check_username')); ?>",
    					type: "get",
    					data: {
    						username: function() {
    							return $("#username").val();
    						},
    						user_id: function(){
    							return $("#user_id").val();
    						}
    					}	
    				}
    			},
    			password:{
    				required: true,
    				rangelength: [4,16],
    				passwdFormat: true
    			},
    			confirm_password:{
    				required: true,
    				equalTo: '#password'
    			}
    		},
    		messages:{
    			
    			first_name:{
    				required: "กรุณากรอก ชื่อ"
    			},
    			last_name:{
    				required: "กรุณากรอก นามสกุล"
    			},
    			role:{
    				required: "กรุณาเลือกหน่วยงาน"
    			},
    			email:{
    				required: "กรุณากรอก อีเมล์",
    				email: "อีเมล์ไม่ถูกต้อง",
    				remote: "ไม่สามารถใช้อีเมล์นี้ได้"
    			},
    			username:{
    				required: "กรุณากรอก ชื่อผู้ใช้ระบบ",
    				remote: "ไม่สามารถใช้ชื่อผู้ใช้ระบบนี้ได้"
    				
    			},
    			password:{
    				required: "กรุณากรอก รหัสผ่าน",
    				rangelength: "รหัสผ่านต้องมีความยาว 4-16 ตัวอักษร",
    				passwdFormat: "รหัสผ่านไม่สามารถใช้ภาษาไทยและคอมม่าได้"
    			},
    			confirm_password:{
    				required: "กรุณากรอก ยืนยันรหัสผ่าน",
    				equalTo: "ยืนยันรหัสผ่านไม่ถูกต้อง"
    			}
    		},submitHandler: function(form) {
    			form.submit();
            },onkeyup: false
    });

    	 // delete the entry once we have confirmed that it should be deleted
    	var loader = $('#img-loader');
    	var web_site_url = "<?php echo site_url(admin_module('preference/users'));?>";
        $('.delete').click(function() {
        	var parent = $(this).closest('tr');

    		$('.confirm_delete').attr('id', $(this).attr('id'));
    		$('.delete').unbind("click");
           
    		$('.btn-danger').click(function(){
    			var id = $(this).attr('id');
    			var user_id_list = id.split('_');
    			var user_id = user_id_list[1];
    			$.ajax({
    				type: 'POST',
    				url: web_site_url+'/delete',
    				data: {
    					MM_action : 'delete',
    					user_id : user_id
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
            <form action="<?php echo site_url(admin_module('preference/users/'.$action));?>" enctype="multipart/form-data" method="post" id="formUsers" name="formUsers">
                <table class="table">
                  <tbody>
                    <tr>
                        <td>ประเภทผู้ใช้</td>
                        <td><select name="role" class="input-xlarge">
                            <option value="">-: Role :-</option>
                            <option value="Administator" <?php echo (isset($rs_users['role']) =='Administator')? "selected":"";?>>Administator</option>
                            <option value="User"<?php echo (isset($rs_users['role']) =='User')? "selected":"";?>>User</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td>ชื่อ</td>
                      <td><input type="text" name="first_name" id="first_name" value="<?php echo isset($rs_users['first_name'])? $rs_users['first_name']:'';?>" class="input-xlarge"></td>
                    </tr>
                    <tr>
                      <td>นามสกุล</td>
                      <td><input type="text" name="last_name" id="last_name" value="<?php echo isset($rs_users['last_name'])? $rs_users['last_name']:'';?>" class="input-xlarge"></td>
                    </tr>
                    <tr>
                      <td>อีเมล์ </td>
                      <td><input type="text" name="email" id="email" value="<?php echo isset($rs_users['email'])? $rs_users['email']:'';?>" class="input-xlarge"></td>
                    </tr>
                    <?php if($action =='create'):?>
                    <tr>
                      <td>ผู้ใช้งาน</td>
                      <td><input type="text" name="username" id="username" class="input-xlarge"></td>
                    </tr>
                    <tr>
                      <td>รหัสผ่าน</td>
                      <td><input type="password" name="password" id="password" class="input-xlarge"></td>
                    </tr>
                    <tr>
                      <td>ยืนยันรหัสผ่าน</td>
                      <td><input type="password" name="confirm_password" id="confirm_password" class="input-xlarge"></td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <td>การใช้งานเมนู</td>
                        <td><input type="checkbox" value="Active" <?php echo (isset($rs_users['status']) =='Active')? "checked":"";?> id="status" name="status" class="input-xlarge"> &nbsp; เปิดใช้งาน / ไม่ใช้งาน</td>
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
                <input type="hidden" name="user_id" id="user_id"  value="<?php if(isset($rs_users['id'])): echo $rs_users['id']; endif; ?>">
                </form>
      </div>
</div>
 </div>
 </div>
 <!-- end: PAGE CONTENT-->