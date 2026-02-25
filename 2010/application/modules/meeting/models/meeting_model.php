<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Meeting_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchMeetingById($id){
		$select = parent::select();
		$select->from(array('a' => 'meeting'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
    function fetchMeetingAll($filter=''){
        $select = parent::select();
        $select->from(array('a' => 'meeting'))
            ->where('a.cate = ?',$filter['cate']);

        $select->order(array('a.id DESC'));
        if(isset($filter['start']) && isset($filter['perpage'])){
            $rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
        }else{
            $rs = parent::fetchAll($select);
        }


        return $rs;
    }

}
