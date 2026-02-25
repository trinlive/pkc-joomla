<?php
 $stmt1 = $db->Prepare('SELECT * FROM admins WHERE admins.login_status =? and admins.admin_active =?');
 $rs1 = $db->Execute($stmt1,array('Online','Active'));
 $useronline=$rs1->RecordCount();
 
 $mstmt2 = $db->Prepare('SELECT admins.username, admins.passwd, admins.admin_active, admin_infos.admin_id, admin_infos.last_date, st_members.st_member_detail, st_members.st_member, admin_infos.rules, admin_infos.name, admin_infos.surname FROM admins Inner Join admin_infos ON admin_infos.admin_id = admins.admin_id  Inner Join st_members ON st_members.st_member = admin_infos.st_member  WHERE admins.login_status =? and admins.admin_active =?') ;			
  $rs2 = $db->Execute($mstmt2,array('Online','Active'));

 ?>
<table width="164"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><img src="images/line_left.gif" width="165" height="1" /></td>
  </tr>
  <tr>
    <td class="arialWH11B" style="padding-left:5px;"><img src="images/icon_member.gif" width="30" height="22" align="absmiddle" style="margin-right:5px;" />Online :<span style="margin-left:30px;" class="arialWH11B">[<?php echo $useronline; ?>]</span></td>
  </tr>
  <?php if (!$rs2->EOF):?>
  <?php  while (!$rs2->EOF): ?>  
  <tr>
    <td class="arialWH11B" style="padding-left:5px;"><li>
<?php 
echo $rs2->fields['name']."  ".$rs2->fields['surname'];
?></li></td>
  </tr>
	<?php $rs2->MoveNext(); ?>
	<?php endwhile; ?>  
	<?php endif; ?>	
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_black02.gif">
              <tr>
                <td height="1"></td>
              </tr>
</table>