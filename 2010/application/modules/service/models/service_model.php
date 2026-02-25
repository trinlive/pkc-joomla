<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Service_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchServiceById($id){
		$select = parent::select();
		$select->from(array('a' => 'service'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
    function fetchServiceAll($filter=''){
        $select = parent::select();
        $select->from(array('a' => 'service'));

        $select->order(array('a.id DESC'));
        if(isset($filter['start']) && isset($filter['perpage'])){
            $rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
        }else{
            $rs = parent::fetchAll($select);
        }


        return $rs;
    }

}
