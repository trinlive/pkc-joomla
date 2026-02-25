<?php
error_reporting(0);
?>

<aside class="right-side">
    <section class="content-header">
        <h1>
            <img src="images/32/booking.png" alt=""/>
            รายการจองห้องประชุม
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("booking/index"); ?>"> จองห้องประชุม</a></li>
            <li class="active">รายการจองห้องประชุม</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <?php
            $frm = $this->beginWidget('CActiveForm', array(
                'id' => 'post-form',
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                ),
            ));
            ?>
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-body">

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="text-blue">ห้องประชุม</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_room_id", Booking_roomModels::getBookingroomname(), array('class' => 'form-control', 'prompt' => 'เลือกห้องประชุม..', 'required' => 'True')); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-blue">ประเภทการประชุม</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_type_id", Booking_typeModels::getBookingtypename(), array('class' => 'form-control', 'prompt' => 'เลือกประเภทการประชุม..', 'required' => 'True')); ?>
                                </div>
                            </div>

                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="text-blue">วันที่เริ่ม</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <?php echo $frm->textField($model1, "booking_date_start", array('class' => 'form-control dp', 'placeholder' => 'เลือกวันที่เริ่ม..', 'data-date-format' => 'yyyy-mm-dd', 'required' => 'True')); ?>
                                </div>
                                <label class="control-label" style="color: red;"><?php echo $frm->error($model1, 'booking_date_start'); ?></label>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-blue">เวลาเริ่ม</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_time_start", CHtml::listData(Booking_timeModels::model()->findAll(), 'time', 'time'), array('class' => 'form-control', 'placeholder' => 'เลือกเวลาเสร็จสิ้น..', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="text-blue">วันที่เสร็จสิ้น</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <?php echo $frm->textField($model1, "booking_date_end", array('class' => 'form-control dp', 'placeholder' => 'เลือกวันที่เสร็จสิ้น..', 'data-date-format' => 'yyyy-mm-dd', 'required' => 'True')); ?>
                                </div>
                                <label class="control-label" style="color: red;"><?php echo $frm->error($model1, 'booking_date_end'); ?></label>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-blue">เวลาเสร็จสิ้น</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_time_end", CHtml::listData(Booking_timeModels::model()->findAll(), 'time', 'time'), array('class' => 'form-control', 'placeholder' => 'เลือกเวลาเสร็จสิ้น..', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-10">
                                <label class="text-blue">หัวข้อการประชุม</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                    <?php echo $frm->textField($model1, "booking_subject", array('class' => 'form-control', 'placeholder' => 'หัวข้อการประชุม..', 'required' => 'True')); ?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label class="text-blue">จำนวนผู้เข้าร่วม</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                    <?php echo $frm->textField($model1, "booking_qty", array('class' => 'form-control', 'placeholder' => 'จำนวน..', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-10">
                                <label class="text-blue">รายละเอียด</label>
                                <div class="input-group">

                                    <?php echo $frm->textArea($model1, "booking_detail", array('class' => 'form-control', 'rows' => '3', 'cols' => '130', 'placeholder' => 'กรอกรายละเอียดที่ต้องการ...')); ?>
                                </div>
                            </div>

                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="text-blue">หน่วยงานที่ขอ</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_department", DepartmentModels::getDepartmentname(), array('class' => 'form-control', 'placeholder' => 'เลือกหน่วยงาน..', 'required' => 'True')); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-blue">รูปแบบการจัดโต๊ะ</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_table_type_id", Booking_table_typeModels::getBookingtabletypename(), array('class' => 'form-control', 'placeholder' => 'เลือกประเภท..', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="text-blue">สิ่งที่ต้องการ</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-glass"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_manage_type_id", Booking_manage_typeModels::getBookingmanagetypename(), array('class' => 'form-control', 'placeholder' => 'เลือกสิ่งที่ต้องการ..', 'required' => 'True')); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-blue">ประเภทงบประมาณ</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bitcoin"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_budget_id", Booking_budgetModels::getBookingbudgetname(), array('class' => 'form-control', 'placeholder' => 'เลือกประเภท..', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="text-blue">อุปกรณ์ที่ใช้</label>
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'notebook', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            คอมพิวเตอร์ Notebook
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'visualizer', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            เครื่องฉายแผ่นทึบ Visualizer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'projector', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            เครื่องฉาย LCD Projecter
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="text-blue">&nbsp;</label>
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'led_tv', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            โทรทัศน์สี LED TV
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'mic1', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            ไมโครโฟนแบบตั้งโต๊ะ
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'mic2', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            ไมโครโฟนแบบไร้สาย
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="text-blue">&nbsp;</label>
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'sound_record', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            เครื่องบันทึกเสียง
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'vdo_record', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            กล้องบันทึกวีดีโอ
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <?php echo $frm->checkBox($model1, 'photo_record', array('value' => 'Y', 'uncheckValue' => 'N')); ?>
                                            กล้องถ่ายภาพ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both"></div><br>

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="text-orange">การยืนยัน</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square-o"></i></span>
                                    <?php echo $frm->dropdownList($model1, "booking_status", array('W' => 'รออนุมัติ', 'Y' => 'อนุมัติแล้ว', 'N' => 'ไม่อนุมัติ'), array('class' => 'form-control', 'placeholder' => 'เลือกสิ่งที่ต้องการ..', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <?php
                            if ((strpos(Yii::app()->session["member_access"], '[[booking_manage]]')) or ( strpos(Yii::app()->session["member_access"], '[Admin]')))
                            {
                                echo '<button class="btn btn-primary" type="submit">ตกลง</button>';
                            }
                            ?>

                            <a href="<?php echo Yii::app()->createUrl("booking/index"); ?>" class="btn btn-success"><i class="fa fa-reply"></i> Back</a>
                        </div>

                    </div>
                </div>
            </div>
            <?php //echo $frm->hiddenField($model1, 'booking_member', array('class' => 'form-control', 'value' => Yii::app()->session["member_id"])); ?>
            <?php //echo $frm->hiddenField($model1, 'booking_status', array('class' => 'form-control', 'value' => "W")); ?>
            <?php $this->endWidget(); ?>
    </section>
</aside>