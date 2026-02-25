<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchNewsById($news_id){
		$select = parent::select();
		$select->from(array('a' => 'news'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.id =?',$news_id));
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function fetchNewsAll($filter){
		$select = parent::select();
		$select->from(array('a' => 'news'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.category_id= ?',$filter['cate_id']));
		
		$select->order(array('a.id DESC'));
		$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		
		return $rs;
	}
}
