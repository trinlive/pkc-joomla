<?php

class Material_recordModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'material_record';
    }

    /* function relations()
      {
      return array('join_material_type' => array(self::BELONGS_TO, 'Material_typeModels', 'material_type'));
      } */
}
