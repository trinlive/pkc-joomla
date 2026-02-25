<?php

class Money_typeModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'money_type';
    }

    static function getMoney_typename()
    {
        $getModel = Money_typeModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->money_type_id] = $r->money_type_name;
        }
        return $arr;
    }

}
