<?php

class Psd_planModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'psd_plan';
    }

    function relations()
    {
        return array('join_psd_items' => array(self::BELONGS_TO, 'Psd_itemsModels', 'psd_items_id'),
            'join_department' => array(self::BELONGS_TO, 'DepartmentModels', 'department'));
    }

    /* static function getPsd_type()
      {
      $getModel = Psd_typeModels::model()->findall();
      $arr = array();
      foreach ($getModel as $r)
      {
      $arr[$r->material_type_id] = $r->material_type_name;
      }
      return $arr;
      } */
}
