<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<aside class="right-side">
    <section class="content-header">
        <h1>
            <img src="images/32/ruler_pencil.png" alt=""/>เพิ่มข่าว
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->createUrl("Site/Index"); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">เพิ่มข่าว</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <?php
            $frm = $this->beginWidget('CActiveForm', array(
                'id' => 'post-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                ),
            ));
            ?>
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label style="color: #060;">หัวข้อข่าว</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                    <?php echo $frm->textField($model1, "news_head", array('class' => 'form-control', 'placeholder' => 'หัวข้อข่าว...', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-6">
                                <label style="color: #060;">ประเภทข่าว</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <?php echo $frm->dropdownList($model1, "news_type", array('1' => 'ประกาศ', '2' => 'ชี้แจง', '3' => 'แนะนำ', '4' => 'คำสั่ง'), array('class' => 'form-control', 'prompt' => 'เลือกประเภทข่าว..', 'required' => 'True')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label style="color: #060;">รายละเอียด</label>
                                <div class="input-group">
                                    <?php echo $frm->textArea($model1, "news_detail", array('class' => 'form-control', 'rows' => '5', 'cols' => '130', 'placeholder' => 'กรอกรายละเอียดที่ต้องการ...')); ?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div><br>

                        <!---- add items-->
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <!--<div class="box-header">
                                    <a class="btn btn-success add_field_button" id="addButton">เพิ่มไฟล์แนบ</a>
                                </div>

                                <div style="clear: both;"></div>-->

                                <div id='TextBoxesGroup'>
                                    <?php echo $frm->fileField($model1, "news_file", array('class' => 'form-control', 'placeholder' => 'เพิ่มไฟล์...')); ?>
                                </div>

                                <div style="clear: both;"></div><br>
                            </div>
                        </div>
                        <!---- end add items -->

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">บันทึก</button>
                            <button class="btn btn-warning" type="reset">ล้างข้อมูล</button>
                        </div>

                    </div>
                </div>
            </div>

            <?php echo $frm->hiddenField($model1, 'news_user', array('class' => 'form-control', 'value' => Yii::app()->session["member_id"])); ?>
            <?php echo $frm->hiddenField($model1, 'department', array('class' => 'form-control', 'value' => Yii::app()->session["department"])); ?>
            <?php echo $frm->hiddenField($model1, 'date', array('class' => 'form-control', 'value' => date("Y-m-d"))); ?>
            <?php echo $frm->hiddenField($model1, 'time', array('class' => 'form-control', 'value' => date("His"))); ?>
            <?php $this->endWidget(); ?>
        </div>
    </section>
</aside>
<script type="text/javascript">

    $(document).ready(function () {

        var counter = 1;

        $("#addButton").click(function () {

            if (counter > 5) {
                alert("สามารถแนบไฟล์ได้ไม่เกิน 5 ไฟล์!");
                return false;
            }



            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html('<div><div class="col-xs-6">' +
                    '<div class="input-group"><span class="input-group-addon"><i class="fa fa-file-o"></i></span>' +
                    '<input type="file" name="txt_file[]" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '</div><input type="button" value="ลบ" class="btn btn-danger removeButton">' +
                    '<div style="clear: both;"></div><br></div>');
            newTextBoxDiv.appendTo("#TextBoxesGroup");
            counter++;

        });
        /*$("#removeButton").click(function () {
         if (counter == 1) {
         alert("No more textbox to remove");
         return false;
         }

         $(this).remove();
         });*/
        $("#getButtonValue").click(function () {

            var msg = '';
            for (i = 1; i < counter; i++) {
                msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
            }
            alert(msg);
        });
        $("#TextBoxesGroup").on("click", ".removeButton", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            counter--;
        });
    });
</script>