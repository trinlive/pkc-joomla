<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <img src="images/other/booking_room.png" alt=""/> ห้องประชุม
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> หน้าแรก</a></li>
            <li class="active">ห้องประชุม</li>
        </ol>
    </section>
    <!-- end Content Header (Page header) -->
    <section class="content">


        <a href="<?php echo Yii::app()->createUrl("booking/booking_room_create"); ?>">
            <button type="button" class="btn btn-success btn-sm" style="float: left;"> เพิ่มห้อง</button>
        </a><br>


        <?php
        $today = date("Y-m-d");

        function setDateTh($date)
        {
            //$temp = strtr($date, substr($date, -4), (substr($date, -4) + 543));
            $temp = str_replace(substr($date, -4), (substr($date, -4) + 543), $date);
            $temp = str_replace('ค.ศ.', 'พ.ศ.', $temp);
            return $temp;
        }

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'user-grid',
            'summaryText' => '', // ซ่อนการแสดง show result
            'dataProvider' => $provider,
            'selectableRows' => 2, //เลือกได้หลายรายการพร้อมกัน
            //'pagerCssClass' => '',
            'itemsCssClass' => 'table table-condensed',
            'pager' => array(
                //'class' => 'CLinkPager',
                'cssFile' => false,
                'selectedPageCssClass' => 'active',
                'hiddenPageCssClass' => 'disabled',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination pagination-sm no-margin pull-right'),
            ),
            'columns' => array(
                array(
                    'header' => 'ห้อง',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => '$data->booking_room_name',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '25%'
                    )
                ),
                array(
                    'header' => 'รายละเอียด',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => '$data->booking_room_detail',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '70%'
                    )
                ),
                array(
                    'header' => 'View',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:center;color:#06c;font-size:14px;'
                    ),
                    'class' => 'CLinkColumn',
                    'imageUrl' => 'images/24/search_page.png',
                    'urlExpression' => 'Yii::app()->createUrl("/booking/booking_room_edit", array("id" =>$data->booking_room_id ))',
                    //'linkHtmlOptions' => array('target' => '_blank'),
                    'htmlOptions' => array(
                        'width' => '5%',
                        'align' => 'center'
                    )
                ),
            )
        ));
        ?>
    </section>


</aside>
