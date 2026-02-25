<!-- start: PAGE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- start: BASIC TABLE PANEL -->
        <div style="float: right;padding-bottom:10px"><a href="<?php echo site_url(admin_module('menus/create'))?>" class="btn btn-primary" >Add <?php echo ucfirst($this->uri->segment(3));?> <i class="fa fa-arrow-circle-right"></i></a></div>
        <div style="clear: both"></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                เมนู
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover" id="sample-table-1">
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>เมนู </th>
                        <th>ระดับผู้ใช้งาน</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($menulists) > 0):?>
                        <?php foreach ($menulists as $rows):
                            $number++;
                            ?>
                            <tr>
                                <td class="center">$number</td>
                                <td><?php echo $rows['title']; ?> </td>
                                <td><?php echo $rows['access_level']; ?></td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                            <a href="<?php echo site_url(admin_module('/menus/edit?menu_id='.$rows['id']))?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="#delete" class="btn btn-xs btn-bricky tooltips delete"  data-toggle="modal"  id="delete_<?php echo $rows['id']; ?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="<?php echo site_url(admin_module('/menus/edit?menu_id='.$rows['id']))?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                               <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="#delete" data-toggle="modal" id="delete_<?php echo $rows['id']; ?>">
                                                            <i class="fa fa-times"></i> Remove
                                                        </a>
                                               </li>

                                            </ul>
                                        </div>
                                    </div></td>
                            </tr>

                        <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end: BASIC TABLE PANEL -->
    </div>
</div>
<!-- end: PAGE CONTENT-->