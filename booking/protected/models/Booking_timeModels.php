<?php

class Booking_timeModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'booking_time';
    }

    /* function relations()
      {
      return array('join_department' => array(self::BELONGS_TO, 'departmentModels', 'department'),
      'join_computer_service_type' => array(self::BELONGS_TO, 'Computer_service_typeModels', 'computer_service_type'));
      }
     */

    /* static function getBookingtypename()
      {
      $getModel = Booking_typeModels::model()->findall();
      $arr = array();
      foreach ($getModel as $r)
      {
      $arr[$r->booking_type_id] = $r->booking_type_name;
      }
      return $arr;
      } */
}
