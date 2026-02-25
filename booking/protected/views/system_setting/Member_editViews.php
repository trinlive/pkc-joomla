<aside class="right-side">
    <section class="content-header">
        <h1>
            <img src="images/32/edit.png" alt=""/> แก้ไขผู้ใช้งานในระบบ
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("system_setting/member_setting"); ?>">ผู้ใช้งานในระบบ</a></li>
            <li class="active">แก้ไขผู้ใช้งานในระบบ </li>
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
                if (Yii::app()->session["txt_member_edit"] == 'ok')
                {
                    ?>
                    <div class="alert alert-success alert-dismissable"  id="alert">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        แก้ไขข้อมูลเรียบร้อยแล้ว
                    </div>
                    <?php
                    unset(Yii::app()->session["txt_member_edit"]);
                }
                else if (Yii::app()->session["txt_member_edit"] == 'no')
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
                            <a class="btn btn-success" data-toggle="modal" data-target="#access-modal">
                                <i class="fa fa-key"></i> สิทธิการใช้งาน</a>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-4">
                            <label style="color: #060;">คำนำหน้าชื่อ</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <?php echo $frm->dropDownList($model1, "member_pname", array('นาย' => 'นาย', 'นาง' => 'นาง', 'นางสาว' => 'นางสาว'), array('class' => 'form-control', 'required' => 'True')); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label style="color: #060;">ชื่อ</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <?php echo $frm->textField($model1, "member_fname", array('class' => 'form-control', 'placeholder' => 'ชื่อ..', 'required' => 'True')); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label style="color: #060;">นามสกุล</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <?php echo $frm->textField($model1, "member_lname", array('class' => 'form-control', 'placeholder' => 'นามสกุล..')); ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <!--<div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">เจ้าหน้าที่ในโรงพยาบาล</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <?php //echo $frm->textField($model1, "staff", array('class' => 'form-control', 'placeholder' => 'เลือกเจ้าหน้าที่ในโรงพยาบาล..')); ?>

                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>-->

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">วันเกิด</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php echo $frm->textField($model1, "member_birthday", array('class' => 'form-control dp', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'เลือกวันเกิด..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="radio">
                                    <label>
                                        <?php echo $frm->radioButton($model1, 'member_sex', array('value' => 'M', 'uncheckValue' => null)); ?>
                                        เพศชาย
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php echo $frm->radioButton($model1, 'member_sex', array('value' => 'F', 'uncheckValue' => null)); ?>
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
                                <?php echo $frm->dropdownList($model1, "department", DepartmentModels::getDepartmentname(), array('class' => 'form-control', 'prompt' => 'เลือกหน่วยงาน..', 'required' => 'True')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label style="color: #060;">ตำแหน่ง</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <?php echo $frm->textField($model1, "member_position", array('class' => 'form-control', 'placeholder' => 'ตำแหน่ง..')); ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">ชื่อเล่น</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <?php echo $frm->textField($model1, "member_nickname", array('class' => 'form-control', 'placeholder' => 'ชื่อเล่น..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label style="color: #060;">อีเมลล์</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <?php echo $frm->textField($model1, "member_email", array('class' => 'form-control', 'placeholder' => 'อีเมลล์..')); ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label style="color: #060;">เลขประจำตัวประชาชน</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                <?php echo $frm->textField($model1, "member_cid", array('class' => 'form-control', 'placeholder' => 'เลขประจำตัวประชาชน..')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label style="color: #060;">หมายเลขโทรศัพท์</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php echo $frm->textField($model1, "member_tel", array('class' => 'form-control', 'placeholder' => 'หมายเลขโทรศัพท์..')); ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label style="color: #060;">ที่อยู่</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <?php echo $frm->textField($model1, "member_address", array('class' => 'form-control', 'placeholder' => 'ที่อยู่..')); ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label style="color: #060;">Note..</label>
                            <div class="input-group">

                                <?php echo $frm->textArea($model1, "member_detail", array('class' => 'form-control', 'rows' => '5', 'cols' => '130', 'placeholder' => 'บันทึกทั่วไป...')); ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label style="color: #060;">สถานะการใช้งาน</label>
                            <div class="input-group">

                                <?php echo $frm->dropDownList($model1, "member_status", array('Y' => 'ใช้งาน', 'N' => 'ยกเลิกการใช้งาน'), array('class' => 'form-control', 'required' => 'True')); ?>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div><br>

                    <div class="form-group">
                        <div class="col-lg-4">
                            <button class="btn btn-primary" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ACCESS MODAL -->
    <div class="modal fade" id="access-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="height: 300px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-key"></i> สิทธิ์การใช้งาน</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <?php
                        $check_access = Yii::app()->db->createCommand('select member_access from member where member_id="' . $_GET["id"] . '"')->queryScalar();
                        foreach ($model2 as $m2):
                            ?>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="checkbox" name="txt_access_menu[]" value="<?php echo $m2->access_menu_name; ?>" <?php
                                    if (strpos($check_access, $m2->access_menu_name))
                                    {
                                        echo 'checked';
                                    }
                                    ?>> <span><?php echo $m2->access_menu_name; ?></span>

                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.ACCESS Modal -->

    <?php $this->endWidget(); ?>

</aside>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('#alert').remove();
        }, 4000);
    })
</script>