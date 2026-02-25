<?php

class BookingController extends Controller
{

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        if ($_POST["get_room"] <> "")
        {
            $criteria->condition = 'booking_room_id = "' . $_POST["get_room"] . '"';
        }
        $criteria->order = "booking_date_start desc";
        $prov = new CActiveDataProvider('BookingModels', array('pagination' => array('pagesize' => 100)));
        $prov->criteria = $criteria;

        $this->render('index', array('provider' => $prov));
    }

    public function actionBooking_create()
    {
        $model1 = new BookingModels();
        $model1->setScenario('checkDate');

        if (isset($_POST['BookingModels']))
        {
            $model1->_attributes = $_POST['BookingModels'];

            if ($model1->save())
            {
                $this->redirect(array('index'));
            }
        }
        $this->render('booking_create', array('model1' => $model1));
    }

    public function actionBooking_view($id = null)
    {
        $model1 = BookingModels::model()->findByPk($id);
        if (isset($_POST['BookingModels']))
        {
            $model1->_attributes = $_POST['BookingModels'];

            if ($model1->save())
            {
                $this->redirect(array('index'));
            }
        }
        $this->render('booking_view', array('model1' => $model1));
    }

    public function actionBooking_room()
    {
        $criteria = new CDbCriteria();

        $criteria->order = "booking_room_id";
        $prov = new CActiveDataProvider('Booking_roomModels', array('pagination' => array('pagesize' => 100)));
        $prov->criteria = $criteria;

        $this->render('booking_room', array('provider' => $prov));
    }

    public function actionBooking_room_create()
    {
        $model1 = new Booking_roomModels();

        if (isset($_POST['Booking_roomModels']))
        {
            $model1->_attributes = $_POST['Booking_roomModels'];

            if ($model1->save())
            {
                $this->redirect(array('booking_room'));
            }
        }
        $this->render('booking_room_create', array('model1' => $model1));
    }

    public function actionBooking_room_edit($id = null)
    {
        $model1 = Booking_roomModels::model()->findByPk($id);

        if (isset($_POST['Booking_roomModels']))
        {
            $model1->_attributes = $_POST['Booking_roomModels'];

            if ($model1->save())
            {
                $this->redirect(array('booking_room'));
            }
        }
        $this->render('booking_room_edit', array('model1' => $model1));
    }

    public function actionReport()
    {
        $this->render('report');
    }

}
