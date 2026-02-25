<div class="span9">
<h1 class="page-title"><?php echo $head_title;?></h1>
<form name="formMenus" id="formMenus" action="<?php echo site_url(ADMIN_MODULE_2013.'/menus/action'); ?>" method="post" autocomplete="off">
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      	<label>Accress Level</label>
      	<?php 
      	$arr_access_level = explode(',', $menus['access_level']);
      	?>
      	<select name="access_level[]" multiple="multiple" class="input-xlarge">
			<?php foreach($access_level_list as $k=>$v) :?>
              <?php
              $selected = '';
              if($arr_access_level == $k)
              {
                  $selected = ' selected ="selected" ';
              }
              ?>
              <option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v;?></option>
              <?php endforeach;?>
          </select>
        <label>Menu</label>
        <input type="text" name="title" id="title"  value="<?php if(isset($menus['title'])): echo $menus['title']; endif; ?>" class="input-xlarge">
      </div>
      <div class="tab-pane fade" id="profile">
      </div>
      <input type="hidden" name="MM_action" value="update">
      <input type="hidden" name="menu_id" id="menu_id"  value="<?php if(isset($menus['id'])): echo $menus['id']; endif; ?>">
      <div class="btn-toolbar">
    	<button class="btn btn-primary" id="save_menu">
    		<i class="icon-save"></i> Save</button>
    	<input type="reset" value="Reset" style="height:30px;" class="btn"/>
  		<div class="btn-group"></div>
	 </div>
  </div>
</div>
</form>
</div>