<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <img src="images/32/businessman_woman.png" alt=""/> ผู้ใช้งานในระบบ
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> หน้าแรก</a></li>
            <li class="active">ผู้ใช้งานในระบบ </li>
        </ol>
    </section>
    <!-- end Content Header (Page header) -->
    <section class="content">

        <?php echo CHtml::form(array('class' => 'form-inline')); ?>
        <div class="form-group">
            <div class="col-sm-4">
                <?php
                echo CHtml::textField('get_fname', '', array('id' => 'get_fname',
                    'class' => 'form-control',
                    'placeholder' => "ค้นหาชื่อ.."));
                ?>
            </div>

            <div class="col-sm-4">
                <?php
                $select_memberdep = CHtml::listData(DepartmentModels::model()->findall(), 'department_id', 'name');
                echo CHtml::dropDownList('get_department', '', $select_memberdep, array('id' => 'get_status', 'class' => 'form-control', 'prompt' => "หน่วยงานทั้งหมด"));
                ?>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ค้นหา</button>
        </div>
        <?php
        echo CHtml::endForm();
        ?>

        <a href="<?php echo Yii::app()->createUrl("system_setting/member_create"); ?>">
            <button type="button" class="btn btn-success btn-sm" style="float: left;"> เพิ่มผู้ใช้งาน</button>
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
                /* array(
                  'header' => 'ลำดับ',
                  'headerHtmlOptions' => array(
                  'style' => 'text-align:left;color:#06c;font-size:14px;'
                  ),
                  'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                  'htmlOptions' => array(
                  'style' => 'text-align:center;color:#333;font-size:14px;',
                  'width' => '5%'
                  )
                  ), */
                array(
                    'header' => 'ชื่อ',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => '$data->member_pname."".$data->member_fname." ".$data->member_lname',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '30%'
                    )
                ),
                array(
                    'header' => 'หน่วยงาน',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => '$data->join_department->name',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '30%'
                    )
                ),
                array(
                    'header' => 'ตำแหน่ง',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:left;color:#06c;font-size:14px;'
                    ),
                    'value' => '$data->member_position',
                    'htmlOptions' => array(
                        'style' => 'text-align:left;color:#333;font-size:14px;',
                        'width' => '20%'
                    )
                ),
                array(
                    'header' => 'สถานะ',
                    'type' => 'raw',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:center;color:#06c;font-size:14px;'
                    ),
                    'value' => '($data->member_status=="Y")?("<span class=\"label label-success\">ใช้งานได้</span>"):("<span class=\"label label-danger\">ยกเลิก</span>")',
                    'htmlOptions' => array(
                        'style' => 'text-align:center;color:#333;font-size:14px;',
                        'width' => '10%'
                    )
                ),
                array(
                    'header' => 'แก้ไข',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align:center;color:#06c;font-size:14px;'
                    ),
                    'class' => 'CLinkColumn',
                    'imageUrl' => 'images/24/edit.png',
                    'urlExpression' => 'Yii::app()->createUrl("/System_setting/Member_edit", array("id" =>$data->member_id ))',
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

