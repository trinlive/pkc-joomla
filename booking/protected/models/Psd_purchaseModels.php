<?php

class Psd_purchaseModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'psd_purchase';
    }

    function relations()
    {
        return array('join_company' => array(self::BELONGS_TO, 'CompanyModels', 'company_id'));
    }

    /* public function getFullDrugName()
      {
      return $this->name . ' [' . $this->strength . '] [' . $this->units . ']';
      } */
}
