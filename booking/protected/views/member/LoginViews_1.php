
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
        <div class="form-box" id="login-box">
            <div class="header"> <img src="images/logo_32.png" alt=""/> HOS OFFICE</div>



            <?php echo CHtml::form(array("Member/LoginCheck")); ?>
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" name="txt_username" class="form-control" placeholder="Username..."/>
                </div>
                <div class="form-group">
                    <input type="password" name="txt_password" class="form-control" placeholder="Password..."/>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember_me"/> Remember me
                </div>
            </div>
            <div class="footer">
                <button type="submit" class="btn bg-olive btn-block">Sign me in</button>

                <!--<p><a href="#">I forgot my password</a></p>-->

                <a href="index.php?r=Member/Create_member" class="text-center">ลงทะเบียนผู้ใช้งานใหม่</a>
            </div>
            <?php echo CHtml::endForm(); ?>

            <div class="margin text-center" id="alert">
                <span><?php echo Yii::app()->session["txt_check_login"];?></span>
                <!--<br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>-->

            </div>

        </div>

        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $('#alert').remove();
            }, 4000);
        })
    </script>
</html>
