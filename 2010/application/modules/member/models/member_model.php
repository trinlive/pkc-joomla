<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Member_model extends MY_Model {

    function __construct() {
        parent::__construct();
	}
	
	function login($username,$password){
		$select = parent::select();
		$select->from(array('a' => 'member'),array('id','member_id','name','picture','username','password'))
			->where($this->quoteInto('a.username = ?',$username))
			->where($this->quoteInto('a.password = ?',md5($password)));
		$rs = parent::fetchRow($select);
		
		return $rs;
	}
	function fetchCountMemberAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'member'),array('cn' => 'count(*)'))
		->where('a.id > ?','0');
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function fetchCheckThaiID($id_card){
		$select = parent::select();
		$select->from(array('a' => 'member'),array('id','idcard'))
		->where('a.idcard = ?',trim($id_card));
		$rs = parent::fetchRow($select);
		return $rs;
	}
	function insert($table,$data){
		return parent::insert($table,$data);
	}
}
?>