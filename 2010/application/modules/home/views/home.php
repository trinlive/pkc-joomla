
<div class="col-lg-9 col-md-9 col-sm-9">
<div class="box_news_main">
    <div class="main_content_blue">
        <span style="line-height: 20px;">ข่าวประชาสัมพันธ์</span><br>
        <span style="font-size: 14px">Public Relations</span>
    </div>
    <div class="clearfix"></div>
    <?php if(isset($news_pr)):?>
    <?php foreach ($news_pr as $key=>$pr):?>
    <a href="<?php echo site_url('news/'.$pr['id']);?>" target="_blank">
        <div class=" col-lg-4 col-md-4 col-sm-4">
            <div style="border: 1px solid #d5d8d9; padding: 4px;margin: 15px 0;-webkit-box-shadow: 0 8px 6px -6px black;
	   -moz-box-shadow: 0 8px 6px -6px #33b1e6;
	        box-shadow: 0 8px 6px -6px #33b1e6">
            <div class="news_content">
                <div class="news_thumb">
                    <?php if($pr['image'] !=''):?>
                    <img src="<?php echo site_assets_url('images/news/'.$pr['image']);?>" width="100%" height="130" alt=""/>
                    <?php else:?>
                    <img src="<?php echo site_assets_url('images/news/Untitled_1.jpg');?>" width="100%" height="130" alt=""/>
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
    <div class="clearfix"></div>
    <div class="news_view_all"><a href="<?php echo site_url('news/pr/all');?>">ดูทั้งหมด</a></div>

</div><!-- /end news -->


<div class="box"></div>
<div class="box_news_main">
    <div class="main_content_blue">
        <span style="line-height: 20px;">ข่าวกิจกรรม</span><br>
        <span style="font-size: 14px">Activities</span>
    </div>
    <div class="clearfix"></div>

    <div class="box_act"></div>
    <?php if(isset($news_event)):?>
    <?php foreach ($news_event as $key=>$event):?>
    <a href="<?php echo site_url('news/'.$event['id']);?>" target="_blank">
        <div class="act_box" <?php echo ($key%2==0) ? 'style="background-color:#f2f3f3"':'';?>>
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-5">
                <div class="act_thumb"><img src="<?php echo site_assets_url('images/news/'.$event['image']);?>" width="100%" alt=""/></div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>"  alt=""/>
                    <?php echo title_text($event['title'],100);?>
                    <br><span class="act_date">(<?php echo format_date1($event['date']);?>)</span>
                    <br>
                    <div id="fb-root"></div>
                    <div class="fb-share-button" data-href="<?php echo site_url('news/'.$pr['id']);?>" data-layout="button_count"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="act_line_dote"></div>
    </a>
    <?php endforeach;?>
    <?php endif;?>
    <div class="news_view_all"><a href="<?php echo site_url('news/event/all');?>">ดูทั้งหมด</a></div>
</div><!-- /end act -->

<div class="box"></div>
<div class="box_news_main">
    <div class="main_content_blue">
        <span style="line-height: 20px;">ภาพกิจกรรม</span><br>
        <span style="font-size: 14px">Activities Photo</span>
    </div>
    <div class="clearfix"></div>
    <div class="box"></div>
    <div class="slide">
    <div class="bxslider">
    <?php foreach ($activity as $rows):?>


            <img id="activity" style="cursor: pointer;" data-href="<?php echo site_url('activity/'.$rows['id']);?>" src="<?php echo ($rows['image1'] != '')? site_assets_url('uploads/img_activity/tiny/'.$rows['image1']) : site_assets_url('uploads/img_activity/thumbnail/default.gif') ;?>" width="100%"/>

    <?php endforeach;?>
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="news_view_all"><a href="<?php echo site_url('activity/all/');?>">ดูทั้งหมด</a></div>
    <div class="box"></div>
</div><!-- /end images -->

<?php if(isset($highlight)):?>
<div class="box"></div>
<div class="box_news_main">
    <div class="main_content_blue">
        <span style="line-height: 20px;">เกี่ยวกับเทศบาลนครปากเกร็ด</span><br>
        <span style="font-size: 14px"> About Pakkretcity</span>
    </div>
    <div class="clearfix"></div>
    <div class="box"></div>
    <?php foreach ($highlight as $rows):?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="about_box">
            <a href="<?php echo ($rows['type']=='link') ? $rows['url'] : site_url('content/heighlight/'.$rows['content']);?>">
                <img src="<?php echo site_assets_url('images/header/'.$rows['header']);?>" width="73"  alt=""/></a>
            <br><?php echo $rows['name'];?>
        </div>
    </div>
    <?php endforeach;?>
    <div class="clearfix"></div>
    <div class="news_view_all"><a href="<?php echo site_url('heighlight/all');?>">ดูทั้งหมด</a></div>
    <div class="box"></div>
