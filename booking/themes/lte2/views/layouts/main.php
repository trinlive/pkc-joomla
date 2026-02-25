<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Office</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <!--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
        <!-- daterange picker -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- date picker -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index.php?r=site/index" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>B</b>MS</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Booking </b>MS</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- Notifications: style can be found in dropdown.less -->

                            <!-- Tasks: style can be found in dropdown.less -->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                    if (yii::app()->session["member_sex"] == "F")
                                    {
                                        echo '<img src="images/member_pic/female.png" class="user-image" alt="User Image" />';
                                    }
                                    else
                                    {
                                        echo '<img src = "images/member_pic/male.png" class = "user-image" alt = "User Image" />';
                                    }
                                    ?>
                                    <span class="hidden-xs"><?php echo Yii::app()->session["member_username"]; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?php
                                        if (yii::app()->session["member_sex"] == "F")
                                        {

                                            echo '<img src="images/member_pic/female.png" class="img-circle" alt="User Image" />';
                                        }
                                        else
                                        {

                                            echo '<img src = "images/member_pic/male.png" class = "img-circle" alt = "User Image" />';
                                        }
                                        ?>
                                        <p>
                                            <?php echo Yii::app()->session["member_pname"]; ?><?php echo Yii::app()->session["member_fname"]; ?> <?php echo Yii::app()->session["member_lname"]; ?>
                                            <small><?php echo Yii::app()->session["member_position"]; ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="index.php?r=Member/Member_edit&id=<?php echo Yii::app()->session['member_id']; ?>" class="btn btn-default btn-flat">ข้อมูลส่วนตัว</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="index.php?r=Member/Changepassword&id=<?php echo Yii::app()->session['member_id']; ?>" class="btn btn-default btn-flat">เปลี่ยนรหัสผ่าน</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php
                            if (yii::app()->session["member_sex"] == "F")
                            {

                                echo '<img src="images/member_pic/female.png" class="img-circle" alt="User Image" />';
                            }
                            else
                            {

                                echo '<img src = "images/member_pic/male.png" class = "img-circle" alt = "User Image" />';
                            }
                            ?>
                        </div>
                        <div class="pull-left info">
                            <p><?php echo Yii::app()->session["member_username"]; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">เมนูหลัก</li>
                        <li <?php
                        if ($this->id == 'site' && $this->action->id == 'Index')
                        {
                            echo ' class="active"';
                        }
                        ?>>
                            <a href="index.php?r=site/Index">
                            <i class="fa fa-home"></i> <span>หน้าแรก</span><!--<small class="label pull-right bg-green">new</small>--></a>
                        </li>

                        <li class="treeview <?php
                        if ($this->id == 'booking')
                        {
                            echo "active";
                        }
                        ?>">
                            <a href="#">
                                <i class="fa fa-calendar"></i> <span>จองห้องประชุม</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?r=booking/index"><i class="fa fa-circle-o text-purple"></i> จองห้อง</a></li>
                                <?php
                                if ((strpos(Yii::app()->session["member_access"], '[booking_manage]')) or ( strpos(Yii::app()->session["member_access"], '[Admin]')))
                                {
                                    ?>
                                    <li><a href="index.php?r=booking/booking_room"><i class="fa fa-circle-o text-purple"></i> ห้องประชุม</a></li>
                                    <li><a href="index.php?r=booking/report"><i class="fa fa-circle-o text-purple"></i> รายงาน</a></li>

                                    <?php
                                }
                                ?>
                            </ul>
                        </li>

                        <li class="treeview <?php
                        if ($this->id == 'System_setting')
                        {
                            echo "active";
                        }
                        ?>">
                            <a href="#">
                                <i class="fa fa-gears"></i> <span>ตั้งค่าระบบ</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?r=system_setting/member_setting"><i class="fa fa-circle-o text-yellow"></i> ผู้ใช้งานในระบบ</a></li>
                            </ul>
                        </li>

                        <li><a href="index.php?r=Member/Logout"><i class="fa fa-power-off text-red"></i> <span>ออกจากระบบ</span></a></li>


<!--<li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
<li class="header">LABELS</li>
<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->


                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <?php echo $content; ?>


            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.0
                </div>
                <strong>Copyright &copy; <?php echo date("Y"); ?> </strong> 
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class='control-sidebar-menu'>
                            <li>
                                <a href='javascript::;'>
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href='javascript::;'>
                                    <i class="menu-icon fa fa-user bg-yellow"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href='javascript::;'>
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href='javascript::;'>
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class='control-sidebar-menu'>
                            <li>
                                <a href='javascript::;'>
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href='javascript::;'>
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href='javascript::;'>
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-waring pull-right">50%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href='javascript::;'>
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                    </div><!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>
                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked />
                                </label>
                                <p>
                                    Some information about this general settings option
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked />
                                </label>
                                <p>
                                    Other sets of options are available
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked />
                                </label>
                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div><!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked />
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right" />
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div><!-- /.form-group -->
                        </form>
                    </div><!-- /.tab-pane -->
                </div>
            </aside><!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class='control-sidebar-bg'></div>
        </div><!-- ./wrapper -->


        <!-- jQuery 2.1.4 -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- InputMask -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- date-picker -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='<?php echo Yii::app()->theme->baseUrl; ?>/plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/app.min.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/demo.js" type="text/javascript"></script>

        <!-- Page script -->
        <script type="text/javascript">
            $(function () {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('.reservation').daterangepicker({
                    timePicker: false,
                    format: 'YYYY-MM-DD'
                });
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
                    timeFormat: 'h:mm:ss',
                });
                /*$('.dp').datepicker({
                 format: 'yyyy-mm-dd',
                 todayBtn: "linked",
                 language: "th",
                 });*/
                /*$.noConflict();  //Not to conflict with other scripts
                 jQuery(document).ready(function ($) {
                 $(".dp").datepicker({
                 dateFormat: "yy-mm-dd",
                 todayBtn: "linked",
                 language: "th",
                 });
                 $('.dp').on('changeDate', function () {
                 $(this).datepicker('hide');
                 });

                 });*/
                $(".dp").datepicker({
                    dateFormat: "yy-mm-dd",
                    todayBtn: "linked",
                    language: "th",
                });
                $('.dp').on('changeDate', function () {
                    $(this).datepicker('hide');
                });
                $(".dp2").datepicker({
                    dateFormat: "yy-mm-dd",
                    todayBtn: "linked",
                    inline: true,
                    sideBySide: true,
                    language: "th",
                });
            });

        </script>
    </body>
</html>
