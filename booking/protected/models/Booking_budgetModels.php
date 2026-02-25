<?php

class Booking_budgetModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'booking_budget';
    }

    /* function relations()
      {
      return array('join_department' => array(self::BELONGS_TO, 'departmentModels', 'department'),
      'join_computer_service_type' => array(self::BELONGS_TO, 'Computer_service_typeModels', 'computer_service_type'));
      } */

    static function getBookingbudgetname()
    {
        $getModel = Booking_budgetModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->booking_budget_id] = $r->booking_budget_name;
        }
        return $arr;
    }

}
