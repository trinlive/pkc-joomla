<?


$data='
<script>

function newtb(tbn) {


					var tableName = tbn;
					var tbs=document.getElementById(tableName); 
					var myNumRow = tbs.rows.length;
					var myNumCol = tbs.rows[0].cells.length;  
				
					tbs.insertRow(myNumRow);

					tbs.rows[myNumRow].insertCell();
					tbs.rows[myNumRow].cells[0].innerHTML="<hr height=1 bdcolor=red><font color=red>ชื่อไฟล์</font> : <input type=text name=item[] size=55><br><br><font color=red>เลือกไฟล์</font> : <input type=text name=url[] id=f"+(myNumRow)+" size=28> <input type=button value=\'เลือกไฟล์ / จัดการไฟล์\' onclick=b_file(\'f"+(myNumRow)+"\');>";
		
}


function b_file(id){
document.open("admin/b_file_download.php?tg="+id,"","width=750,height=465");
}
</script>';




// table Header
$data.='<form action="./admin.php?op='.$op.'&p='.$p.'&sp=save" method="post" name="form1" target="_self" id="form1">';
$data.='<table border="0" width="100%" cellpadding="0" cellspacing="0">';

$data.='<tr height="1" class="tbheader"><td colspan="2">&nbsp; สร้าง รายการ download ใหม่</td><tr>';
$data.='<tr height="1" bgcolor="#666666"><td colspan="2"></td><tr>';
$data.='<tr height="30">';
$data.='<td width="100" align="left"><b>หัวข้อ download</b></td>';
$data.='<td width="100" align="left"><input type="text" name="title" value="" size="60"></td>';
$data.='</tr>';
$data.='<tr height="30">';
$data.='<td align="left" valign="top"><b>รายละเอียด</b></td>';
$data.='<td align="left"><textarea name="detail" cols="65" rows="6"></textarea></td>';
$data.='</tr>';
$data.='<tr height="30">';
$data.='<td align="left"><b>สร้างโดย</b></td>';
$data.='<td align="left"><input type="text" name="name" value="'.$user_data['name'].'"></td>';
$data.='</tr>';
 

$data.='<tr height="1" bgcolor="#999999"><td colspan="2"></td><tr>';
$data.='<tr height="30">';
$data.='<td align="left" valign="top"><br><b>ไฟล์</b></td>';
$data.='<td align="left">';

$data.='<table id="tb1" name="tb1"><tr>
<td><input type="button" value="เพิ่ม ไฟล์ +" onclick="newtb(\'tb1\');"></td>
</tr>

<tr><td>
<font color=red>ชื่อไฟล์</font> : <input type="text" name="item[]" size="55"><br><br>
<font color=red>เลือกไฟล์</font> : <input type="text" name="url[]" id="f1" size="25"> <input type="button" value="เลือกไฟล์ / จัดการไฟล์" onclick="b_file(\'f1\');"></td></tr>

</table>';

$data.='<br></td>';
$data.='</tr>';


$data.='<tr height="1" bgcolor="#999999"><td colspan="2"></td><tr>';
$data.='<tr height="30">';
$data.='<td align="left">&nbsp;&nbsp;&nbsp;การแสดงผล</td>';
$data.='<td align="left"><input type="checkbox" name="status" value="1" checked> แสดง/ไม่แสดง</td>';
$data.='</tr>';
$data.='<tr height="1" bgcolor="#999999"><td colspan="2"></td><tr>';
$data.='<tr height="30">';
$data.='<td align="left"></td>';
$data.='<td align="left"><input type="submit" value="save" ></td>';
$data.='</tr>';
$data.='</table>';
$data.='</form>';





$main_data.=$lmenu.'&nbsp;>&nbsp;'.$nlmn[$p].'<br><br>';
$main_data.=$data;
?>