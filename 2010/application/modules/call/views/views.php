<script type="text/javascript" src="<?php echo site_url('assets/js/libs/jquery.print.js')?>"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();
		$j(
			function(){

				// Hook up the print link.
				$j( "a#print" )
					.attr( "href", "javascript:void( 0 )" )
					.click(
						function(){
							// Print the DIV.
							$j( ".detail_print" ).print();

							// Cancel click event.
							return( false );
						}
						)
				;

			}
			);

	</script>
	<style>
	.detail_print, .detail_print td
	{
	font-family:sans-serif;
	font-size:16pt;
	}
	</style>

<?php //echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="box_news_main_news">
    <div class="main_content_green_long"><?php echo 'ดาวน์โหลด';?></div>
    <div class="clearfix"></div>


			<div class="detail" style="padding:10px">
			<div class="content_tab">
				<ul class="main_tab_wrapper">
					<li style="cursor:pointer;" class="active">
					<a href="javascript:;">
					<div style="position: relative; left: -15px; width: 31px; float: left;">
					<img width="30px" src="<?php echo site_assets_url('layouts/frontend/images/call-group2.png');?>"></div>
					<div style="float: left; position: relative; top: 0px;"><strong>คำถาม</strong></div>
					</a>
					</li>
					<li style="cursor:pointer;">
					<a id="print">
					<div style="position: relative; left: -15px; width: 31px; float: left;">
					<img width="30px" src="<?php echo site_assets_url('layouts/frontend/images/print.png');?>"></div>
					<div style="float: left; position: relative; top: 0px;"><strong>พิมพ์คำถามนี้</strong></div>
					</a>
					</li>
			        <div class="clear"></div>
				</ul>
			</div>
			<table class="table">
		      <tbody>
		        <tr>
		          <td><strong>หัวข้อคำถาม</strong></td>
		          <td><?php echo isset($rs_call['title'])? $rs_call['title']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>รายละเอียดคำถาม</strong></td>
		          <td><?php echo isset($rs_call['detail'])? $rs_call['detail']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>ถามโดย</strong></td>
		          <td><?php echo isset($rs_call['name'])? $rs_call['name']:'';?></td>
		        </tr>
		        <tr>
		        	<td><strong>ถามเมื่อวันที่</strong></td>
		        	<td><?php echo isset($rs_call['datepost'])? format_date1($rs_call['datepost']):'';?></td>
		        </tr>
		        <?php if($rs_call['file'] !=''):?>
				<tr>
		          <td><strong>ภาพประกอบ</strong> </td>
		          <td><a href="<?php echo site_assets_url('uploads/img_call/'.$rs_call['file'])?>" target="_blank"><img src="<?php echo site_assets_url('uploads/img_call/'.$rs_call['file']);?>" width="400"></a></td>
		        </tr>
		        <?php endif;?>
		      </tbody>
		    </table>
		    <?php if(isset($rs_call_reply)):?>
		        <?php foreach ($rs_call_reply as $key=>$rows):$key++;?>
		        <div class="content_tab">
				<ul class="main_tab_wrapper">
					<li style="cursor:pointer;">
					<a href="javascript:;">
					<div style="position: relative; left: -15px; width: 31px; float: left;">
					<img width="30px" src="<?php echo site_assets_url('layouts/frontend/images/call-group2.png');?>"></div>
					<div style="float: left; position: relative; top: 0px;"><strong>คำตอบ</strong></div>
					</a>
					</li>
			        <div class="clear"></div>
				</ul>
			</div>
			<table class="table">
		      <tbody>
		        <tr>
		          <td><strong>รายละเอียดคำตอบ</strong></td>
		          <td><?php echo isset($rows['detail'])? $rows['detail']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>ผู้ตอบ</strong></td>
		          <td><?php echo isset($rows['name'])? $rows['name']:'';?></td>
		        </tr>
		        <tr>
		        	<td><strong>วันที่ตอบ</strong></td>
		        	<td><?php echo isset($rows['datepost'])? format_date1($rows['datepost']):'';?></td>
		        </tr>
		        <?php if($rows['file'] !=''):?>
				<tr>
		          <td><strong>สิ่งที่แนบคำตอบ</strong> </td>
		          <td><a href="<?php echo site_assets_url('images/call/reply/'.$rows['file'])?>"><?php echo $rows['file'];?></a></td>
		        </tr>
		        <?php endif;?>
		      </tbody>
		    </table>
		    <?php endforeach;?>
		        <?php endif;?>
			<div class="clear"></div>
			</div>
			<div class="detail_print" style="display:none;">
			<table class="table" border="1" cellspacing="0" cellpadding="7" width="100%">
		      <tbody>
			  <tr>
		          <td colspan="2" align="left" valign="center">
					<img width="60px"src="<?php echo site_url('image/logo.jpg');?>"> 
					<div style="font-size:16px;text-align:center;top: -38px;position: relative;left: -116px;"><strong>สายตรงเทศบาล</strong></div>
				  </td>
		        </tr>
			  <tr>
		          <td><strong>รหัสคำถาม</strong></td>
		          <td><?php echo isset($rs_call['id'])? '00'.$rs_call['id']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>หัวข้อคำถาม</strong></td>
		          <td><?php echo isset($rs_call['title'])? $rs_call['title']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>รายละเอียดคำถาม</strong></td>
		          <td><?php echo isset($rs_call['detail'])? $rs_call['detail']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>ถามโดย</strong></td>
		          <td><?php echo isset($rs_call['name'])? $rs_call['name']:'';?></td>
		        </tr>
		        <tr>
		        	<td><strong>ถามเมื่อวันที่</strong></td>
		        	<td><?php echo isset($rs_call['datepost'])? format_date1($rs_call['datepost']):'';?></td>
		        </tr>
		        <?php if($rs_call['file'] !=''):?>
				<tr>
		          <td><strong>ภาพประกอบ</strong> </td>
		          <td><a href="<?php echo site_assets_url('uploads/img_call/'.$rs_call['file'])?>" target="_blank"><img src="<?php echo site_assets_url('uploads/img_call/'.$rs_call['file']);?>" width="400"></a></td>
		        </tr>
		        <?php endif;?>
		      </tbody>
		    </table>
			<br>
		    <?php if(isset($rs_call_reply)):?>
		        <?php foreach ($rs_call_reply as $key=>$rows):$key++;?>
			<table class="table" border="1" cellspacing="0" cellpadding="7" width="100%">
		      <tbody>
			  <tr>
		          <td><strong>รหัสคำตอบ</strong></td>
		          <td><?php echo isset($rows['id'])? '00'.$rows['id']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>รายละเอียดคำตอบ</strong></td>
		          <td><?php echo isset($rows['detail'])? $rows['detail']:'';?></td>
		        </tr>
		        <tr>
		          <td><strong>ผู้ตอบ</strong></td>
		          <td><?php echo isset($rows['name'])? $rows['name']:'';?></td>
		        </tr>
		        <tr>
		        	<td><strong>วันที่ตอบ</strong></td>
		        	<td><?php echo isset($rows['datepost'])? format_date1($rows['datepost']):'';?></td>
		        </tr>
		        <?php if($rows['file'] !=''):?>
				<tr>
		          <td><strong>สิ่งที่แนบคำตอบ</strong> </td>
		          <td><a href="<?php echo site_assets_url('images/call/reply/'.$rows['file'])?>"><?php echo $rows['file'];?></a></td>
		        </tr>
		        <?php endif;?>
		      </tbody>
		    </table>
		    <?php endforeach;?>
		        <?php endif;?>
			<div class="clear"></div>
			</div>

    <div class="clearfix"></div>

</div>