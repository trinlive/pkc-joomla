<aside class="right-side">
    <section class="content-header">
        <h1>
            <img src="images/32/id_card.png" alt=""/> 
            Profile
            <small>ข้อมูลส่วนตัว</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("Member/Member_edit&id=" . Yii::app()->session["member_id"]); ?>">Profile</a></li>
            <li class="active">ข้อมูลส่วนตัว </li>
            <!--<li class="active">อุบัติการณ์ด้านการรักษา </li>-->
        </ol>
    </section>

    <?php
    $frm = $this->beginWidget('CActiveForm', array(
        'id' => 'post-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    ));
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <?php
                if (Yii::app()->session["txt_edit_profile"] == 'ok')
                {
                    ?>
                    <div class="alert alert-success alert-dismissable"  id="alert">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        แก้ไขข้อมูลส่วนตัวของคุณเรียบร้อยแล้ว
                    </div>
                    <?php
                } else if (Yii::app()->session["txt_edit_profile"] == 'no')
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable"  id="alert">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        ข้อมูลส่วนตัวของคุณยังไม่ถูกเปลี่ยน
                    </div>
                    <?php
                }
                ?>

                <div class="box-body">
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label style="color: #060;">คำนำหน้าชื่อ</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <?php echo $frm->dropDownList($model, "member_pname", array('นาย' => 'นาย', 'นาง' => 'นาง', 'นางสาว' => 'นางสาว'), array('class' => 'form-control')); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label style="color: #060;">ชื่อ</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <?php echo $frm->textField($model, "member_fname", array('class' => 'form-control', 'placeholder' => 'ชื่อ..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label style="color: #060;">นามสกุล</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <?php echo $frm->textField($model, "member_lname", array('class' => 'form-control', 'placeholder' => 'นามสกุล..')); ?>
                            </div>
                        </div>
                    </div>      
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">วันเกิด</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php echo $frm->textField($model, "member_birthday", array('class' => 'form-control dp', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'เลือกวันเกิด..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="radio">
                                    <label>
                                        <?php echo $frm->radioButton($model, 'member_sex', array('value' => 'M', 'uncheckValue' => null)); ?>
                                        เพศชาย
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php echo $frm->radioButton($model, 'member_sex', array('value' => 'F', 'uncheckValue' => null)); ?>
                                        เพศหญิง
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">หน่วยงาน</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <?php echo $frm->dropdownList($model, "department", DepartmentModels::getDepartmentname(), array('class' => 'form-control', 'prompt' => 'เลือกหน่วยงาน..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label style="color: #060;">ตำแหน่ง</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <?php echo $frm->textField($model, "member_position", array('class' => 'form-control', 'placeholder' => 'ตำแหน่ง..')); ?>
                            </div>
                        </div>                           
                    </div>      
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">ชื่อเล่น</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <?php echo $frm->textField($model, "member_nickname", array('class' => 'form-control', 'placeholder' => 'ชื่อเล่น..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label style="color: #060;">อีเมลล์</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <?php echo $frm->textField($model, "member_email", array('class' => 'form-control', 'placeholder' => 'อีเมลล์..')); ?>
                            </div>
                        </div>                           
                    </div>      
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">เลขประจำตัวประชาชน</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                <?php echo $frm->textField($model, "member_cid", array('class' => 'form-control', 'placeholder' => 'เลขประจำตัวประชาชน..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label style="color: #060;">หมายเลขโทรศัพท์</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                <?php echo $frm->textField($model, "member_tel", array('class' => 'form-control', 'placeholder' => 'หมายเลขโทรศัพท์..')); ?>
                            </div>
                        </div>                           
                    </div>      
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label style="color: #060;">ที่อยู่</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <?php echo $frm->textField($model, "member_address", array('class' => 'form-control', 'placeholder' => 'ที่อยู่..')); ?>
                            </div>
                        </div>
                    </div>      
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label style="color: #060;">Note..</label>
                            <div class="input-group">

                                <?php echo $frm->textArea($model, "member_detail", array('class' => 'form-control', 'rows' => '5', 'cols' => '130', 'placeholder' => 'บันทึกทั่วไป...')); ?>
                            </div>
                        </div>
                    </div>      
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <button class="btn btn-primary" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php $this->endWidget(); ?>

</aside>
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('#alert').remove();
        }, 4000);
    })
</script>