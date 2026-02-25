
<?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="box_news_main_news">
    <div class="main_content_green_long"><?php echo 'ภาพกิจกกรม';?></div>
    <div class="clearfix"></div>
        <?php if(isset($activity['rows'])):?>
            <?php foreach ($activity['rows'] as $index =>$rows):?>
                <a href="<?php echo site_url('activity/'.$rows['id']);?>" target="_blank">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div style="margin:15px 0;-webkit-box-shadow: 0 8px 6px -6px black;
	   -moz-box-shadow: 0 8px 6px -6px #33b1e6;
	        box-shadow: 0 8px 6px -6px #33b1e6">
                        <div class="img_thumb">
                            <img src="<?php echo ($rows['image1'] != '')? site_assets_url('uploads/img_activity/tiny/'.$rows['image1']) : site_assets_url('uploads/img_activity/thumbnail/default.gif') ;?>" width="100%" height="150" alt=""/>
                            <div class="clearfix"></div>
                            <div class="news_title">
                                <?php echo title_text($rows['title'],50);?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <div id="fb-root"></div>
<div class="fb-share-button" data-href="<?php echo site_url('activity/'.$rows['id']);?>" data-layout="button_count"></div>
     
                    </div>
                </a>
            <?php endforeach;?>
        <?php endif;?>
    <div style="padding-left:10px;"><?php echo $paging;?></div>
    <div class="clearfix"></div>

</div><!-- /end news -->