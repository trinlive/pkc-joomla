<?php

class Psd_orderdetailModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'psd_order_detail';
    }

    function relations()
    {
        return array('join_psd_items' => array(self::BELONGS_TO, 'Psd_itemsModels', 'psd_items_id'),
            'join_psd_order' => array(self::BELONGS_TO, 'Psd_orderModels', 'psd_order_id'));
    }

    /* public function getFullDrugName()
      {
      return $this->name . ' [' . $this->strength . '] [' . $this->units . ']';
      } */
}
