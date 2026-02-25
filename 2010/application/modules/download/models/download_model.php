<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Download_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchDownloadAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'download'));
	
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
	function fetchDownloadById($id){
		$select = parent::select();
		$select->from(array('a' => 'download'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
	
	function fetchDownloadItemById($id){
		$select = parent::select();
		$select->from(array('a' => 'download_item'))
		->where('a.download_id = ?',$id);
		$rs = parent::fetchAll($select);
		return $rs;
	}
}
