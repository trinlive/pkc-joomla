<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth_model extends MY_Model {

    function __construct() {
        parent::__construct();
	}
	
	function login($username,$password){
		$select = parent::select();
		$select->from(array('a' => 'users'),array('id','first_name','last_name','role','username','password'))
			->where('a.status = ?','Active')
			->where($this->quoteInto('a.username = ?',$username))
			->where($this->quoteInto('a.password = ?',md5($password)));
		
		$rs = parent::fetchRow($select);
		
		return $rs;
	}
}
?>