<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchAccountAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'financial_statement'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.cate =?',$filter['cate']));
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}

}
