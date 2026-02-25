<?php

class System_settingController extends Controller
{

    function actionMember_setting()
    {
        if ((strpos(Yii::app()->session["member_access"], '[system_setting]')) or ( strpos(Yii::app()->session["member_access"], '[Admin]')))
        {
            unset(yii::app()->session["access_denied_message"]);
            $criteria = new CDbCriteria();

            if ($_POST["get_fname"] <> "")
            {
                $match = addcslashes($_POST["get_fname"], '%_'); // escape LIKE's special characters
                $criteria = new CDbCriteria(array('condition' => "member_fname LIKE :get_fname", 'params' => array(':get_fname' => "%$match%")));
            }
            else if ($_POST["get_department"] <> "")
            {
                $criteria->condition = 'department = "' . $_POST["get_department"] . '"';
            }

            $criteria->order = "member_fname";
            $prov = new CActiveDataProvider('MemberModels', array('pagination' => array('pagesize' => 500)));
            $prov->criteria = $criteria;

            $this->render('Member_settingViews', array('provider' => $prov));
        }
        else
        {
            yii::app()->session["access_denied_message"] = '[system_setting]';
            Yii::app()->runController('site/access_denied');
        }
    }

    function actionMember_edit($id = null)
    {
        if ((strpos(Yii::app()->session["member_access"], '[system_setting]')) or ( strpos(Yii::app()->session["member_access"], '[Admin]')))
        {
            unset(yii::app()->session["access_denied_message"]);
            $model1 = MemberModels::model()->findByPk($id);
            $model2 = Access_menuModels::model()->findAll();

            if (!empty($_POST))
            {
                //$model2 = Access_menuModels::model()->findAll();
                $model1->_attributes = $_POST['MemberModels'];
                $get_access_menu = " ";
                for ($i = 0; $i < count($_POST["txt_access_menu"]); $i++)
                {
                    $get_access_menu = $get_access_menu . $_POST["txt_access_menu"][$i];
                }
                $model1->member_access = $get_access_menu;

                if ($model1->save())
                {
                    Yii::app()->session["txt_member_edit"] = 'ok';
                    //$this->render('Member_editViews', array('model1' => $model1, 'model2' => $model2));
                    $this->redirect(array('system_setting/Member_edit', 'id' => $id));
                }
            }
            if (Yii::app()->session["txt_member_edit"] <> 'ok')
            {
                unset(Yii::app()->session["txt_member_edit"]);
            }

            $this->render('Member_editViews', array('model1' => $model1, 'model2' => $model2));
        }
        else
        {
            yii::app()->session["access_denied_message"] = '[system_setting]';
            Yii::app()->runController('site/access_denied');
        }
    }

    function actionMember_create($id = null)
    {
        $model1 = new MemberModels;
        $model1->setScenario('createUser');

        if (isset($_POST['MemberModels']))
        {
            if ($model1->validate())
            {
                $model1->_attributes = $_POST['MemberModels'];
                $valid = $model1->validate();
                if ($valid)
                {
                    if ($model1->save())
                    {
                        //Yii::app()->session["txt_create_user"] = 'ok';
                        Yii::app()->runController('system_setting/member_setting');
                    }
                    else
                    {
                        Yii::app()->session["txt_create_user"] = 'no';
                        $this->render('member_create', array('model1' => $model1));
                    }
                }
            }
        }

        $this->render('member_create', array('model1' => $model1));
    }

    public function actionGetauto_staff()
    {
        if (isset($_GET['term']))
        {
            $qtxt = "select * from staff WHERE fname LIKE :qterm limit 20";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":qterm", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->query();

            $list = array();
            foreach ($res as $q)
            {
                $data['value'] = $q['id'];
                $data['label'] = $q['fname'] . " " . $q['lname'];
                $data['id'] = $q['id'];

                $list[] = $data;
                unset($data);
            }

            echo json_encode($list);
        }
    }

}
