<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>LOGIN</title>
        <link rel="icon" href="favicon.ico">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <script language="javascript">
            function fncSubmit()
            {
                if (document.form1.txt_password.value != document.form1.txt_password2.value)
                {
                    alert('กรุณากรอก Password ให้ตรงกันอีกครั้ง');
                    document.form1.txt_password2.focus();
                    return false;
                }
                document.form1.submit();
            }
        </script>
        <div class="form-box" id="login-box">
            <div class="header"> <img src="images/logo_32.png" alt=""/> HOS OFFICE</div>

            <?php
            /* $frm = $this->beginWidget('CActiveForm', array(
              'id' => 'post-form',
              'htmlOptions' => array(
              'enctype' => 'multipart/form-data',
              ),
              )); */
            ?>
            <?php echo CHtml::beginForm(array("Member/Create_member"),'post',array('name'=>'form1','OnSubmit'=>'return fncSubmit()')); ?>
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" name="txt_fname" class="form-control" placeholder="Name..." required="True"/>
                    <?php //echo $frm->textField($model1, "member_fname", array('class' => 'form-control', 'placeholder' => 'ชื่อ...', 'required' => 'True')); ?>

                </div>
                <div class="form-group">
                    <input type="text" name="txt_username" class="form-control" placeholder="Username..." required="True"/>
                    <?php //echo $frm->textField($model1, "member_username", array('class' => 'form-control', 'placeholder' => 'Username...', 'required' => 'True')); ?>
                </div>
                <div class="form-group">
                    <input type="password" name="txt_password" class="form-control" placeholder="Password..." required="True"/>
                    <?php //echo $frm->passwordField($model1, "member_password", array('class' => 'form-control', 'placeholder' => 'Password...', 'required' => 'True')); ?>
                </div>
                <div class="form-group">
                    <input type="password" name="txt_password2" class="form-control" placeholder="Password again..." required="True"/>
                    <?php //echo $frm->passwordField($model1, "member_password", array('class' => 'form-control', 'placeholder' => 'Password...', 'required' => 'True')); ?>
                </div>
            </div>
            <div class="footer">
                <button type="submit"  name="Submit" class="btn bg-olive btn-block">Register me</button>
                <a href="<?php echo Yii::app()->createUrl("Member/Login"); ?>" class="text-center">ย้อนกลับสู่หน้าลงชื่อเข้าใช้งาน</a>

            </div>
            <?php echo CHtml::endForm(); ?>
            <?php //$this->endWidget(); ?>

            <!--<div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>-->
            <div class="margin text-center" id="alert">
                <span><b><?php echo Yii::app()->session["txt_create_user"]; ?> </span>
                <span><b><?php echo Yii::app()->session["get_models"]; ?> </span>
            </div>
        </div>


        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setTimeout(function () {
                    $('#alert').remove();
                }, 4000);
            })
        </script>

    </body>
</html>
