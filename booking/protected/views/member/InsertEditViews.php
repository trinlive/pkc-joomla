<aside class="right-side">
    <section class="content-header">
        <h1>
            Profile
            <small>ข้อมูลส่วนตัว</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("Member/InsertUpdate&id=" . Yii::app()->session["member_id"]); ?>">Profile</a></li>
            <li class="active">ข้อมูลส่วนตัว </li>

        </ol>
    </section>

    <div class="tab-pane active" id="tab_1">
        <?php
        $frm = $this->beginWidget('CActiveForm', array(
            'id' => 'post-form',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
        ));
        ?>


        <!-- form start -->
        <?php
        if (Yii::app()->session["member_sex"] == 'M')
        {
            $pic_sex = 'male.png';
        } else
        {
            $pic_sex = 'female.png';
        }
        ?>

        <div class="form-group">
            <div class="col-lg-2">
                <div class="input-group">
                    <img src="images/member_pic/<?php echo $pic_sex; ?>" style="border: solid #434343 1px;">
                    <!--<div class="col-lg-10">
                                                <label>เปลี่ยนรูป</label>
                                                <div class="input-group">
                                                    <input type="file" id="exampleInputFile">
                                                </div>
                                            </div>
                                            <div style="clear: both;"></div>-->
                </div>
            </div>
        </div>

        <div style="clear: both;"></div><br>

        <div class="form-group">
            <div class="col-lg-2">
                <label>คำนำหน้า</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list"></i></span>

                    <?php echo $frm->dropDownList($model, 'member_pname', array('นาย' => 'นาย', 'นาง' => 'นาง', 'นางสาว' => 'นางสาว'), array('class' => 'form-control', 'prompt' => 'เลือกคำนำหน้าชื่อ..')); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <label>ชื่อ</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <?php echo $frm->textField($model, "member_fname", array('class' => 'form-control', 'placeholder' => 'ระบุชื่อ..')); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <label>สกุล</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <?php echo $frm->textField($model, "member_lname", array('class' => 'form-control', 'placeholder' => 'ระบุสกุล..')); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <label>เลขประจำตัวประชาชน</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <?php echo $frm->textField($model, "member_cid", array('class' => 'form-control', 'placeholder' => 'ระบุเลขประจำตัวประชาชน..')); ?>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div><br>

        <div class="form-group">
            <div class="col-lg-2">
                <label>เพศ</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <?php echo $frm->dropDownList($model, 'member_sex', array('M' => 'ชาย', 'F' => 'หญิง'), array('class' => 'form-control', 'prompt' => 'เลือกคำนำหน้าชื่อ..')); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <label>วันเกิด</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                    <?php echo $frm->textField($model, "member_birthday", array('class' => 'form-control dp', 'data-date-format' => 'yyyy-mm-dd')); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <label>ชื่อเล่น</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                    <?php echo $frm->textField($model, "member_nickname", array('class' => 'form-control', 'placeholder' => 'ระบุชื่อเล่น..')); ?>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div><br>

        <div class="form-group">
            <div class="col-lg-4">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <?php echo $frm->textField($model, 'member_email', array('class' => 'form-control', 'prompt' => 'ระบุ Email..')); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <label>เบอร์โทรศัพท์</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                    <?php echo $frm->textField($model, "member_tel", array('class' => 'form-control', 'placeholder' => 'ระบุเบอร์โทรศัพท์')); ?>
                </div>
            </div>

        </div>
        <div style="clear: both;"></div><br>

        <div class="form-group">

            <div class="col-lg-8">
                <label>ที่อยู่</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <?php echo $frm->textField($model, "member_addr", array('class' => 'form-control', 'placeholder' => 'ระบุที่อยู่..')); ?>
                </div>
            </div>
        </div>

        <div style="clear: both;"></div><br>

        <div class="form-group">
            <div class="col-lg-4">
                <label>ฝ่าย</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>

                    <?php
                    echo $frm->dropdownList($model, "group_dep", GroupDepModels::getGroupDep(), array(
                        'class' => 'form-control',
                        'prompt' => 'ฝ่าย..',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => Yii::app()->createUrl('Member/Loaddepartment'), //or $this->createUrl('loadcities') if '$this' extends CController
                            'update' => '#department_id', //or 'success' => 'function(data){...handle the data in the way you want...}',
                            'data' => array('group_dep_id' => 'js:this.value', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken)
                    )));
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <label>หน่วยงาน</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                    <?php echo $frm->dropdownList($model, "department", DepartmentModels::getDepartment(), array('class' => 'form-control', 'id' => 'department_id', 'prompt' => 'เลือกหน่วยงานที่ต้องทบทวน..', 'required' => 'True')); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <label>ตำแหน่ง</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
                    <?php echo $frm->textField($model, "member_position", array('class' => 'form-control', 'placeholder' => 'อื่นๆ ที่ต้องการบันทึกเพิ่มเติม...')); ?>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div><br>

        <div class="form-group">
            <div class="col-lg-8">
                <label>Note</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <?php echo $frm->textArea($model, "member_detail", array('class' => 'form-control', 'placeholder' => 'บันทึกทั่วไป..')); ?>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div><br>

        <div class="form-group">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</aside>
