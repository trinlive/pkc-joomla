<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Activity_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchActivityById($activity_id){
		$select = parent::select();
		$select->from(array('a' => 'activity'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.id =?',$activity_id));
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function fetchActivityAll($filter){
		$select = parent::select();
		$select->from(array('a' => 'activity'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.category_id= ?',$filter['cate_id']));
		
		$select->order(array('a.id DESC'));
		$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		
		return $rs;
	}
	function fetchActivityThumbById($activity_id){
		$select = parent::select();
		$select->from(array('a' => 'activity_images'))
		->where($this->quoteInto('a.image_active =?',1))
		->where($this->quoteInto('a.nid =?',$activity_id));
		$select->order(array('a.id ASC'));
		$rs = parent::fetchAll($select);
		
		
		return $rs;
	}
}
