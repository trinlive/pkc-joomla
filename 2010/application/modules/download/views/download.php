<?php echo set_breadcrumb(' ',$exclude,$breadcrumb);?>
<div class="box_news_main_news">
    <div class="main_content_green_long"><?php echo 'ดาวน์โหลด';?></div>
    <div class="clearfix"></div>
    <table class="table">
        <tbody>
        <tr>
            <td><strong>หัวข้อ</strong> </td>
            <td><?php echo isset($rs_download['title'])? $rs_download['title']:'';?></td>
        </tr>
        <tr>
            <td><strong>ไฟล์</strong></td>
            <td>
                <table name="tb1" id="tb1">
                    <tbody>
                    <?php if(isset($rs_download_item)):?>
                        <?php foreach ($rs_download_item as $key=>$rs_item):?>
                            <tr>
                                <td>
                                    <img src="<?php echo site_assets_url('layouts/frontend/images/icon/i'.checkfile($rs_item['url']).'.gif');?>">
                                    <a href="<?php echo site_assets_url('images/download/'.$rs_item['url'])?>"><?php echo $rs_item['title'];?></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="clearfix"></div>

</div>