<?php

class StaffModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'staff';
    }

    static function getStaffname()
    {
        $getModel = StaffModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->id] = $r->fname . " " . $r->lname;
        }
        return $arr;
    }

}
