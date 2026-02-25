<?php

class Material_groupModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'material_group';
    }

    static function getMaterial_groupname()
    {
        $getModel = Material_groupModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->material_group_id] = $r->material_group_name;
        }
        return $arr;
    }

}
