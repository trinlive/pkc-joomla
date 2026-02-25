<div class="col-lg-3 col-md-3 col-sm-3">
    <div class="box_news_main2">
        <div class="main_content_blue">
            <span style="line-height: 20px;">นายกเทศมนตรี</span><br>
            <span style="font-size: 14px">Mayor Pakkretcity</span>
        </div>
        <div class="box_pic_boss">
            <img src="<?php echo site_assets_url('layouts/frontend/images/pic_vichia.png')?>" width="80%" alt=""/>
            <br>นายวิชัย บรรดาศักดิ์</div>

    </div>
    <?php if($poll['poll_item']):?>
    <div class="box"></div>
        <div class="box_news_main2">
            <div class="main_content_blue">
                <span style="line-height: 20px;">เทศบาลนครปากเกร็ด</span><br>
                <span style="font-size: 14px">Pakkretcity</span>
            </div>
            <div class="box"></div>
            <form id="vote_form" style="margin:10px">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><?php echo $poll['title'];?></td>
                    </tr>
                    <?php if($poll['poll_item']):?>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <?php foreach ($poll['poll_item'] as $poll_item):?>
                                        <tr>
                                            <td width="30"><input type="radio" name="ch" id="ch" value="<?php echo $poll_item['id']?>" /></td>
                                            <td align="left"><?php echo $poll_item['title']?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="vote" style="padding:10px 0;"><a href="javascript:;"><span>โหวต</span></a></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <?php
                                    $cl = array('F58B21','919100','186CB1','936293','FFCECE','69CD9B','999999');
                                    ?>
                                    <?php foreach ($poll['poll_item'] as $key=>$rs_item):?>

                                        <tr>
                                            <td>
                                                <?php echo $rs_item['title'];?> &nbsp;&nbsp;&nbsp;<?php echo sprintf("%4.2f",($rs_item['vote']/$poll['total_vote'])*100);?>
                                                <div style="background-color:<?php echo '#'.$cl[$key];?>; width:<?php echo sprintf("%4.2f",($rs_item['vote']/$poll['total_vote'])*100)*2;?>px; height:13px;"></div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endif;?>
                </table>
            </form>
            <div class="box"></div>
        </div><!-- /end เทศบาลนครปากเกร็ด -->
    <?php endif;?>


    <div class="box"></div>
    <?php if(isset($highlight)):?>
        <div class="box_news_main2">
            <div class="main_content_blue">
                <span style="line-height: 20px;">สถานะการคลัง</span><br>
                <span style="font-size: 14px">State Treasury</span>
            </div>
            <div class="box"></div>
            <div class="box_banner_r">
                <a href="<?php echo site_url('account/1');?>" target="_blank">การโอนเงินงบประมาณรายจ่ายประจำปี </a>
            </div>
            <div class="box_banner_r">
                <a href="<?php echo site_url('account/2');?>" target="_blank">งบการเงิน  </a>
            </div>
            <div class="box_banner_r">
                <a href="<?php echo site_url('account/3');?>" target="_blank">งบแสดงฐานะการเงิน  </a>
            </div>
            <div class="box_banner_r">
                <a href="<?php echo site_url('account/4');?>" target="_blank">รายงานแสดงผลการดำเนินงาน  </a>
            </div>
            <div class="box_banner_r">
                <a href="<?php echo site_url('account/5');?>" target="_blank">ประกาศรายงานการรับจ่ายเงิน  </a>
            </div>

            <div class="box"></div>
        </div><!-- /end เทศบาลนครปากเกร็ด -->
    <?php endif;?>

    <div class="box"></div>
    <?php if(isset($highlight)):?>
    <div class="box_news_main2">
        <div class="main_content_blue">
            <span style="line-height: 20px;">เทศบาลนครปากเกร็ด</span><br>
            <span style="font-size: 14px">Pakkretcity</span>
        </div>
        <div class="box"></div>
        <?php foreach ($highlight as $rows):?>
        <div class="box_banner_r">
            <a target="_blank" href="<?php echo ($rows['type']=='content')?  site_url('content/heighlight/'.$rows['content']): $rows['url'];?>"><img src="<?php echo site_assets_url('images/header/'.$rows['header']);?>" width="218" alt=""/></a>
        </div>
        <?php endforeach;?>
        <div class="box"></div>
    </div><!-- /end เทศบาลนครปากเกร็ด -->
    <?php endif;?>

    <div class="box"></div>

    <div class="box_news_main2">
        <div class="main_content_blue">
            <span style="line-height: 20px;">ลิ้งหน่วยงานราชการ</span><br>
            <span style="font-size: 14px">Government Links</span>
        </div>
        <div class="box_pic_boss">
            <!-- Split button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default"> -- เว็บไซต์กระทรวงต่างๆ -- </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <?php if(isset($link)):?>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach ($link as $rows):?>
                            <li><a href="<?php echo $rows['link'];?>" target="_blank" ><?php echo $rows['title'];?></a></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>

            </div>
            <div class="box"></div>

            <div class="btn-group">
                <button type="button" class="btn btn-default"> -- เว็บลิ้ง นครปากเกร็ด -- </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>

    </div><!-- /end ลิ้งที่เกี่ยวข้อง -->

    <div class="box"></div>
    <div class="box_news_main2">
        <div class="main_content_blue">
            <div class="main_text_left">
            <span style="line-height: 20px;">สถิติการเข้าชมเว็บไซต์</span><br>
            <span style="font-size: 14px">Statistics Website</span>
            </div>
            <div class="main_text_right visible-lg visible-md"><img src="<?php echo site_assets_url('layouts/frontend/images/icon_stat.png')?>" width="50" height="35" alt=""/></div>
        </div>
        <div class="box"></div>
        <div class="detail_stat">
            <span style="color:#619c42">วันนี้   : <?php echo $useronlineday;?> คน</span><br>
            <span style="color:#964b9d">ทั้งหมด : <?php echo $counter;?> คน</span><br>
            <span style="color:#ee3a24">ออนไลน์ : <?php echo $useronline;?> คน</span><br>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready( function() {
        var $j = jQuery.noConflict();

        $j('#vote').click( function() {
            $j.ajax({
                type: 'POST',
                url: '<?php echo site_url('vote');?>',
                data: $j('#vote_form').serialize() ,
                beforeSend: function() {

                },
                success: function(data) {
                    document.location.reload();
                }
            });
        } );
    } );
</script>