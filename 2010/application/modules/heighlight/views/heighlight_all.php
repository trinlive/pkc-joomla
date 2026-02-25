<?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="box_news_main_news">
    <div class="main_content_green_long"><?php echo 'เกี่ยวกับเทศบาลนครปากเกร็ด';?></div>
    <div class="clearfix"></div>
    <?php if(isset($heighlight['rows'])):?>
        <?php foreach($heighlight['rows'] as $rows):?>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <div class="about_box">
                    <a href="<?php echo ($rows['type']=='link') ? $rows['url'] : site_url('content/heighlight/'.$rows['content']);?>">
                        <img src="<?php echo site_assets_url('images/header/'.$rows['header']);?>" width="73"  alt=""/></a>
                    <br><?php echo $rows['name'];?>
                </div>
            </div>
        <?php endforeach;?>

    <?php endif;?>


    <div class="clearfix"></div>
    <div style="padding:10px; ">
        <?php echo $paging;?>
    </div>


</div>