</div><!-- /end aboutUs -->
<?php endif;?>
<?php if(isset($meeting1) && count($meeting1) > 0 || isset($meeting2) && count($meeting2) > 0 || isset($meeting3) && count($meeting3) > 0):?>
    <div class="box"></div>
    <div class="box_news_main">
        <div class="main_content_blue">
            <span style="line-height: 20px;">รายงานการประชุม</span><br>
            <span style="font-size: 14px">Conference Report</span>
        </div>
        <div class="clearfix"></div>
        <div class="box"></div>

        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
            <?php if(isset($meeting2) && count($meeting2) > 0):?>
                <li class="active" role="presentation"><a href="#meeting2" aria-controls="meeting2" role="tab" data-toggle="tab">การประชุมหัวหน้าส่วนราชการ</a></li>
                <?php endif;?>

                <?php if(isset($meeting1) && count($meeting1) > 0):?>
                <li class="hidden-xs"  role="presentation" ><a href="#meeting1" aria-controls="meeting1" role="tab" data-toggle="tab">การประชุมสภาเทศบาล</a></li>
                <?php endif;?>
                
                <?php if(isset($meeting3) && count($meeting3) > 0):?>
                <li class="hidden-xs" role="presentation"><a href="#meeting3" aria-controls="meeting3" role="tab" data-toggle="tab">สัมมนาเชิงปฏิบัติการระหว่างผู้บริหารกับคณะกรรมการชุมชน</a></li>
                <?php endif;?>
                <?php if(isset($meeting2) && count($meeting2) > 0 || isset($meeting3) && count($meeting3) > 0):?>

                <li class="dropdown visible-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">อื่นๆ<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#meeting1" aria-controls="meeting1" role="tab" data-toggle="tab" >การประชุมสภาเทศบาล</a></li>
                        <li><a href="#meeting3" aria-controls="meeting3" role="tab" data-toggle="tab">รายงานการประชุมคณะกรรมการชุมชน</a></li>
                    </ul>
                </li>
                <?php endif;?>
            </ul> <!--end Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="meeting2">
                    <?php if(isset($meeting2)):?>
                        <?php foreach($meeting2 as $rows):?>
                            <a href="<?php echo site_assets_url('images/meeting/'.$rows['link']);?>" target="_blank">
                                <div class="buy_box ">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                                        <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/S__5824523.jpg')?>" width="100%"alt=""/></div>
                                    </div>

                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                                        <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>" alt=""/>
                                            <?php echo $rows['title'];?>
                                            <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php endforeach;?>
                        <div class="news_view_all"><a href="<?php echo site_url('meeting/all/2');?>">ดูทั้งหมด</a></div>
                    <?php endif;?>
                </div>

                <div role="tabpanel" class="tab-pane " id="meeting1">
                    <?php if(isset($meeting1)):?>
                        <?php foreach($meeting1 as $rows):?>
                            <a href="<?php echo site_assets_url('images/meeting/'.$rows['link']);?>" target="_blank">
                                <div class="buy_box ">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                                        <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/S__5824523.jpg')?>" width="100%"alt=""/></div>
                                    </div>

                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                                        <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>" alt=""/>
                                            <?php echo $rows['title'];?>
                                            <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php endforeach;?>
                        <div class="news_view_all"><a href="<?php echo site_url('meeting/all/1');?>">ดูทั้งหมด</a></div>
                    <?php endif;?>
                </div><!-- end tap1 -->

                
                <div role="tabpanel" class="tab-pane" id="meeting3">
                    <?php if(isset($meeting3)):?>
                        <?php foreach($meeting3 as $rows):?>
                            <a href="<?php echo site_assets_url('images/meeting/'.$rows['link']);?>" target="_blank">
                                <div class="buy_box ">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                                        <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/S__5824523.jpg')?>" width="100%"alt=""/></div>
                                    </div>

                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                                        <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>" alt=""/>
                                            <?php echo $rows['title'];?>
                                            <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        <?php endforeach;?>
                        <div class="news_view_all"><a href="<?php echo site_url('meeting/all/3');?>">ดูทั้งหมด</a></div>
                    <?php endif;?>
                </div>
            </div>
            <!-- end Tab panes -->
        </div>


    </div><!-- /end ข้อมูลการจัดซื้อจัดจ้าง -->
<?php endif;?>
<div class="box"></div>
<div class="box_news_main">
    <div class="main_content_blue">
        <span style="line-height: 20px;">การบริการประชาชน</span><br>
        <span style="font-size: 14px">Public Service</span>
    </div>
    <div class="clearfix"></div>

    <?php if(isset($service)):?>
        <?php foreach($service as $rows):?>
            <a href="<?php echo site_url('service/'.$rows['id'])?>" target="_blank">
                <div class="buy_box ">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/S__5824532.jpg')?>" width="100%" alt=""/></div>
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                        <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>"  alt=""/>
                            <?php echo $rows['title'];?>
                            <br><span class="act_date">(<?php echo ($rows['lastupdate'] !='') ? format_date1($rows['lastupdate']) : format_date1($rows['datepost']);?>)</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        <?php endforeach;?>
        <div class="news_view_all"><a href="<?php echo site_url('service/all');?>">ดูทั้งหมด</a></div>
    <?php endif;?>
