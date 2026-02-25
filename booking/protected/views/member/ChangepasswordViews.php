<script language="javascript">
    function fncSubmit()
    {
        if (document.form1.txt_new_password1.value != document.form1.txt_new_password2.value)
        {
            alert('กรุณากรอก Password ให้ตรงกันอีกครั้ง');
            document.form1.txt_new_password2.focus();
            return false;
        }
        document.form1.submit();
    }
</script>
<aside class="right-side">
    <section class="content-header">
        <h1>
            <img src="images/32/lock.png" alt=""/>
            Profile
            <small>เปลี่ยนรหัสผ่าน</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("Member/Member_edit&id=" . Yii::app()->session["member_id"]); ?>">Profile</a></li>
            <li class="active">เปลี่ยนรหัสผ่าน </li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <?php
                if (Yii::app()->session["txt_change_password_ok"] == 'ok')
                {
                    ?>
                    <div class="alert alert-success alert-dismissable"  id="alert">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        รหัสผ่านของคุณถูกเปลี่ยนเรียบร้อยแล้ว
                    </div>
                    <?php
                    unset(Yii::app()->session["txt_change_password_ok"]);
                }
                else if (Yii::app()->session["txt_change_password_ok"] == 'no')
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable" id="alert">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        รหัสผ่านของคุณยังไม่ได้ถูกเปลี่ยน
                    </div>
                    <?php
                }
                ?>

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'post-form',
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                    ),
                ));
                ?>
            </div>
            <div class="form-group">
                <div class="col-lg-4">
                    <?php echo $form->labelEx($model, 'old_password'); ?>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <?php echo $form->passwordField($model, "old_password", array('class' => 'form-control', 'placeholder' => 'รหัสผ่านเดิม..')); ?>
                    </div>
                    <label class="control-label" style="color: red;"><?php echo $form->error($model, 'old_password'); ?></label>
                </div>
            </div>
            <div style="clear: both;"></div><br>

            <div class="form-group">
                <div class="col-lg-4">
                    <?php echo $form->labelEx($model, 'new_password'); ?>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <?php echo $form->passwordField($model, "new_password", array('class' => 'form-control', 'placeholder' => 'รหัสผ่านใหม่..')); ?>
                    </div>
                    <label class="control-label" style="color: red;"><?php echo $form->error($model, 'new_password'); ?></label>
                </div>
            </div>
            <div style="clear: both;"></div><br>

            <div class="form-group">
                <div class="col-lg-4">
                    <?php echo $form->labelEx($model, 'repeat_password'); ?>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <?php echo $form->passwordField($model, "repeat_password", array('class' => 'form-control', 'placeholder' => 'ยืนยันรหัสผ่านใหม่..')); ?>
                    </div>
                    <label class="control-label" style="color: red;"><?php echo $form->error($model, 'repeat_password'); ?></label>
                </div>
            </div>
            <div style="clear: both;"></div><br>

            <div class="form-group">
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">ตกลง</button>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </section>
</aside>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('#alert').remove();
        }, 4000);
    })
</script>