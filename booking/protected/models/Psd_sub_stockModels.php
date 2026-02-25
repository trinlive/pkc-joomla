<?php

class Psd_sub_stockModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'psd_sub_stock';
    }

    function relations()
    {
        return array('join_psd_items' => array(self::BELONGS_TO, 'Psd_itemsModels', 'psd_items_id'),
            'join_psd_stock' => array(self::BELONGS_TO, 'Psd_stockModels', 'psd_stock_id'));
    }

    /* static function getPsd_stock_name()
      {
      $getModel = Psd_itemsModels::model()->findall();
      $arr = array();
      foreach ($getModel as $r)
      {
      $arr[$r->psd_items_id] = $r->psd_items_name;
      }
      return $arr;
      } */
}
