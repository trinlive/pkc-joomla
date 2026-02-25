<?php

class Booking_manage_typeModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'booking_manage_type';
    }

    /* function relations()
      {
      return array('join_department' => array(self::BELONGS_TO, 'departmentModels', 'department'),
      'join_computer_service_type' => array(self::BELONGS_TO, 'Computer_service_typeModels', 'computer_service_type'));
      } */

    static function getBookingmanagetypename()
    {
        $getModel = Booking_manage_typeModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->booking_manage_type_id] = $r->booking_manage_type_name;
        }
        return $arr;
    }

}
