<!--  <div class="span9">
<h1 class="page-title"><?php echo $head_title;?></h1>
<form name="formMenus" id="formMenus" action="<?php echo site_url(ADMIN_MODULE_2013.'/menus/action'); ?>" method="post" autocomplete="off">
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      	<label>Accress Level</label>
      	<select name="access_level[]" multiple="multiple" class="input-xlarge">
            <?php foreach($access_level_list as $k=>$v) :?>
                <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php endforeach;?>
		</select>
        <label>Menu</label>
        <input type="text" name="title" id="title"  value="" class="input-xlarge">
      </div>
      <div class="tab-pane fade" id="profile">
      </div>
      <input type="hidden" name="MM_action" value="create">
      <div class="btn-toolbar">
    	<button class="btn btn-primary" id="save_menu">
    		<i class="icon-save"></i> Save</button>
    	<input type="reset" value="Reset" style="height:30px;" class="btn"/>
  		<div class="btn-group"></div>
	 </div>
  </div>
</div>
</form>
</div>-->
<form name="formMenus" id="formMenus" action="<?php echo site_url(ADMIN_MODULE.'/menus/action'); ?>" method="post" autocomplete="off">
<div class="btn-toolbar">
    <button class="btn btn-primary" id="save_menu"><i class="icon-save"></i> Save</button>
    <a href="#myModal" data-toggle="modal" class="btn">Reset</a>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <div id="myTabContent" class="tab-content">
		<label>ระดับ</label>
        <select name="access_level[]" id="access_level" multiple="multiple" class="input-xlarge">
        	<?php foreach($access_level_list as $k=>$v) :?>
                <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php endforeach;?>
    	</select>
    	<label>เมนู</label>
        <input type="text" name="title" id="title" value="" class="input-xlarge">
        <input type="hidden" name="MM_action" value="create">
  </div>
</div>
</form>