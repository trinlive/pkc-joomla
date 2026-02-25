<?php

class Psd_typeModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'material_type';
    }

    static function getPsd_type()
    {
        $getModel = Psd_typeModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->material_type_id] = $r->material_type_name;
        }
        return $arr;
    }

}
