<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Call_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchCallById($call_id){
		$select = parent::select();
		$select->from(array('a' => 'callcenter'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.id =?',$call_id));
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function fetchCallReplyById($id){
		$subselect = parent::select();
		$select = parent::select();
		$select->from(array('a' => 'callcenter_reply'))
		->where('a.topic_id = ?',$id);
		$select->order(array('a.id ASC'));
		$rs = parent::fetchAll($select);
	
	
		return $rs;
	}
	function fetchCallAll($filter){
		
		$subselect = parent::select();
		$select = parent::select();
		
		$sub = $subselect->from(array('a' => 'callcenter_reply'),array('topic_id','datepost' => 'MAX(datepost)'));
		$subselect->group(array('topic_id'));
		$SubSelectString = '(' . $sub->__toString() . ')';
		
		$select->from(array('a' => 'callcenter'));
		$select->joinLeft(array('b' => new Zend_Db_Expr($SubSelectString)),'a.id = b.topic_id',array('reply'=>'IF(b.datepost IS NOT NULL,b.datepost,"")'))
		->where($this->quoteInto('a.status =?',1));
		$select->order(array('a.id DESC'));
		$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		
		return $rs;
	}
	function insert($table,$data){
		return parent::insert($table,$data);
	}
}
