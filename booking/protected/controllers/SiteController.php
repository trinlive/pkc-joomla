<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        if (Yii::app()->session["member_username"] == null)
        {
            $this->redirect('index.php?r=Member/Login');
        }
        else
        {
            $this->render('index');
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionAccess_denied()
    {
        $this->render('Access_deniedViews');
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate())
            {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionCreate_news($id = null)
    {
        if ((strpos(Yii::app()->session["member_access"], '[news]')) or ( strpos(Yii::app()->session["member_access"], '[Admin]')))
        {
            unset(yii::app()->session["access_denied_message"]);

            $dir = Yii::getPathOfAlias('webroot.uploads');
            $model1 = new NewsModels;
            if (isset($_POST['NewsModels']))
            {
                $model1->_attributes = $_POST['NewsModels'];

                $file = CUploadedFile::getInstance($model1, 'news_file');
                if (!empty($file))
                {
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $new_name = date("Ymdhis") . '.' . $ext;
                    $model1->load_file = $new_name;
                    $model1->news_file = $file->getName();

                    if ($model1->save())
                    {
                        $file->saveAs($dir . '/' . $new_name);
                        $this->redirect(array('index'));
                    }
                }
                else
                {
                    $model1->load_file = "";
                    $model1->news_file = "";
                    if ($model1->save())
                    {
                        $this->redirect(array('index'));
                    }
                }
            }
            $this->render('create_news', array('model1' => $model1));
        }
        else
        {
            yii::app()->session["access_denied_message"] = '[news]';
            Yii::app()->runController('site/access_denied');
        }
    }

    /* public function actionDownload($id = null)
      {
      $filename = 'uploads/uhis';
      header('Content-Disposition: attachment; charset=UTF-8; filename="' . $filename . '"');
      $utf8_content = mb_convert_encoding($content, "SJIS", "UTF-8");
      echo $utf8_content;
      Yii::app()->end();
      return;
      } */

    public function actionSearch()
    {
        $res = array();

        if (isset($_GET['term']))
        {
            // sql query to get execute
            $qtxt = "SELECT member_id,member_name FROM member WHERE member_name LIKE :name";
            // preparing the sql query
            $command = Yii::app()->db->createCommand($qtxt);
            // assigning the get value
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            //$res =$command->queryColumn(); // this is the function which was giving me result of only 1 column
            $res = $command->queryAll(); // I changed that to this to give me result of all column's specified in sql query.
        }
        echo CJSON::encode($res); // encoding the result to JSON
        Yii::app()->end();
    }

    public function actionGetauto()
    {
        $res = array();

        if (isset($_GET['term']))
        {
            $qtxt = "select name,id from psd_items WHERE name LIKE :qterm limit 20";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":qterm", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
        }

        echo CJSON::encode($res);
        Yii::app()->end();
    }

}
