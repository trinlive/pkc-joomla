<?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="box_news_main_news" style="margin:0px">
    <div class="main_content_green_long"><?php echo $title;?></div>
    <div class="clearfix"></div>
    <?php if($cate_id == 1):?>
        <?php if(isset($news['rows'])):?>
            <?php foreach ($news['rows'] as $key=>$pr):?>
                <a href="<?php echo site_url('news/'.$pr['id']);?>" target="_blank">
                    <div class=" col-lg-3 col-md-3 col-sm-3">
                    
                        <div style="border: 1px solid #d5d8d9; padding: 4px;margin: 15px 0;-webkit-box-shadow: 0 8px 6px -6px black;
	   -moz-box-shadow: 0 8px 6px -6px #33b1e6;
	        box-shadow: 0 8px 6px -6px #33b1e6">
                        <div class="news_content">
                            <div class="news_thumb">
                                <?php if($pr['image'] !=''):?>
                                    <img src="<?php echo site_assets_url('images/news/'.$pr['image']);?>" width="100%" height="135" alt=""/>
                                <?php else:?>
                                    <img src="<?php echo site_assets_url('images/news/Untitled_1.jpg');?>" width="100%" alt="" height="135"/>
                                <?php endif;?>
                            </div><div class="clearfix"></div>
                            <div class="news_title">
                                <?php echo title_text($pr['title'],70);?>
                                <br><span style="color:#ffd200; font-size:15px">(<?php echo format_date1($pr['date']);?>)</span>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="fb-root"></div>
<div class="fb-share-button" data-href="<?php echo site_url('news/'.$pr['id']);?>" data-layout="button_count"></div>
                    </div>
                </a>
            <?php endforeach;?>
        <?php endif;?>
    <?php endif;?>
    <?php if($cate_id == 2):?>
        <?php if(isset($news['rows'])):?>
            <?php foreach ($news['rows'] as $key=>$event):?>
                <a href="<?php echo site_url('news/'.$event['id']);?>" target="_blank">
                    <div class="act_box">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
                            <div class="act_thumb"><img src="<?php echo site_assets_url('images/news/'.$event['image']);?>" width="100%" alt=""/></div>
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>" width="10" height="10" alt=""/>
                                <?php echo title_text($event['title'],100);?>
                                <br><span class="act_date">(<?php echo format_date1($event['date']);?>)
                                <br><div id="fb-root"></div>
<div class="fb-share-button" data-href="<?php echo site_url('news/'.$event['id']);?>" data-layout="button_count"></div>
                    
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="act_line_dote"></div>
                </a>
            <?php endforeach;?>
        <?php endif;?>
    <?php endif;?>
    <?php echo $paging;?>
    <div class="clearfix"></div>

</div><!-- /end news -->
</div>