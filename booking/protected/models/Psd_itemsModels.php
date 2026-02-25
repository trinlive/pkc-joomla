<?php

class Psd_itemsModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'psd_items';
    }

    function relations()
    {
        return array('join_psd_type' => array(self::BELONGS_TO, 'Psd_typeModels', 'psd_items_type'));
    }

    static function getItemsname()
    {
        $getModel = Psd_itemsModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->psd_items_id] = $r->psd_items_name;
        }
        return $arr;
    }

}
