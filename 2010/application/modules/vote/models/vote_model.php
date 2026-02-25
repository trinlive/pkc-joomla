<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Vote_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchPollItemId($poll_id){
		$select = parent::select();
		$select->from(array('a' => 'poll_item'))
		->where($this->quoteInto('a.id =?', $poll_id));
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function insert($table,$data){
		return parent::insert($table,$data);
	}
	function update($table,$data,$where){
		if($where){
			return parent::update($table,$data,$where);
		}
	}
}
