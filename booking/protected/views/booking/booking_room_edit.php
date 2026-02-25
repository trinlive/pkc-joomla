<?php
error_reporting(0);
?>

<aside class="right-side">
    <section class="content-header">
        <h1>
            <img src="images/32/booking_edit.png" alt=""/>
            แก้ไขรายการห้องประชุม
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("booking/booking_room"); ?>"> ห้องประชุม</a></li>
            <li class="active">แก้ไขรายการห้องประชุม</li>
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
                                <label class="text-blue">ชื่อห้องประชุม</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                    <?php echo $frm->textField($model1, "booking_room_name", array('class' => 'form-control', 'placeholder' => 'ชื่อห้องประชุม..', 'required' => 'True')); ?>
                                </div>
                                <label class="control-label" style="color: red;"><?php echo $frm->error($model1, 'booking_date_start'); ?></label>
                            </div>

                        </div>
                        <div style="clear: both;"></div><br>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="text-blue">รายละเอียด</label>
                                <div class="input-group">

                                    <?php echo $frm->textArea($model1, "booking_room_detail", array('class' => 'form-control', 'rows' => '3', 'cols' => '130', 'placeholder' => 'กรอกรายละเอียดที่ต้องการ...')); ?>
                                </div>
                                <label class="control-label" style="color: red;"><?php echo $frm->error($model1, 'booking_date_start'); ?></label>
                            </div>

                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">บันทึก</button>
                            <button class="btn btn-warning" type="reset">ล้างข้อมูล</button>
                        </div>

                    </div>
                </div>
            </div>
            <?php echo $frm->hiddenField($model1, 'booking_member', array('class' => 'form-control', 'value' => Yii::app()->session["member_id"])); ?>
            <?php echo $frm->hiddenField($model1, 'booking_status', array('class' => 'form-control', 'value' => "W")); ?>
            <?php $this->endWidget(); ?>
    </section>
</aside>