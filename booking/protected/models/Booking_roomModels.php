<?php

class Booking_roomModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'booking_room';
    }

    static function getBookingroomname()
    {
        $getModel = Booking_roomModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->booking_room_id] = $r->booking_room_name;
        }
        return $arr;
    }

}
