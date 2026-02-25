<aside class="right-side">
    <section class="content-header">
        <h1>
            Profile
            <small>เปลี่ยนรหัสผ่าน</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("Member/InsertUpdate&id=" . Yii::app()->session["member_id"]); ?>">Profile</a></li>
            <li class="active">เปลี่ยนรหัสผ่าน </li>

        </ol>
    </section>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'chnage-password-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <div class="form-group">
        <div class="col-lg-4">
            <?php echo $form->labelEx($model, 'old_password'); ?>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                <?php echo $form->passwordField($model, "old_password", array('class' => 'form-control', 'placeholder' => 'รหัสผ่านเดิม..')); ?> 
                <?php echo $form->error($model, 'old_password'); ?>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div><br>

    <div class="form-group">
        <div class="col-lg-4">
            <?php echo $form->labelEx($model, 'new_password'); ?> 
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                <?php echo $form->passwordField($model, "new_password", array('class' => 'form-control', 'placeholder' => 'รหัสผ่านใหม่..')); ?> 
                <?php echo $form->error($model, 'new_password'); ?> 
            </div>
        </div>
    </div>
    <div style="clear: both;"></div><br>

    <div class="form-group">
        <div class="col-lg-4">
            <?php echo $form->labelEx($model, 'repeat_password'); ?> 
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                <?php echo $form->passwordField($model, "repeat_password", array('class' => 'form-control', 'placeholder' => 'ยืนยันรหัสผ่านใหม่..')); ?> 
                <?php echo $form->error($model, 'repeat_password'); ?>

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
</aside>
