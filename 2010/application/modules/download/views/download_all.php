<?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="box_news_main_news">
    <div class="main_content_green_long"><?php echo 'ดาวน์โหลด';?></div>
    <div class="clearfix"></div>
    <?php if(isset($download['rows'])):?>
        <?php foreach($download['rows'] as $rows):?>
            <a href="<?php echo site_url('download/'.$rows['id']);?>" target="_blank">
                <div class="buy_box ">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/thumb_logo_64x64.png')?>" width="100%"  alt=""/></div>
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                        <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>" width="10" height="10" alt=""/>
                            <?php echo $rows['title'];?>
                            <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        <?php endforeach;?>

    <?php endif;?>

    <?php echo $paging;?>
    <div class="clearfix"></div>

</div>