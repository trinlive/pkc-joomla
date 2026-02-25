<?php

class MemberModels extends CActiveRecord
{

    public $old_password;
    public $new_password;
    public $repeat_password;

    //public $new_username;

    static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function tableName()
    {
        return 'member';
    }

    public function rules()
    {
        return array(
            array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
            array('old_password', 'findPasswords', 'on' => 'changePwd'),
            array('repeat_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'changePwd'),
            //array('new_username', 'required', 'on' => 'createUser'),
            //array('new_username', 'unique', 'message' => 'username is already exist, please change'),
            //array('new_username', 'findUsername', 'on' => 'createUser'),
            //array('member_username,', 'required', 'on' => 'createUser'),
            array('member_username', 'unique', 'message' => 'Username is already exist', 'on' => 'createUser'),
        );
    }

    public function findPasswords($attribute, $params)
    {
        $member = MemberModels::model()->findByPk(Yii::app()->session["member_id"]);
        if ($member->member_password != $this->old_password)
            $this->addError($attribute, 'Old password is incorrect.');
    }

    /* public function validateUsername($attribute, $params)
      {
      if (MemberModels::model()->exists('member_username=:member_username', array('member_username' => $this->new_username)))
      $this->addError('member_username', 'Username already exists.');
      } */

    public function findUsername($attribute, $params)
    {
        $member = MemberModels::model()->findByAttributes(array('member_username' => $this->new_username));
        if ($member->member_username <> $this->new_username)
            $this->addError($attribute, 'This Username is already used.');
    }

    function relations()
    {
        return array('join_department' => array(self::BELONGS_TO, 'DepartmentModels', 'department'),
            'join_staff' => array(self::BELONGS_TO, 'StaffModels', 'member_staff'));
    }

    static function getMembername()
    {
        $getModel = MemberModels::model()->findall();
        $arr = array();
        foreach ($getModel as $r)
        {
            $arr[$r->member_id] = $r->member_pname . "" . $r->member_fname . " " . $r->member_lname;
        }
        return $arr;
    }

}
