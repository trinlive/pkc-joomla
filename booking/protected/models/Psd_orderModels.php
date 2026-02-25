<?php

class Psd_orderModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'psd_order';
    }

    function relations()
    {
        return array('join_order_user' => array(self::BELONGS_TO, 'MemberModels', 'order_user'),
            'join_receive_user' => array(self::BELONGS_TO, 'MemberModels', 'receive_user'),
            'join_department' => array(self::BELONGS_TO, 'DepartmentModels', 'order_department'),);
    }

    /* public function getFullDrugName()
      {
      return $this->name . ' [' . $this->strength . '] [' . $this->units . ']';
      } */
}
