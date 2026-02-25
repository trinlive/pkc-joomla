<div class="col_left float-left">
<?php if(isset($menulist)):?>
<div class="left_nav">
<ul id="nav">
	<?php foreach ($menulist as $menu):?>
	<li>
	<a href="<?php echo ($menu['type']=='content')? site_url('content/'.$menu['id']):$menu['url'];?>"><?php echo $menu['name'];?></a>
		<?php if(!empty($menu['sub_menu'])):?>
			<?php //if($menu['type'] != 'content'):?>
			<ul style="width:250px;z-index:10000">
				<?php foreach ($menu['sub_menu'] as $sub_menu):?>
				<li>
				<a href="<?php echo ($sub_menu['type']=='content')? site_url('content/'.$sub_menu['id']):$sub_menu['url'];?>"><?php echo $sub_menu['name'];?></a>
				<?php if(!empty($sub_menu['sub_link_menu'])):?>
					<ul style="width: 250px;left:130px;z-index:10000">
					<?php foreach ($sub_menu['sub_link_menu'] as $sub_link_menu):?>
						<li><a href="<?php echo ($sub_link_menu['type']=='content')? site_url('content/'.$sub_link_menu['id']):$sub_link_menu['url'];?>"><?php echo $sub_link_menu['name'];?></a></li>
					<?php endforeach;?>
					</ul>
				<?php endif;?>
				</li>
				<?php endforeach;?>
			</ul>
			<?php //endif;?>
		<?php endif;?>
	</li>
	<?php endforeach;?>
</ul>
</div>
<?php endif;?>
<?php if(IS_MEMBER_LOGIN):?>
<div class="right_highlight">
	<div class="title">ผู้ใช้งานระบบ  <div class="btn_viewmore"><a href="<?php echo site_url('auth/logout');?>"><span>ออกจากระบบ</span></a></div></div>
	<div class="rightbox">
		<div style="padding:10px">
			<div style="position: relative; left: 5px; width: 31px; float: left;top:-5px">
			<img src="<?php echo site_assets_url('layouts/frontend/images/emblem-people.png');?>" width="38px">
			</div>
			<div style="float: left; position: relative; top: 10px;left:27px"><span><?php echo $member['name'];?></span></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php endif;?>
<div class="right_highlight">
	<div class="rightbox" style="border-top-right-radius: 5px;border-top-left-radius: 5px;margin-top: 5px;
	background: url(<?php echo site_assets_url('layouts/frontend/images/online.png');?>) repeat-x scroll center center #3ecdbf;height:130px">
	<ul style="margin:70px 0 0 72px;width:163px;color:#ffffff;font-weight:bold;">
		<li style="border-bottom:none;margin:0;padding:6px 0;"><?php echo $counter;?></li>
		<li style="border-bottom:none;margin:0;padding:6px 0;"><?php echo $useronline;?></li>
	</ul>	
	</div>
</div>
<div class="right_highlight">
	<div class="title">ปฏิทินวันนี้ </div>
	<div class="rightbox" style="text-align:center;">
		<script type="text/javascript" src="http://mycalendar.org/calendar.php?cp3_Hex=0F0200&cp2_Hex=FFFFFF&cp1_Hex=000086&ham=0&img=&hbg=0&hfg=1&sid=0&fwdt=200&&widget_number=2"></script>
	</div>
</div>
<div class="rightbox" style="border-top-right-radius: 5px;border-top-left-radius: 5px;margin-top: 5px;">
<?php if(isset($highlight)):?>
<ul>
    <?php foreach ($highlight as $rows):?>
    <li style="padding:3px;margin: 0 0 3px;"><a href="<?php echo ($rows['type']=='link') ? $rows['url'] : site_url('content/heighlight/'.$rows['content']);?>"><img width="206px" src="<?php echo site_assets_url('images/header/'.$rows['header'])?>" alt="<?php echo $rows['name'];?>"></a></li>
    <?php endforeach;?>
</ul>          
<?php endif;?>
</div>
<div class="right_highlight">
	<div class="title">การบริการประชาชน</div>
	<div class="rightbox">
	<?php if(isset($service)):?>
		<ul>
			<?php foreach ($service as $rows):?>
			<li style="padding: 10px 0;margin:0px;">
			<img src="<?php echo site_assets_url('layouts/frontend/images/readmore.jpg');?>">
			<a href="<?php echo site_url('service/'.$rows['id'])?>" target="_blank"><?php echo $rows['title'];?></a>
			</li>
			<?php endforeach;?>
			<div class="clear"></div>
		</ul>
	<?php endif;?>
	</div>
	<div class="clear"></div>
</div>
<div class="right_highlight">
	<div class="title">Link</div>
	<div class="rightbox">
	<?php if(isset($link)):?>
		<ul>
			<?php foreach ($link as $rows):?>
			<li style="padding: 10px 0;margin:0px;"><a href="<?php echo $rows['link'];?>" target="_blank" ><img src="<?php echo site_assets_url('images/link/'.$rows['image']);?>" width="180" alt="<?php echo $rows['title'];?>"></a></li>
			<?php endforeach;?>
			<div class="clear"></div>
		</ul>
	<?php endif;?>
	</div>
	<div class="clear"></div>
</div>

</div>