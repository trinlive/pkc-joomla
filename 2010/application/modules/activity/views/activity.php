<?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="box_news_main_news">
    <div class="clearfix"></div>
    <div style="padding:10px;">
    
<div id="fb-root"></div>
<div class="fb-share-button" data-href="<?php echo site_url('activity/'.$data['id']);?>" data-layout="button_count"></div>

    </div>
    <div style="padding: 10px;">
        <?php if($data['image3']!=''):?>
            <img width="100%" height="100%" src="<?php echo site_assets_url('uploads/img_activity/fullsize/'.$data['image3']);?>">
        <?php else:?>
            <div style="margin:10px;"><?php echo $data['text'];?></div>
        <?php endif;?>
        <div class="clear"></div>
        <div style="margin:10px;"><?php echo $data['detail'];?></div>
        <div class="clear"></div>
        <div id="thumbpk">
            <div class="detail_list">
                <ul class="gallery">
                    <?php
                    $i = 0;
                    if(isset($data_thumb)):
                        foreach($data_thumb as $index =>$rows):
                            $i++;
                            ?>
                            <li>
                                <div class="thumb" style="border:1px solid #CCCCCC;padding: 5px;">
                                    <a href="<?php echo site_assets_url('uploads/img_activity/fullsize/'.$rows['image2']);?>"  title="<?php echo $rows['caption']?>"  rel="prettyPhoto[gallery2]" title="<?php echo $rows['caption'];?>">
                                        <img width="90" height="80" src="<?php echo site_assets_url('uploads/img_activity/thumbnail/'.$rows['image1']);?>" alt="<?php echo $data['title'];?>" >
                                    </a>
                                </div>
                            </li>

                        <?php
                        endforeach;
                    else:
                        ?>

                    <?php endif;?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clearfix"></div>

</div><!-- /end news -->

<script type="text/javascript" charset="utf-8">
var $j = jQuery.noConflict();
$j(document).ready(function(){
	$j("area[rel^='prettyPhoto']").prettyPhoto();
	
	$j(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
});
</script>