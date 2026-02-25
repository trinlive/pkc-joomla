<?php

class Booking_equipmentModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'booking_equipment';
    }

    /* function relations()
      {
      return array('join_department' => array(self::BELONGS_TO, 'departmentModels', 'department'),
      'join_computer_service_type' => array(self::BELONGS_TO, 'Computer_service_typeModels', 'computer_service_type'));
      }

      static function getComputername()
      {
      $getModel = ComputerModels::model()->findall();
      $arr = array();
      foreach ($getModel as $r)
      {
      $arr[$r->computer_id] = $r->computer_name;
      }
      return $arr;
      }

      public function getComname()
      {
      return $this->computer_name;
      } */
}
