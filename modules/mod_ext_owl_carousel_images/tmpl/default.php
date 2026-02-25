<?php
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x - Joomla 4.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2020 Eco-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Eco-Joom.com
# Author: Makeev Vladimir
#Author email: v.v.makeev@icloud.com
# Websites:  http://eco-joom.com
# Date modified: 05/05/2020 - 13:00
# ------------------------------------------------------------------------
*/


// no direct access
defined('_JEXEC') or die;

	
$document->addCustomTag('
<style type="text/css">

.ext_owl_carousel_'.$ext_id.' {
	max-width: '.$ext_width_block.'px;
}

</style>');
?>


<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#owl-example-<?php echo $ext_id;?>").owlCarousel({
		items : <?php echo $ext_items; ?>,
		itemsCustom : <?php echo $ext_itemscustom; ?>,
		itemsDesktop : <?php echo $ext_itemsdesktop; ?>,
		itemsDesktopSmall : <?php echo $ext_itemsdesktopsmall; ?>,
		itemsTablet : <?php echo $ext_itemstablet; ?>,
		itemsTabletSmall : <?php echo $ext_itemstabletsmall; ?>,
		itemsMobile : <?php echo $ext_itemsmobile; ?>,

		slideSpeed : <?php echo $ext_slidespeed; ?>,
		paginationSpeed : <?php echo $ext_paginationspeed; ?>,
		rewindSpeed :  <?php echo $ext_rewindspeed; ?>,

		autoPlay : <?php echo $ext_autoplay; ?>,
		stopOnHover : <?php echo $ext_stoponhover; ?>,

		navigation : <?php echo $ext_navigation; ?>,
		navigationText : ["<?php echo $ext_navigationtext_prev;?>","<?php echo $ext_navigationtext_next;?>"],
		rewindNav : <?php echo $ext_rewindnav; ?>,
		scrollPerPage : <?php echo $ext_scrollperpage; ?>,

		pagination : <?php echo $ext_pagination; ?>,
		paginationNumbers : <?php echo $ext_paginationnumbers; ?>,

		responsive : <?php echo $ext_responsive; ?>,
		responsiveRefreshRate : <?php echo $ext_responsiverefreshrate; ?>,
		responsiveBaseWidth	: <?php echo $ext_responsivebasewidth; ?>,
		

		baseClass : "<?php echo $ext_baseclass;?>",
		theme : "<?php echo $ext_theme;?>",

		lazyLoad : <?php echo $ext_lazyload;?>,
		lazyFollow : <?php echo $ext_lazyfollow;?>,
		lazyEffect : "<?php echo $ext_lazyeffect;?>",

		autoHeight : <?php echo $ext_autoheight;?>,


		dragBeforeAnimFinish : <?php echo $ext_dragbeforeanimfinish; ?>,
		mouseDrag : <?php echo $ext_mousedrag; ?>,
		touchDrag : <?php echo $ext_touchdrag; ?>,

		addClassActive : <?php echo $ext_addclassactive; ?>,
		transitionStyle : <?php echo ($ext_transitionstyle == 'false' ? 'false' : '"'.$ext_transitionstyle.'"')?>,
		

		beforeUpdate : <?php echo $ext_beforeupdate; ?>,
		afterUpdate : <?php echo $ext_afterupdate; ?>,
		beforeInit : <?php echo $ext_beforeinit; ?>,
		afterInit : <?php echo $ext_afterinit; ?>,
		beforeMove : <?php echo $ext_beforemove; ?>,
		afterMove : <?php echo $ext_aftermove; ?>,
		afterAction : <?php echo $ext_afteraction; ?>,
		startDragging : <?php echo $ext_startdragging; ?>,
		afterLazyLoad: <?php echo $ext_afterlazyload; ?>
		
		
	});
	
  
});


</script>

<div class="mod_ext_owl_carousel_images ext_owl_carousel_<?php echo $ext_id; ?> <?php echo $moduleclass_sfx ?>">	
	<div id="owl-example-<?php echo $ext_id; ?>" class="owl-carousel owl-theme" >	
		<?php	
		for($n=0;$n < count($img);$n++) {			
			if( $img[$n] != '') {		
				if ($url[$n] != '') {
					echo '<div class="ext-item-wrap">';
					echo '<a href="'.$url[$n].'" target="'.$target[$n].'"><img src="'.$img[$n].'" alt="'.$alt[$n].'" /></a>';
					if ($html[$n] != '') {
						echo '<div class="ext-item-html">'.$html[$n].'</div>';
					}
					echo '</div>';
					
				
				} else {
						echo '<div class="ext-item-wrap">';
						echo '<img src="'.$img[$n].'" alt="'.$alt[$n].'" />';
						if ($html[$n] != '') {
							echo '<div class="ext-item-html">'.$html[$n].'</div>';
						}
						echo '</div>';
					}

			}
		}	
		?>
	</div>	
	
	<div style="clear:both;"></div>
</div>

