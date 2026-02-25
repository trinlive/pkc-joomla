<?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="box_news_main_news" style="margin:0px">
    <div class="clearfix"></div>
    <div style="padding:10px;">
    <div id="fb-root"></div>
<div class="fb-share-button" data-href="<?php echo site_url('news/'.$data['id']);?>" data-layout="button_count"></div>
     </div>
     <div class="clearfix"></div>
    <div style="padding: 10px;">

        <span><?php echo $data['text'];?></span>
        <?php echo $data['detail'];?>
    </div>
    <div class="clearfix"></div>

</div><!-- /end news -->
</div>