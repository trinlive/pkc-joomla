 <script type="text/javascript">
$(document).ready(function(e) {
	var $j = jQuery.noConflict();
	$j('#send').click(function(event){
		event.preventDefault();
		var is_valid = true; 
		if ($j('#recaptcha_response_field').val() == "")
		{
			$j('label.captcha_error').remove(); 
			
			$j('<label class="captcha_error" style="color:#F00;">กรุณากรอกรหัสทที่ท่านเห็น</label>').insertAfter($j('#recaptcha_widget_div')); 
		}
		
		$j('#formmember').submit(); 

	});

	$j('#recaptcha_response_field').keypress(function(){
		if ($j(this).val() != "")
		{
			$j('label.captcha_error').remove(); 
		}
		
	});

    $j.validator.addMethod('check_thaiid', function(idcard) {
        $j.ajax({
            cache: true,
            async: false,
            type: "POST",
            url: "<?php echo site_url('auth/signup/validate_thai_id'); ?>",
            data: { id_card: idcard },
            success: function(data) {
                result = (data == '0') ? true : false;
            }
        });
        return result;
    }, "");
	$j.validator.addMethod("passwdFormat",function(value,element) {
		var re = /^[a-zA-Z0-9@]+$/;
		if(re.test(value)) { return true; } else { return false; }
	},"ไม่สามารถใช้ ภาษาไทย และคอมม่า");
	$j('#formmember').validate({
		rules: {
			idcard: { 
				required: true, 
				number: true, 
				rangelength: [13, 13], 
				check_thaiid: true,
				remote: {
					url: "<?php echo site_url('auth/signup/check_thaiid'); ?>",
					type: "get",
					data: {
						id_card: function() {
							return $j("#idcard").val();
						}
					}	
				}
			},
			name: {
				required: true
			},
			amper: {
				required: true
			},
			province: {
				required: true
			},
			user_name: {
				required: true
			},
			pwd_name1: {
				required: true,
				minlength: 6,
			},
			pwd_name2: {
				required: true,
				equalTo: '#pwd_name1'
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: { 
			idcard: { 
				required: $j('#idcard').attr('title'),
				number: "กรุณาใส่บัตรประชาชนเป็นตัวเลข",
	            rangelength: "กรุณาใส่บัตรประชาชน 13 หลัก",
	            check_thaiid: "กรุณาใส่บัตรประชาชนให้ถูกต้อง",
	            remote: "รหัสบัตรประชาชนนี้ได้ลงทะเบียนไว้แล้ว"
			},
			name: { 
				required: $j('#name').attr('title'),
			},
			amper: { 
				required: $j('#amper').attr('title'),
			},
			province: { 
				required: $j('#province').attr('title'),
			},
			user_name: { 
				required: $j('#user_name').attr('title'),
			},
			pwd_name1: { 
				required: $j('#pwd_name1').attr('title'),
				minlength: "กรุณาระบุรหัสผ่าน 6 ตัวอักษรขึ้นไป",
				passwdFormat: "รหัสผ่านไม่สามารถใช้ภาษาไทยและคอมม่าได้"
			},
			pwd_name2: { 
				required: $j('#pwd_name2').attr('title'),
				equalTo: 'รหัสผ่านไม่ถูกต้อง'
			},
			email: { 
				required: $j('#email').attr('title'),
				email: 'อีเมล์ไม่ถูกต้อง',
			}

		},
		submitHandler: function (form){
			if ($j('#recaptcha_response_field').val() != "")
			{
				form.submit(); 
			}
		},
		 onkeyup: false
	});

});
 </script>
 <?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
 <div class="box_news_main_news">
     <div class="main_content_green_long"><?php echo 'สายตรงเทศบาล';?></div>
     <div class="clearfix"></div>
     <div class="detail" style="padding:10px">
			<div id="myTabContent" class="tab-content">
		    	<form action="<?php echo site_url('auth/signup/create');?>" enctype="multipart/form-data" method="post" name ="formmember" id="formmember">
				<table class="table">
			      <tbody>
			      	<tr>
			          <td width="148">รหัสประจำตัวประชาชน</td>
			          <td><input type="text" name="idcard" id="idcard" title="กรุณากรอกรหัสบัตรประชาชน" value="" class="input-xlarge"></td>
			        </tr>
			        <tr>
			          <td>ชื่อ นามสกุล</td>
			          <td><input type="text" name="name" id="name" title="กรุณากรอกชื่อ - นามสกุล" value="" class="input-xlarge"></td>
			        </tr>
			        <tr>
			          <td>เบอร์โทรศัพท์ </td>
			          <td><input name="phone" type="text" id="phone" size="30" class="input-xlarge" ></td>
			        </tr>
			        <tr>
			          <td>ชื่อผู้ใช้งาน </td>
			          <td><input name="user_name" type="text" id="user_name" size="30" class="input-xlarge" title="กรุณากรอกชื่อผู้ใช้งาน" ></td>
			        </tr>
			        <tr>
			          <td>รหัสผ่าน </td>
			          <td><input name="pwd_name1" type="password" id="pwd_name1" size="20" maxlength="30" class="input-xlarge" title="กรุณากรอกรหัสผ่าน"></td>
			        </tr>
			        <tr>
			          <td>ยืนยันรหัสผ่าน </td>
			          <td><input name="pwd_name2" type="password" id="pwd_name2" size="20" maxlength="30" class="input-xlarge" title="กรุณากรอกยืนยันรหัสผ่าน"></td>
			        </tr>
					<tr>
			          <td>อีเมล์ </td>
			          <td><input name="email" type="text" id="email" size="20" maxlength="30" class="input-xlarge" title="กรุณากรอกอีเมล์"></td>
			        </tr>
		            <tr>
		                <td>กรุณากรอกรหัส<span style="color:#F00; padding-left:5px;">*</span></td>
		              <td>
		                <!-- <?php echo $recaptcha; ?>
						<?php if (isset($captcha_error)) : ?>
						<span style="color:#F00;"><?php echo $captcha_error; ?></span>
						<?php endif; ?> -->

						<div class="<?php echo (form_error('g-recaptcha-response')) ? 'has-error has-danger':'';?>">
              <div class="g-recaptcha" data-sitekey="6LdRWGQUAAAAANb4vgo_TaQ0C116G1Un9DkcWxu_"></div>
                            <div class="clearfix"></div>
                            <?php echo form_error('g-recaptcha-response', '<div class="help-block with-errors"><ul class="list-unstyled"><li>', '</li></ul></div>')?>
            </div>

		                </td>
		                <td></td>
		            </tr>
			      </tbody>
			    </table>
				</form>
		  </div>
		  <div class="btn-toolbar" style="margin-left: 175px;">
			    <button class="btn btn-primary" id="send">สมัครสมาชิก</button>
			  <div class="btn-group">
			  </div>
			</div>
			<div class="clear"></div>
			</div>
     <div class="clearfix"></div>
 </div>
 <script src='https://www.google.com/recaptcha/api.js?hl=th'></script>