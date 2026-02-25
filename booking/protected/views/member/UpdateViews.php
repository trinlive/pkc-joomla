<aside class="right-side">
    <section class="content-header">
        <h1>
            Profile
            <small>ข้อมูลส่วนตัว</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("Member/InsertUpdate/" . Yii::app()->session["member_id"]); ?>">Profile</a></li>
            <li class="active">ข้อมูลส่วนตัว </li>
            <!--<li class="active">อุบัติการณ์ด้านการรักษา </li>-->
        </ol>
    </section>

    <?php echo CHtml::form(array("Member/Update")); ?>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Profile Picture</h3>
                    </div><!-- /.box-header -->
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
                        <div class="col-lg-4">
                            <div class="input-group">
                                <img src="images/member_pic/<?php echo $pic_sex; ?>" style="border: solid #434343 1px;">

                            </div>
                        </div>
                        <div class="col-lg-8">
                            <label>เปลี่ยนรูป</label>
                            <div class="input-group">
                                <input type="file" id="exampleInputFile">
                            </div>
                        </div><br>
                        <div class="col-lg-8">
                            <label>คำนำหน้า</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <label>ชื่อ</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <label>สกุล</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Check me out
                        </label>
                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <?php echo CHtml::endForm(); ?>

</aside>