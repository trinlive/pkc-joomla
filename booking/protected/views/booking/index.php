<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <img src="images/32/booking.png" alt=""/> จองห้องประชุม
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> หน้าแรก</a></li>
            <li class="active">จองห้องประชุม</li>
        </ol>
    </section>
    <!-- end Content Header (Page header) -->
    <section class="content">

        <?php echo CHtml::form(array('class' => 'form-inline')); ?>
        <div class="form-group">
            <div class="col-sm-3">
                <?php
                echo CHtml::dropDownList('get_room', '', Booking_roomModels::getBookingroomname(), array('id' => 'get_room',
                    'class' => 'form-control',
                    'prompt' => "เลือกห้องประชุม.."));
                ?>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ค้นหา</button>

        </div>
        <?php
        echo CHtml::endForm();
        ?>

        <a href="<?php echo Yii::app()->createUrl("booking/booking_create"); ?>">
            <button type="button" class="btn btn-success btn-sm" style="float: left;"> จองห้อง</button>
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
                    'value' => '$data->join_booking_room->booking_room_name',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '20%'
                    )
                ),
                array(
                    'header' => 'วัน-เวลาเริ่ม',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => 'setDateTh(Yii::app()->dateFormatter->formatDateTime(($data->booking_date_end),"long",""))'
                    . ' ." ".$data->booking_time_end',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '15%'
                    )
                ),
                array(
                    'header' => 'วัน-เวลาสิ้นสุด',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => 'setDateTh(Yii::app()->dateFormatter->formatDateTime(($data->booking_date_end),"long",""))'
                    . ' ." ".$data->booking_time_end',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '15%'
                    )
                ),
                array(
                    'header' => 'หัวข้อ',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => '$data->booking_subject',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '35%'
                    )
                ),
                array(
                    'header' => 'สถานะ',
                    'type' => 'raw',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:center;color:#06c;font-size:14px;'
                    ),
                    'value' => '($data->booking_status=="W")?("<span class=\"label label-warning\">รอตรวจ</span>"):((($data->booking_status=="Y")?("<span class=\"label label-success\">อนุมัติ</span>"):("<span class=\"label label-danger\">ไม่อนุมัติ</span>")))',
                    'htmlOptions' => array(
                        'style' => 'text-align:center;color:#333;font-size:14px;',
                        'width' => '10%'
                    )
                ),
                array(
                    'header' => 'View',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:center;color:#06c;font-size:14px;'
                    ),
                    'class' => 'CLinkColumn',
                    'imageUrl' => 'images/24/search_page.png',
                    'urlExpression' => 'Yii::app()->createUrl("/booking/booking_view", array("id" =>$data->booking_id ))',
                    //'linkHtmlOptions' => array('target' => '_blank'),
                    'htmlOptions' => array(
                        'width' => '5%',
                        'align' => 'center'
                    )
                )
            )
        ));
        ?>
    </section>


</aside>
