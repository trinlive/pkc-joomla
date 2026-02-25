<script type="text/javascript">
jQuery(document).ready(function() {
	var $j = jQuery.noConflict();
	$j('a[name="signin_popup"]').click(function(){
		var ref = location.href;
		//var redirect = $(this).attr('redirect');
		//if(redirect != '' && redirect != undefined) ref = encodeURIComponent(redirect);

		var register_url = '';
		//if($(this).attr('register') != undefined){
			//var register_url = encodeURIComponent($(this).attr('register'));
		//}

		var href = '<?php echo site_url('auth/signin')?>';
		$j.fancybox({
			type: 'iframe',
			href: href,
			padding: 0,
			scrolling: 'no',
			width: 420,
			height: 420,
			onStart: function(){

			},onComplete: function(){
				$j(".fancybox-wrap").css({'top':'10px', 'bottom':'auto'});
				$j('.fancybox-skin').css({"width":"420px","height":"420px"});
				$j('.fancybox-close').css({"background":""});
				$j('.fancybox-close').css({
					"width":"55px",
					"height": "55px",
					"top": "-20px",
					"right": "-22px"
				});
			}
		});
		return false;
	});


});
</script>
<style type="text/css">
	.fancybox-wrap {
	  position: absolute;
	  top: 100px !important;
	}
</style>
<?php //echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="box_news_main_news">
    <div class="main_content_green_long"><?php echo 'สายตรงเทศบาล';?></div>
    <div class="clearfix"></div>
    
    <table class="table">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>หัวข้อคำถาม</th>
          <th>วันที่โพส</th>
          <th>วันที่ตอบ</th>
        </tr>
      </thead>
      <tbody>
      <?php
      	$i = 0;
		if(isset($call['rows'])):
			foreach($call['rows'] as $rows):
				$i++;
		?>
        <tr>
          <td><?php echo $rows['id']; ?></td>
          <td><a href="<?php echo site_url('call/view?call_id='.$rows['id']);?>" target="_blank"><?php echo $rows['title']; ?></a></td>
          <td width="120"><?php echo format_date1($rows['datepost']); ?></td>
          <td><?php echo format_date1($rows['reply']); ?></td>
        </tr>
        <?php
			endforeach;
		else:
		?>
        <tr>
           <td colspan="4" align="center">ไม่มีข้อมูล</td>
        </tr>
        <?php endif;?>
      </tbody>
    </table>
<?php echo $paging;?>
			</div>
    <div class="clearfix"></div>

</div>