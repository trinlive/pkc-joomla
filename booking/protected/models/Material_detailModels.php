<?php

class Material_detailModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'material_detail';
    }

    function relations()
    {
        return array('join_department' => array(self::BELONGS_TO, 'departmentModels', 'department_id'),
            'join_material_type' => array(self::BELONGS_TO, 'Material_typeModels', 'material_type_id'));
    }

}
