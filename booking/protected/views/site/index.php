<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <img src="images/32/home.png" alt=""/>
            Home
            <small>หน้าหลัก</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <!--<li class="active">Dashboard</li>-->
        </ol>
    </section>
    <!-- end Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo date("D d"); ?>
                        </h3>
                        <p>
                            <?php echo date("M H:i A"); ?>
                        </p>
                        <p> &nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Time Today <!--<i class="fa fa-arrow-circle-right"></i>-->
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                            echo Yii::app()->db->createCommand('select count(*)as a from booking where booking_date_start="' . date("Y-m-d") . '"')->queryScalar() . " User";
                            ?>
                        </h3>
                        <p>
                            <?php
                            echo "Booking " . Yii::app()->db->createCommand('select weather from weather order by date desc limit 1')->queryScalar() . " User";
                            ?>
                        </p>
                        <p>
                            &nbsp;
                        </p>

                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Booking Today
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                            $bytes = disk_free_space(".");
                            $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
                            $base = 1024;
                            $class = min((int) log($bytes, $base), count($si_prefix) - 1);
                            //echo $bytes . '<br />';
                            echo sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . '<br />';
                            ?>
                        </h3>
                        <p>
                            of
                            <?php
                            $bytes = disk_total_space(".");
                            $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
                            $base = 1024;
                            $class = min((int) log($bytes, $base), count($si_prefix) - 1);
                            //echo $bytes . '<br />';
                            echo sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . '<br />';
                            ?>
                        </p>
                        <p> &nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-database"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Database Free Space
                    </a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                            $check_usage = Yii::app()->db->createCommand('select count(distinct user)as a from counter where date="' . date("Y-m-d") . '" and user = "' . Yii::app()->session["member_id"] . '"')->queryScalar();
                            if ($check_usage == 0)
                            {
                                Yii::app()->db->createCommand('insert into counter (id,date,ip,user) values (NULL,"' . date("Y-m-d") . '","' . $_SERVER["REMOTE_ADDR"] . '","' . Yii::app()->session["member_id"] . '")')->query();
                            }

                            echo Yii::app()->db->createCommand('select count(distinct user)as a from counter where date="' . date("Y-m-d") . '"')->queryScalar();
                            ?> Users
                        </h3>
                        <p>
                            Total
                            <?php echo Yii::app()->db->createCommand('select count(*)as a from member')->queryScalar();
                            ?> Users
                        </p>
                        <p> &nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Usage Statistics
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">

                <!-- Custom tabs (Charts with tabs)-->
                <!--<div class="nav-tabs-custom">

                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                        <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                    </ul>
                    <div class="tab-content no-padding">

                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                    </div>
                </div><!-- /.nav-tabs-custom -->

                <!-- Chat box -->
                <div class="box box-success">
                    <div class="box-header">
                        <br>
                        <h3 class="box-title text-blue"> <img src="images/32/news.png" alt=""/> กระดานข่าว <img src="images/gif/line5.gif" alt=""/></h3>
                        <div class="box-tools pull-right" data-toggle="tooltip" title="เพิ่มข่าว">
                            <a href="<?php echo Yii::app()->createUrl("Site/create_news"); ?>" class="btn btn-success btn-xs">เพิ่ม</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <ul class = "products-list product-list-in-box">
                            <?php

                            function setDateTh($date)
                            {
                                //$temp = strtr($date, substr($date, -4), (substr($date, -4) + 543));
                                $temp = str_replace(substr($date, -4), (substr($date, -4) + 543), $date);
                                $temp = str_replace('ค.ศ.', 'พ.ศ.', $temp);
                                return $temp;
                            }

                            $result = Yii::app()->db->createCommand('select * from news order by date desc,time desc limit 7')->queryAll();
                            foreach ($result as $res)
                            {
                                if ($res["date"] < date("Y-m-d"))
                                {
                                    $txt_day = '<span class = "label label-primary pull-right">ข่าวเก่า</span>';
                                }
                                else
                                {
                                    $txt_day = '<span class = "label label-danger pull-right">ข่าวใหม่</span>';
                                }
                                ?>
                                <li class = "item">
                                    <div class = "product-img">
                                        <img src="images/news_pic/icon_news5.png" alt=""/>
                                    </div>
                                    <div class = "product-info">
                                        <a href = "#myModal" data-toggle="modal" data-target="#edit-modal<?php echo $res["id"]; ?>" class = "product-title"><?php echo $res["news_head"]; ?><?php echo $txt_day; ?></a>
                                        <span class = "product-description"> <?php echo $res["news_detail"]; ?> </span>
                                        <span class = "product-description text-yellow"> <?php echo setDateTh(Yii::app()->dateFormatter->formatDateTime(($res["date"]), "long", "")); ?> </span>
                                    </div>
                                </li>

                                <div id="edit-modal<?php echo $res["id"]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title"><?php echo $res["news_head"]; ?></h4>
                                            </div>
                                            <div class="modal-body edit-content">
                                                <?php echo $res["news_detail"]; ?>
                                            </div>
                                            <div class="modal-body edit-content">
                                                <?php
                                                echo CHtml::link($res["news_file"], Yii::app()->baseUrl . '/uploads/' . $res["load_file"], array('target' => '_blank'));
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div><!-- /.box (chat box) -->
            </section><!-- /.Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">
                <div class="box box-warning">
                    <div class="box-header">
                        <!--<h3 class="box-title">&nbsp;</h3>-->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!--<ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target = "#carousel-example-generic" data-slide-to = "1" class = ""></li>
                            <li data-target = "#carousel-example-generic" data-slide-to = "2" class = ""></li>
                            </ol> -->
                            <div class = "carousel-inner">
                                <div class = "item active">

                                    <img src = " " alt = "1 slide"/>
                                    <div class = "carousel-caption">

                                    </div>
                                </div>
                                <div class = "item">
                                    <img src = " " alt = "2 slide"/>
                                    <div class = "carousel-caption">

                                    </div>
                                </div>
                                <div class = "item">
                                    <img src = " " alt = "3 slide"/>
                                    <div class = "carousel-caption">

                                    </div>
                                </div>
                            </div>
                            <!--<a class = "left carousel-control" href = "#carousel-example-generic" data-slide = "prev">
                            <span class = "glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class = "right carousel-control" href = "#carousel-example-generic" data-slide = "next">
                            <span class = "glyphicon glyphicon-chevron-right"></span>
                            </a> -->

                        </div>
                    </div><!--/.box-body -->

                </div><!--/.box -->
            </section><!--/.col -->
        </div><!--/.row (main row) -->
    </section><!--/.content -->
</aside><!--/.right-side -->



<script>
    $('#edit-modal').on('show.bs.modal', function (e) {

        var $modal = $(this),
                esseyId = e.relatedTarget.id;

        $.ajax({
            cache: false,
            type: 'POST',
            url: 'backend.php',
            data: 'EID=' + essayId,
            success: function (data) {
                $modal.find('.edit-content').html(data);
            }
        });
    })
</script>