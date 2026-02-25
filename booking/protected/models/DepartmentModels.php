<?php

class DepartmentModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'department';
    }

    static function getDepartmentname()
    {
        $getModel = DepartmentModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->department_id] = $r->name;
        }
        return $arr;
    }

}
