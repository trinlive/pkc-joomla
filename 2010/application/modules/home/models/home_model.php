<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchSpecialAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'special'))
		->where($this->quoteInto('a.status =?', 1));
	
		$select->order(array('a.id DESC'));
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchNewsByCateId($cate_id){
		$select = parent::select();
		$select->from(array('a' => 'news'))
		->where($this->quoteInto('a.category_id =?', $cate_id))
		->limit(3);
		$select->order(array('a.id DESC'));
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchSlideAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'slide'))
		->where($this->quoteInto('a.status =?', 1))
        ->where('('.$this->quoteInto('a.start_date <= ?', date('Y-m-d H:i:s')).' AND '.$this->quoteInto('a.end_date >= ?', date('Y-m-d H:i:s')).') OR ('.$this->quoteInto('a.start_date = ?', '0000-00-00 00:00:00').' AND '.$this->quoteInto('a.end_date = ?', '0000-00-00 00:00:00').')');
		$select->order(array('a.level DESC'));
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchActivityAll(){
		$select = parent::select();
		$select->from(array('a' => 'activity'))
		->where($this->quoteInto('a.status =?', 1));
		$select->order(array('a.id DESC'));
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchDownloadAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'download'))
		->limit(7);
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}

    function fetchAuctionAll($filter=''){
        $select = parent::select();
        $select->from(array('a' => $filter['table']))
            ->where($this->quoteInto('a.status =?',1))
            ->limit(7);
        $select->order(array('a.id DESC'));
        if(isset($filter['start']) && isset($filter['perpage'])){
            $rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
        }else{
            $rs = parent::fetchAll($select);
        }


        return $rs;
    }

    function fetchMeetingAll($filter=''){
        $select = parent::select();
        $select->from(array('a' => $filter['table']))
            ->where($this->quoteInto('a.cate =?',$filter['cate']))
            ->where($this->quoteInto('a.status =?',1))
            ->limit(7);
        $select->order(array('a.id DESC'));
        if(isset($filter['start']) && isset($filter['perpage'])){
            $rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
        }else{
            $rs = parent::fetchAll($select);
        }


        return $rs;
    }
}
