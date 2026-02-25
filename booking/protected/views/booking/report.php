<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <img src="images/32/chart.png" alt=""/>
                รายงานห้องประชุม
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">รายงานห้องประชุม</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                        </div>
                        <?php echo CHtml::form(array('class' => 'form-inline')); ?>
                        <div class="form-group">
                            <div class="col-sm-1">
                                <img src="images/other/next.gif" alt=""/>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                echo CHtml::textField('date1', '', array('id' => 'mysearch1',
                                    'class' => 'form-control dp',
                                    'data-date-format' => 'yyyy-mm-dd',
                                    'placeholder' => "ตั้งแต่วันที่.."));
                                ?>


                            </div>
                            <div class="col-sm-3">
                                <?php
                                echo CHtml::textField('date2', '', array('id' => 'mysearch2',
                                    'class' => 'form-control dp',
                                    'data-date-format' => 'yyyy-mm-dd',
                                    'placeholder' => "ถึงวันที่.."));
                                ?>


                            </div>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> ตกลง</button>
                        </div>
                        <?php
                        echo CHtml::endForm();
                        ?>
                        <div style="clear: both;"></div><br>
                        <?php
                        if ($_POST["date1"] <> '' and $_POST["date2"] <> '')
                        {
                            echo '<p class="text-green"> ตั้งแต่วันที่ <b>' . $_POST["date1"] . '</b> ถึงวันที่ <b>' . $_POST["date2"] . '</b></p>';
                        }
                        ?>


                    </div>

                </div>

                <div class="col-md-12">
                    <!-- BAR CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">การใช้อุปกรณ์แยกตามห้องประชุม</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="barChart" width="700" height="500"></canvas>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <p><i class="fa fa-square text-green"></i> จำนวนการใช้ Notebook</p>
                                <p><i class="fa fa-square text-blue"></i> จำนวนการใช้ Projector</p>
                            </div>
                            <div class="col-md-3">
                                <p><i class="fa fa-square text-red"></i> จำนวนการใช้ Visualizer</p>
                                <p><i class="fa fa-square text-orange"></i> จำนวนการใช้ Led TV</p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div><!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">ร้อยละการใช้ห้องประชุมในช่วงเวลาที่เลือก</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="pieChart" height="300"></canvas>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-6">
                                <p><i class="fa fa-square text-red"></i> ห้องประชุมขนาดใหญ่</p>
                                <p><i class="fa fa-square text-green"></i> ห้องประชุมขนาดเล็ก</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fa fa-square text-orange"></i> ห้องประชุมขนาดกลาง</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">จำนวนอนุมัติและไม่อนุมัติห้องประชุม</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="lineChart" height="300"></canvas>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <p><i class="fa fa-square text-green"></i> อนุมัติห้อง</p>

                            </div>
                            <div class="col-md-4">
                                <p><i class="fa fa-square text-red"></i> ไม่อนุมัติห้อง</p>
                                <p> <?php echo " &nbsp;"; ?></p>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>

            </div><!-- /.row -->

        </section><!-- /.content -->
        <?php
        $sql = "SELECT r.booking_room_name,
          (SUM(IF(notebook='Y',1,0))) as c_notebook,
          (SUM(IF(visualizer='Y',1,0))) as c_visualizer,
          (SUM(IF(projector='Y',1,0))) as c_projector,
          (SUM(IF(led_tv='Y',1,0))) as c_led_tv
           FROM booking b
          left outer join booking_room r on r.booking_room_id = b.booking_room_id
          where b.booking_date_start between '" . $_POST["date1"] . "' and '" . $_POST["date2"] . "'
          and b.booking_status = 'Y' group by b.booking_room_id";

        /* $sql = "SELECT r.booking_room_name,count(b.booking_id)as countall
          FROM booking b
          left outer join booking_room r on r.booking_room_id = b.booking_room_id
          where b.booking_date_start between '" . $_POST["date1"] . "' and '" . $_POST["date2"] . "'
          group by b.booking_room_id"; */
        $row = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($row as $value) :
            $data0[] = $value['booking_room_name'];
            $data1[] = $value['c_notebook'];
            $data2[] = $value['c_visualizer'];
            $data3[] = $value['c_projector'];
            $data4[] = $value['c_led_tv'];
        endforeach;


        $pie_data1 = Yii::app()->db->createCommand('select count(*)as a from booking b
left outer join booking_room r on r.booking_room_id = b.booking_room_id
where b.booking_date_start between "' . $_POST["date1"] . '" and "' . $_POST["date2"] . '"
and b.booking_room_id = 1 and b.booking_status = "Y"')->queryScalar();
        $pie_data2 = Yii::app()->db->createCommand('select count(*)as a from booking b
left outer join booking_room r on r.booking_room_id = b.booking_room_id
where b.booking_date_start between "' . $_POST["date1"] . '" and "' . $_POST["date2"] . '"
and b.booking_room_id = 2 and b.booking_status = "Y"')->queryScalar();
        $pie_data3 = Yii::app()->db->createCommand('select count(*)as a from booking b
left outer join booking_room r on r.booking_room_id = b.booking_room_id
where b.booking_date_start between "' . $_POST["date1"] . '" and "' . $_POST["date2"] . '"
and b.booking_room_id = 3 and b.booking_status = "Y"')->queryScalar();

        $pie_dataall = Yii::app()->db->createCommand('select count(*)as a from booking b
left outer join booking_room r on r.booking_room_id = b.booking_room_id
where b.booking_date_start between "' . $_POST["date1"] . '" and "' . $_POST["date2"] . '"
and b.booking_status = "Y"')->queryScalar();

        $line_data_n = Yii::app()->db->createCommand('select m.m_tname,(SUM(IF(b.booking_status="Y",1,0))) as y,(SUM(IF(b.booking_status="N",1,0))) as n
from monthly m
left outer join booking b on month(b.booking_date_start) = m.m_id
group by m.m_id')->queryAll();
        foreach ($line_data_n as $v1) :
            $line_tname[] = $v1['m_tname'];
            $line_n[] = $v1['n'];
            $line_y[] = $v1['y'];
        endforeach;
        ?>
    </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->


<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

<script>
    var barChartData = {
        labels: <?php echo json_encode($data0); ?>,
        datasets: [
            {
                label: "Notebook",
                fillColor: "#1cca7a",
                strokeColor: "#00a65a",
                data: <?php echo json_encode($data1); ?>
            },
            {
                label: "Visualizer",
                fillColor: "#ec3658",
                strokeColor: "#c01031",
                data: <?php echo json_encode($data2); ?>
            },
            {
                label: "Projector",
                fillColor: "#365bd6",
                strokeColor: "#173aab",
                data: <?php echo json_encode($data3); ?>
            },
            {
                label: "Led TV",
                fillColor: "#d7983e",
                strokeColor: "#b4631b",
                data: <?php echo json_encode($data4); ?>},
        ]
    };
    var barOptions = {
        animation: true,
        showScale: true,
        scaleOverride: false,
        scaleShowLabels: true,
        scaleOverlay: true,
        scaleShowGridLines: true,
        scaleSteps: null,
        scaleStepWidth: null,
        scaleStartValue: null,
        scaleLineColor: "#bababa",
    }
    var myBar = new Chart(document.getElementById("barChart").getContext("2d")).Bar(barChartData, barOptions);

    var pieData = [
        {
            value: <?php echo @($pie_data1 / $pie_dataall) * 100; ?>,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "ห้องประชุมขนาดใหญ่"
        },
        {
            value: <?php echo @($pie_data2 / $pie_dataall) * 100; ?>,
            color: "#1cca7a",
            highlight: "#4fe7a1",
            label: "ห้องประชุมขนาดกลาง"
        },
        {
            value: <?php echo @($pie_data3 / $pie_dataall) * 100; ?>,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "ห้องประชุมขนาดเล็ก"
        }
    ]
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var myPieChart = new Chart(document.getElementById("pieChart").getContext("2d")).Pie(pieData, pieOptions);

    var lineData = {
        labels: <?php echo json_encode($line_tname); ?>,
        datasets: [
            {
                label: "อนุมัติห้อง",
                fillColor: "rgba(139,240,139,0.2)",
                strokeColor: "rgba(34,186,34,1)",
                pointColor: "rgba(34,186,34,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                //pointHighlightStroke: "rgba(100,100,100,1)",
                data: <?php echo json_encode($line_y); ?>,
            },
            {
                label: "ไม่อนุมัติห้อง",
                fillColor: "rgba(243,176,176,0.2)",
                strokeColor: "rgba(245,117,117,1)",
                pointColor: "rgba(245,117,117,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                //pointHighlightStroke: "rgba(151,187,205,1)",
                data: <?php echo json_encode($line_n); ?>,
            }
        ]
    };
    var lineOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        maintainAspectRatio: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
    };
    var myLineChart = new Chart(document.getElementById("lineChart").getContext("2d")).Line(lineData, lineOptions);
</script>


