<script type="text/javascript">
jQuery(document).ready(function() {
	load_signin_js();
});

function load_signin_js(){
	var $j = jQuery.noConflict();
	$j('a[name="btn_login"]').click(function(){
		$j('#formLogin').submit();
		return false;
	});

	$j('#formLogin').submit(function(){
		$j('#login_error_msg').empty();

		if($j('input[name="username"]').val() == ''){
			$j('#login_error_msg').append('กรุณาใส่ชื่อผู้ใช้งาน');
		}else if($j('input[name="password"]').val() == ''){
			$j('#login_error_msg').append('กรุณาใส่รหัสผ่าน');
		}else if(($j('input[name="password"]').val().length < 4) || ($j('input[name="password"]').val().length > 16)){
			$j('#login_error_msg').append('รหัสผ่านต้องมีความยาว 4-16 ตัวอักษร');
		}else{
			var username = $j('input[name="username"]').val();
			var password = $j('input[name="password"]').val();
			var remember_password = $j('input[name="remember_password"]').val();

			var data_post = $j('#formLogin').serialize();

			$j.ajax({
				type: "POST",
				url: "<?php echo site_url('auth/login'); ?>",
				data: data_post,
				dataType: "jsonp",
				success: function(response){
					var obj = response;
					if(obj.status == 'success'){
						window.parent.location = "<?php echo site_url('call/new'); ?>";
						return true;
					}else{
						$j('#login_error_msg').append(obj.message);
						return false;
					}
				}
			});
		}
		return false;
	});
}
</script>
<div class="login_wrapper">
	<!--<a href="#" class="close"><img src="<?php echo site_assets_url('layouts/truecorp/images/btn_close.png'); ?>" alt="" /></a>-->
	<div class="title">เข้าสู่ระบบ</div>
    <form name="formLogin" id="formLogin" method="post" autocomplete="off">
    <div class="login_field">
        <input name="username" type="text" class="jq_watermark field" placeholder="ผู้ใช้งาน"/>
        <input name="password" type="password" class="jq_watermark field"placeholder="รหัสผ่าน"/>
    </div>
    <!-- <div class="rememberpass">
    	<input name="remember_password" type="checkbox" value="Y" />จำชื่อผู้ใช้
    </div>
	<div class="clear"></div>
    <div class="forgetpass">
    	<a href="<?php echo site_url('auth/forgot_password_v2'); ?>" target="_top"><strong>ลืมรหัสผ่าน</strong></a>
    </div>-->
	<div class="clear"></div>
    <a href="javascript:;" name="btn_login" class="btngreen button">เข้าสู่ระบบ</a>
    <a href="<?php echo $register_url; ?>" target="_top" class="btngrey2 button">สมัครสมาชิก</a>
    <!--<a href="" name="btn_cancel" class="btngrey button">ยกเลิก</a>-->
    <div id="login_error_msg" style="text-align:center; color:#F00; font-style:italic;"></div>
    <input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;" />
    </form>
</div>