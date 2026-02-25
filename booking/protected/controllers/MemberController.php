<?php

class MemberController extends Controller
{

    function actionLogin()
    {

        Yii::app()->session["txt_create_user"] = '';

        $this->renderPartial('LoginViews');
    }

    function actionLoginCheck()
    {
        $attributes = array(); //$attributes คือตัวแปร ใช้เป็นอะไรก็ได้
        $attributes["member_username"] = $_POST["txt_username"];
        $atrributes["member_password"] = $_POST["txt_password"];
        $models = MemberModels::model()->findByAttributes($attributes);
        if ($models->member_username == $_POST["txt_username"] && $models->member_password == $_POST["txt_password"] && $models->member_status == "Y")
        {
            Yii::app()->session["member_id"] = $models->member_id;
            Yii::app()->session["member_username"] = $models->member_username;
            Yii::app()->session["member_password"] = $models->member_password;
            Yii::app()->session["member_pname"] = $models->member_pname;
            Yii::app()->session["member_fname"] = $models->member_fname;
            Yii::app()->session["member_lname"] = $models->member_lname;
            Yii::app()->session["member_birthday"] = $models->member_birthday;
            Yii::app()->session["member_sex"] = $models->member_sex;
            Yii::app()->session["group_dep"] = $models->group_dep;
            Yii::app()->session["department"] = $models->department;
            Yii::app()->session["member_position"] = $models->member_position;
            Yii::app()->session["member_detail"] = $models->member_detail;
            Yii::app()->session["member_nickname"] = $models->member_nickname;
            Yii::app()->session["member_address"] = $models->member_address;
            Yii::app()->session["member_tel"] = $models->member_tel;
            Yii::app()->session["member_email"] = $models->member_email;
            Yii::app()->session["member_status"] = $models->member_status;
            Yii::app()->session["member_cid"] = $models->member_cid;
            Yii::app()->session["member_staff"] = $models->member_staff;
            Yii::app()->session["member_access"] = $models->member_access;

            Yii::app()->session["txt_check_login"] = '';

            $this->redirect(Yii::app()->homeUrl);
        }
        else
        {
            Yii::app()->session["txt_check_login"] = 'Username หรือ Password ไม่ถูกต้อง<br> หรือถูกปิดการใช้งาน';
            $this->redirect('index.php?r=/Member/Login');
        }
    }

    function actionLogout()
    {
        unset(Yii::app()->session["member_id"]);
        unset(Yii::app()->session["member_username"]);
        unset(Yii::app()->session["member_password"]);
        unset(Yii::app()->session["member_pame"]);
        unset(Yii::app()->session["member_fame"]);
        unset(Yii::app()->session["member_lame"]);
        unset(Yii::app()->session["member_birthday"]);
        unset(Yii::app()->session["member_sex"]);
        unset(Yii::app()->session["group_dep"]);
        unset(Yii::app()->session["department"]);
        unset(Yii::app()->session["member_position"]);
        unset(Yii::app()->session["member_detail"]);
        unset(Yii::app()->session["member_nickname"]);
        unset(Yii::app()->session["member_address"]);
        unset(Yii::app()->session["member_tel"]);
        unset(Yii::app()->session["member_email"]);
        unset(Yii::app()->session["member_status"]);
        unset(Yii::app()->session["member_cid"]);
        unset(Yii::app()->session["member_staff"]);
        unset(Yii::app()->session["member_access"]);

// หรือใช้ Yii::app()->session->destroy();
        $this->redirect(Yii::app()->homeUrl);
    }

    function actionCreate_member($id = null)
    {
        if (!empty($_POST['txt_fname']))
        {
            $attributes = array(); //$attributes คือตัวแปร ใช้เป็นอะไรก็ได้
            $attributes["member_fname"] = $_POST["txt_fname"];
            $atrributes["member_username"] = $_POST["txt_password"];
            $attributes["member_password"] = $_POST["txt_username"];
            //$atrributes["member_password"] = $_POST["txt_password"];
            $models = MemberModels::model()->findByAttributes($attributes);

            $sql_member = Yii::app()->db->createCommand('select * from member where member_username = "' . $_POST["txt_username"] . '"')->queryScalar();
            if ($sql_member)
            {
                Yii::app()->session["txt_create_user"] = 'Username นี้มีอยู่แล้วในระบบ กรุณาลองใหม่';
                Yii::app()->session["txt_check_login"] = '';
                $this->redirect('index.php?r=/Member/Create_member');
            }
            else
            {
                $model1 = new MemberModels();
                $model1->member_fname = $_POST["txt_fname"];
                $model1->member_username = $_POST["txt_username"];
                $model1->member_password = $_POST["txt_password"];
                if ($model1->save())
                {
                    Yii::app()->session["txt_create_user"] = '';
                    Yii::app()->session["txt_check_login"] = '';
                    $this->redirect('index.php?r=/Member/Login');
                }
            }
        }
        $this->render('Create_memberViews');
    }

    public function actionChangepassword($id)
    {
        $model = new MemberModels;

        $model = MemberModels::model()->findByAttributes(array('member_id' => $id));
        $model->setScenario('changePwd');


        if (isset($_POST['MemberModels']))
        {

            $model->attributes = $_POST['MemberModels'];
            $valid = $model->validate();

            if ($valid)
            {

                $model->member_password = $model->new_password;

                if ($model->save())
                {
                    Yii::app()->session["txt_change_password_ok"] = 'ok';
                    //$this->render('ChangepasswordViews', array('model' => $model));
                    $this->redirect(array('member/Changepassword', 'id' => $id));
                }
                else
                {
                    Yii::app()->session["txt_change_password_ok"] = 'no';
                    //$this->render('ChangepasswordViews', array('model' => $model));
                    $this->redirect(array('member/Changepassword', 'id' => $id));
                }
            }
        }
        if (Yii::app()->session["txt_change_password_ok"] <> 'ok')
        {
            unset(Yii::app()->session["txt_change_password_ok"]);
        }

        $this->render('ChangepasswordViews', array('model' => $model));
    }

    function actionMember_edit($id = null)
    {
        $model = MemberModels::model()->findByPk($id);

        if (!empty($_POST))
        {
            $model->_attributes = $_POST['MemberModels'];
            if ($model->save())
            {
                //Yii::app()->session["txt_edit_profile"] = 'ok';
                $this->render('Member_editViews', array('model' => $model));
            }
        }
        //unset(Yii::app()->session["txt_edit_profile"]);
        $this->render('Member_editViews', array('model' => $model));
    }

    function actionLoaddepartment()
    {
        $data = DepartmentModels::model()->findAll('group_id=:group_id', array(':group_id' => (int) $_POST['group_dep_id']));

        $data = CHtml::listData($data, 'id', 'name');

        echo "<option value=''> เลือกหน่วยงาน </option>";
        foreach ($data as $value => $id)
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($id), true);
    }

}

/*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

