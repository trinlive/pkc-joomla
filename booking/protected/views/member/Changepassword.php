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

    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <label class="control-label" style="color: green;"><i class="fa fa-check"></i> 
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php
            Yii::app()->clientScript->registerScript(
                    'myHideEffect', '$(".control-label").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
            );
            ?>
        </label>

    <?php endif; ?>

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
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</aside>
