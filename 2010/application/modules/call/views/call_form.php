 <script type="text/javascript">
$(document).ready(function(e) {
	var $j = jQuery.noConflict();
	CKEDITOR.replace( 'detail',
	        {
	            customConfig : "<?php echo site_assets_url('layouts/frontend/plugins/ckeditor/config.js'); ?>"

	        });
	$j('#send').click(function(event){
		event.preventDefault();
		var is_valid = true; 
		if ($j('#recaptcha_response_field').val() == "")
		{
			$j('label.captcha_error').remove(); 
			
			$j('<label class="captcha_error" style="color:#F00;">กรุณากรอกรหัสทที่ท่านเห็น</label>').insertAfter($j('#recaptcha_widget_div')); 
		}
		
		$j('#formcall').submit(); 

	});

	$j('#recaptcha_response_field').keypress(function(){
		if ($j(this).val() != "")
		{
			$j('label.captcha_error').remove(); 
		}
		
	});
	$j('#formcall').validate({
		rules: {
			title: { 
				required: true
			}
			
		},
		messages: { 
			title: { 
				required: $j('#title').attr('title'),
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
 <?php //echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
 <div class="box_news_main_news">
     <div class="main_content_green_long"><?php echo 'สายตรงเทศบาล';?></div>
     <div class="clearfix"></div>
     <div class="detail" style="padding:10px">
			<div id="myTabContent" class="tab-content">
		    	<form action="<?php echo site_url('call/'.$action);?>" enctype="multipart/form-data" method="post" id="formcall" name="formcall">
					<table class="table">
				      <tbody>
				        <tr>
				          <td>คำถาม</td>
				          <td><input type="text" name="title" value="" title="กรุณากรอกคำถาม"class="input-xlarge"></td>
				        </tr>
				        <tr>
				          <td>รายละเอียด</td>
				          <td>
				          <textarea name="detail" id="detail" style="width: 650px; height: 350px;"></textarea>
				          </td>
				        </tr>
				        <tr>
				          <td>ชื่อผู้ถาม </td>
				          <td><?php echo $member['name'];?></td>
				        </tr>
				        <tr>
				        	<td>ภาพประกอบ(ถ้ามี)</td>
				        	<td><input type="file" name="image" id="image" style="width:100%"></td>
				        </tr>
				        <tr>
			                <td>กรุณาคลิกยืนยันตัวตน<span style="color:#F00; padding-left:5px;">*</span></td>
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
		  <div class="btn-toolbar">
			    <button class="btn btn-primary" id="send">ส่งคำถาม</button>
			  <div class="btn-group">
			  </div>
			</div>
			<div class="clear"></div>
			</div>
     <div class="clearfix"></div>
 </div>
 <script src='https://www.google.com/recaptcha/api.js?hl=th'></script>