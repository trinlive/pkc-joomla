<?php

class CompanyModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'company';
    }

    static function getCompanyname()
    {
        $getModel = CompanyModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->company_id] = $r->compny_name;
        }
        return $arr;
    }

}