</div>

<div class="box"></div>
<div class="box_news_main">
    <div class="main_content_blue">
        <span style="line-height: 20px;">ประกาศจัดซื้อ/จัดจ้าง/ประกวดราคา</span><br>
        <span style="font-size: 14px">Post Purchase/Hire/Tender</span>
    </div>
    <div class="clearfix"></div>

    <?php if(isset($auction)):?>
        <?php foreach($auction as $rows):?>
            <a href="<?php echo site_assets_url('images/auction/auction/'.$rows['link']);?>" target="_blank">
                <div class="buy_box ">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/thumb_logo_64x64.png')?>" width="100%" alt=""/></div>
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                        <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>" alt=""/>
                            <?php echo $rows['title'];?>
                            <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        <?php endforeach;?>
        <div class="news_view_all"><a href="<?php echo site_url('auction/auction');?>">ดูทั้งหมด</a></div>
    <?php endif;?>
</div>
<!-- /end ประมูล -->
<div class="box"></div>
<div class="box_news_main">
    <div class="main_content_blue">
        <span style="line-height: 20px;">ข้อมูลการจัดซื้อจัดจ้าง</span><br>
        <span style="font-size: 14px">Procurement Information</span>
    </div>
    <div class="clearfix"></div>
    <div class="box"></div>

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#checkauction" aria-controls="checkauction" role="tab" data-toggle="tab">การตรวจรับงานจัดซื้อ - จัดจ้าง</a></li>
            <li class="hidden-xs" role="presentation"><a href="#finauction" aria-controls="finauction" role="tab" data-toggle="tab">ผลการดำเนินการจัดซื้อจัดจ้าง</a></li>
            <li class="hidden-xs" role="presentation"><a href="#planauction" aria-controls="planauction" role="tab" data-toggle="tab">แผนปฏิบัติการจัดซื้อ/จัดจ้าง</a></li>
            <li class="dropdown visible-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">อื่นๆ<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#finauction" aria-controls="finauction" role="tab" data-toggle="tab" >ผลการดำเนินการจัดซื้อจัดจ้าง</a></li>
                    <li><a href="#planauction" aria-controls="planauction" role="tab" data-toggle="tab">แผนปฏิบัติการจัดซื้อ/จัดจ้าง</a></li>
                </ul>
            </li>
        </ul> <!--end Nav tabs -->

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="checkauction">
                <?php if(isset($checkauction)):?>
                <?php foreach($checkauction as $rows):?>
                <a href="<?php echo site_assets_url('images/auction/checkauction/'.$rows['link']);?>" target="_blank">
                    <div class="buy_box ">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                            <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/thumb_logo_64x64.png')?>" width="100%"alt=""/></div>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                            <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>" alt=""/>
                                <?php echo $rows['title'];?>
                                <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <?php endforeach;?>
                <div class="news_view_all"><a href="<?php echo site_url('auction/checkauction');?>">ดูทั้งหมด</a></div>
                <?php endif;?>
            </div><!-- end tap1 -->

            <div role="tabpanel" class="tab-pane" id="finauction">
                <?php if(isset($finauction) & count($finauction) > 0):?>
                    <?php foreach($finauction as $rows):?>
                        <a href="<?php echo site_assets_url('images/auction/finauction/'.$rows['link']);?>" target="_blank">
                            <div class="buy_box ">
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                                    <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/thumb_logo_64x64.png')?>" width="100%" alt=""/></div>
                                </div>

                                <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                                    <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>"  alt=""/>
                                        <?php echo $rows['title'];?>
                                        <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    <?php endforeach;?>
                    <div class="news_view_all"><a href="<?php echo site_url('auction/finauction');?>">ดูทั้งหมด</a></div>
                <?php else:?>
                    <div style="color:red;text-align: center;padding: 10px;">ไม่พบข้อมูล</div>
                <?php endif;?>
            </div>
            <div role="tabpanel" class="tab-pane" id="planauction">
                <?php if(isset($planauction)):?>
                    <?php foreach($planauction as $rows):?>
                        <a href="<?php echo site_assets_url('images/auction/planauction/'.$rows['link']);?>" target="_blank">
                            <div class="buy_box ">
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                                    <div class="logo_thumb"><img src="<?php echo site_assets_url('layouts/frontend/images/thumb_logo_64x64.png')?>" width="100%" alt=""/></div>
                                </div>

                                <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                                    <div class="act_text"><img src="<?php echo site_assets_url('layouts/frontend/images/star.png')?>"  alt=""/>
                                        <?php echo $rows['title'];?>
                                        <br><span class="act_date">(<?php echo format_date1($rows['date']);?>)</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    <?php endforeach;?>
                    <div class="news_view_all"><a href="<?php echo site_url('auction/planauction');?>">ดูทั้งหมด</a></div>
                <?php endif;?>
            </div>
        </div>
        <!-- end Tab panes -->
    </div>


</div><!-- /end ข้อมูลการจัดซื้อจัดจ้าง -->

<div class="box"></div>
</div>
