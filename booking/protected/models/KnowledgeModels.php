<?php

class KnowledgeModels extends CActiveRecord
{

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'knowledge';
    }

    function relations()
    {
        return array('join_department' => array(self::BELONGS_TO, 'departmentModels', 'department'),
            'join_user' => array(self::BELONGS_TO, 'MemberModels', 'user_owner'));
    }

    public function rules()
    {
        return array(
            /* array('file_xls', 'file', 'types' => 'xlsx,xls', 'allowEmpty' => true, 'message' => 'Excel File Only'),
              array('file_doc', 'file', 'types' => 'docx,doc', 'allowEmpty' => true, 'message' => 'Document File Only'),
              array('file_ppt', 'file', 'types' => 'ppt,pptx', 'allowEmpty' => true, 'message' => 'Power Point File Only'),
              array('file_pdf', 'file', 'types' => 'pdf', 'allowEmpty' => true, 'message' => 'PDF File Only'), */
            array('file_xls', 'file', 'types' => 'xlsx,xls', 'maxSize' => 1024 * 1024 * 20, 'tooLarge' => 'The document was larger than 20MB. Please upload a smaller document.', 'allowEmpty' => true),
            array('file_pdf', 'file', 'types' => 'pdf', 'maxSize' => 1024 * 1024 * 20, 'tooLarge' => 'The document was larger than 20MB. Please upload a smaller document.', 'allowEmpty' => true),
            array('file_ppt', 'file', 'types' => 'ppt,pptx', 'maxSize' => 1024 * 1024 * 20, 'tooLarge' => 'The document was larger than 20MB. Please upload a smaller document.', 'allowEmpty' => true),
            array('file_doc', 'file', 'types' => 'doc,docx', 'maxSize' => 1024 * 1024 * 20, 'tooLarge' => 'The document was larger than 20MB. Please upload a smaller document.', 'allowEmpty' => true),
        );
    }

    /*
      static function getComputername()
      {
      $getModel = ComputerModels::model()->findall();
      $arr = array();
      foreach ($getModel as $r)
      {
      $arr[$r->computer_id] = $r->computer_name;
      }
      return $arr;
      }

      public function getComname()
      {
      return $this->computer_name;
      } */
}
