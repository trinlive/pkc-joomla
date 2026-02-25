<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Menus_model extends MY_Model {

    function __construct() {
        parent::__construct();
	}
	function fetchMenusAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'menus'),array('id','title','access_level'))
		->where('a.id > ?','0');
	
		$select->order(array('a.id ASC'))
		->limit($filter['perpage'],$filter['start']);
		$rs = parent::fetchAll($select);
	
		return $rs;
	}
	function fetchCountMenusAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'menus'),array('cn' => 'count(*)'))
		->where('a.id > ?','0');
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function fetchMenusById($menu_id){
		$select = parent::select();
		$select->from(array('a' => 'menus'),array('id','title','access_level'))
		->where('a.id = ?',$menu_id);
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function insert($data){
		return parent::insert('menus',$data);
	}
	function update($data,$where){
		if($where){
			return parent::update('menus',$data,$where);
		}
	}
	function delete($menu_id){
		$where[] = 'id = '.$menu_id;
		return parent::delete('menus',$where);
	}
}