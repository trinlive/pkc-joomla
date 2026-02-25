 <script type="text/javascript">
$(document).ready(function(e) {

 // delete the entry once we have confirmed that it should be deleted
	var loader = $('#img-loader');
	var web_site_url = "<?php echo site_url(admin_module('preference/highlight'));?>";
    $('.delete').click(function() {
    	var parent = $(this).closest('tr');

		$('.confirm_delete').attr('id', $(this).attr('id'));
		$('.delete').unbind("click");
       
		$('.confirm_delete').click(function(){
			var id = $(this).attr('id');
			var highlight_id_list = id.split('_');
			var highlight_id = highlight_id_list[1];
			$.ajax({
				type: 'POST',
				url: web_site_url+'/delete',
				data: {
					MM_action : 'delete',
					highlight_id : highlight_id
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
            <div class="col-md-12">
                <!-- start: BASIC TABLE PANEL -->
                <div style="float: right;padding-bottom:10px"><a href="<?php echo site_url(admin_module('preference/highlight/new'))?>" class="btn btn-primary" > เพิ่ม เมนู Highlight <i class="fa fa-arrow-circle-right"></i></a></div>
                <div style="clear: both"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        เพิ่ม เมนู Highlight
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover" id="sample-table-1">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>เมนู highlight</th>
                              <th>อันดับ</th>
                              <th>สถานะ</th>
                              <th>วันที่สร้าง</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $i = 0;
                            if(isset($highlightlist['rows'])):
                                foreach($highlightlist['rows'] as $rows):
                                    $i++;
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $rows['name']; ?>
                              <?php echo ($rows['url'] !='')? '<img src="'.site_assets_url('layouts/administator/images/link.jpg').'" title="ประเภท link ไปยัง url">':'';?>
                              <?php echo ($rows['header'] !='')? '<img src="'.site_assets_url('layouts/administator/images/imp.gif').'">':'';?>
                              </td>
                              <td><?php echo $rows['indexs']; ?></td>
                              <td><?php echo ($rows['status'] == '1')? '<font color="green">ใช้งาน</font>':'<font color="red">ปิดใช้งาน</font>'; ?></td>
                              <td><?php echo ($rows['lastupdate'] == '')? 'สร้าง :<font color="#0075EA">'.format_date1($rows['date']).'</font>':'สร้าง  : <font color="#0075EA">'.format_date1($rows['date']).'</font><br>แก้ไข : <font color="#E13800">'.format_date1($rows['lastupdate']).'</font>'; ?></td>

                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="<?php echo site_url(admin_module('preference/highlight/edit?highlight_id='.$rows['id']))?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="แก้ไข"><i class="fa fa-edit"></i></a>
                                        <a href="#delete" class="btn btn-xs btn-bricky tooltips delete"  data-toggle="modal"  id="delete_<?php echo $rows['id'];?>" data-placement="top" data-original-title="ลบ"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="<?php echo site_url(admin_module('preference/highlight/edit?highlight_id='.$rows['id']))?>">
                                                        <i class="fa fa-edit"></i> แก้ไข
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="#delete" data-toggle="modal" id="delete_<?php echo $rows['id'];?>">
                                                        <i class="fa fa-times"></i> ลบ
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div></td>
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

                </div>
            </div>
            <!-- end: BASIC TABLE PANEL -->
        </div>
 </div>
 <!-- end: PAGE CONTENT-->