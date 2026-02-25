<script type="text/javascript" src="<?php echo site_assets_url('js/libs/jquery-1.10.2.min.js');?>" charset="UTF-8"></script>
<style>
table tr td{
	font-family:tahoma;
	font-size:12px;
}
</style>
<table width="100%" border="0">
    <tr>
        <td colspan="2">
            <input type="text" name="file_search" id="file_search" size="60">
            <button type="submit" id="bt_search">ค้นหา</button>
        </td>
    </tr>
  <tr>
    <td width="250" class="headertitle">จัดการไฟล์ ภาพ ( <?php echo ucfirst($file_name);?> )</td>
    <td width="746">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="2" valign="top" align="left">
    <div style="width:240; height:345; overflow:auto; background-color:#EFEFEF; margin:2;">
    <?php 
    while (($file = readdir($dh)) !== false){
		if($file!='..' && $file!='.'){
		$filess=pathinfo($ph.$file);
            natsort($filess);
    ?>

        <br><img src="<?php echo site_assets_url('images/icons/'.$filess['extension'].'.gif');?>">
    	<a id="<?php echo $file;?>" href="<?php echo site_url(admin_module('upload/'.$file_name.'?action=file&file='.$file))?>" class="small1" ><font color="green"><?php echo $file;?></font></a><br>
    <?php
    	}
    }
    closedir($dh);
    ?>
    </div>
    </td>
    <td class="small1">รายละเอียดไฟล์<hr>
    	<table border="0" width="100%">
    		<tr>
    			<td align="left" class="small1">File Type : <font color="green"><?php echo $file_extension;?></font></td>
    			<td align="right" class="small1">File Name : <font color="green"><?php echo $file_basename;?></font></td>
    		</tr>
    	</table>
    	<br><div style="width:450; height:280; overflow:auto; background-color:#EFEFEF; margin:2;"><?php if(!empty($img_name)):?><img src="<?php echo site_assets_url('images/'.$file_name.'/'.$img_name);?>" width="<?php echo $width;?>" height="<?php echo $height;?>"><?php endif;?></div>
    </td>
  </tr>
  <tr>
    <td>
    <?php if($action == 'file'):?>
	<form action="<?php echo site_url(admin_module('upload/'.$file_name.'?action=delete&file='.$img_name));?>" method="post" name="forms" target="_self" id="forms" >
	<table width="100%">
		<tr>
			<td>
				<input type="button" onclick="window.opener.document.getElementById('imp').innerHTML='<?php echo $img_name.'<';?>input type=hidden name=imps value=<?php echo $img_name;?>>'; window.close();" value="เลือกไฟล์นี้" id="button" name="button">
			</td>
			<td>			
				<input type="button" name="button2" id="button2" value="ลบรูปนี้" onclick="if(confirm('ยืนยันลบรูปนี้')){window.forms.submit();}">
			</td>
		</tr>
	</table>
	</form>
	<?php endif;?>
	</td>
  </tr>
</table>
<form action="<?php echo site_url(admin_module('upload/'.$file_name.'?action=save'));?>" method="post" name="form1" target="_self" id="form1" enctype="multipart/form-data">
<table width="100%" border="0">
 <tr>
    <td width="100%">
    Upload ไฟล์ใหม่   :  <input type="file" name="imp"> 
    <input type="submit" value="Upload ไฟล์..">  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <input type="button" name="button2" id="button2" value="ปิดหน้าต่างนี้" onclick="window.close();">
    </td>
</tr>
</table>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#bt_search').click(function(){
            var idFile = $('#file_search').val();
            window.location.href = "<?php echo site_url(admin_module('upload/'.$file_name.'?action=file&file='))?>"+idFile
        });
    });

</script>