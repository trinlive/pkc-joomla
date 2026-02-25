<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Frontend_model extends MY_Model {

    function __construct() {
        parent::__construct();
	}
	function fetchMenusAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'menu'))
		->where($this->quoteInto('a.position =?','index'))
		->where($this->quoteInto('a.level=?', 'main'))
		->where($this->quoteInto('a.status =?', 1));
	
		$select->order(array('a.indexs ASC'));
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchSubMenusById($filter){
		$select = parent::select();
		$select->from(array('a' => 'menu'))
		->where($this->quoteInto('a.level =?',$filter['level']))
		->where($this->quoteInto('a.sub =?',$filter['sub']))
		->where($this->quoteInto('a.status =?', 1));
		$select->order(array('a.indexs ASC'));
	
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchHighlightAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'highlight'))
		->where($this->quoteInto('a.position =?','right'))
		->where($this->quoteInto('a.status =?', 1))
	    ->limit(8);
		$select->order(array('a.indexs ASC'));
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchPollRow(){
		$select = parent::select();
		$select->from(array('a' => 'poll'))
		->where($this->quoteInto('a.status =?', 1))
		->limit(1);
		$select->order(array('a.id ASC'));
		$rs = parent::fetchAll($select);
		return $rs;
	}
	function fetchPollItemById($filter){
		$select = parent::select();
		$select->from(array('a' => 'poll_item'))
		->where($this->quoteInto('a.poll_id =?',$filter['poll_id']));
	
		$select->order(array('a.poll_id ASC'));
	
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchPollItemTotalById($filter){
		$select = parent::select();
		$select->from(array('a' => 'poll_item'),array('total'=>'SUM(vote)'))
		->where($this->quoteInto('a.poll_id =?',$filter['poll_id']));
	
		$select->order(array('a.poll_id ASC'));
	
		$rs = parent::fetchOne($select);
	
		return $rs;
	}
	function fetchHighlightLeftAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'highlight'))
		->where($this->quoteInto('a.position =?','left'))
		->where($this->quoteInto('a.status =?', 1))
	    ->limit(8);
		$select->order(array('a.indexs ASC'));
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchServiceAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'service'))
		->limit(10);
	
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
	
	function fetchLinkAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'links'))
		->limit(20);
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
	function insert_useronline($table,$data){
		return parent::insert($table,$data);
	}
	function delete_useronline($table,$timeput){
		$where[] = 'timestamp < '.$timeput;
		return parent::delete($table,$where);
	}
	function getUserOnlineNow($filter){
		$select = parent::select();
		$select->from(array('a' => 'useronline'),array('DISTINCT(ip)'))
		->where($this->quoteInto('a.file =?', $filter['file']));
		$rs = parent::fetchAll($select);
		return $rs;
	}
    function getUserOnlineDay($filter){
        $select = parent::select();
        $select->from(array('a' => 'useronline'),array('DISTINCT(ip)'))
            ->where('a.date =?',$filter['date']);
        $rs = parent::fetchAll($select);
        return $rs;
    }
	function fetchCounter(){
		$select = parent::select();
		$select->from(array('a' => 'counter'));
		$rs = parent::fetchRow($select);
		return $rs;
	}
	function fetchHighlightExpressAll(){
		$select = parent::select();
		$select->from(array('a' => 'highlight'))
		->where($this->quoteInto('a.position =?','express'))
		->where($this->quoteInto('a.status =?', 1));
		
		$select->order(array('a.indexs ASC'));
		$rs = parent::fetchAll($select);
		
		return $rs;
	}
	function update_counter($table,$data,$where){
		if($where){
			return parent::update($table,$data,$where);
		}
	}

}