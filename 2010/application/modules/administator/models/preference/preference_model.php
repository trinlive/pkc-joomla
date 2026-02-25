<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Preference_model extends MY_Model {

    function __construct() {
        parent::__construct();
	}
	function fetchMenusAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'menu'))
		->where('a.level= ?',$filter['level']);
	
		$select->order(array('a.indexs ASC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
		
	
		return $rs;
	}
	function fetchSubMenusById($filter){
		$select = parent::select();
		$select->from(array('a' => 'menu'))
		->where('a.level= ?',$filter['level'])
		->where('a.sub= ?',$filter['sub']);
		
		$select->order(array('a.indexs ASC'));
		
		//alert($select->__toString());
		$rs = parent::fetchAll($select);
		
		return $rs;
	}
	function fetchMenusById($id){
		$select = parent::select();
		$select->from(array('a' => 'menu'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
	function fetchContentsAll(){
		$select = parent::select();
		$select->from(array('a' => 'content'))
		->order(array('a.id DESC'));
		$rs = parent::fetchAll($select);
		return $rs;
	}
	/**
	 * (non-PHPdoc)
	 * @see MY_Model::insert()
	 */
	function fetchSlideAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'slide'));
	
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
    function fetchSlideById($id){
        $select = parent::select();
        $select->from(array('a' => 'slide'))
            ->where('a.id = ?',$id);
        $rs = parent::fetchRow($select);
        return $rs;
    }
	function fetchIntroById($id){
		$select = parent::select();
		$select->from(array('a' => 'intro'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}

    function fetchIntroAll($filter=''){
        $select = parent::select();
        $select->from(array('a' => 'intro'));

        $select->order(array('a.id DESC'));
        if(isset($filter['start']) && isset($filter['perpage'])){
            $rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
        }else{
            $rs = parent::fetchAll($select);
        }


        return $rs;
    }

	/**
	/**@method Link
	 * @param unknown_type $key
	 */
	function fetchLinkAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'links'));
	
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
	function fetchLinkById($id){
		$select = parent::select();
		$select->from(array('a' => 'links'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
	/**
	 * @method Highlight
	 */
	function fetcHighlightAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'highlight'));
		//->where('a.level= ?',$filter['level']);
	
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
	function fetchHighlightById($id){
		$select = parent::select();
		$select->from(array('a' => 'highlight'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
	/**
	 * @method Content
	 */
	function fetcContentAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'content'));
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
	function fetchUsersAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'users'));
	
		$select->order(array('a.id DESC'));
		if(isset($filter['start']) && isset($filter['perpage'])){
			$rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
		}else{
			$rs = parent::fetchAll($select);
		}
	
	
		return $rs;
	}
	function fetchUsersById($id){
		$select = parent::select();
		$select->from(array('a' => 'users'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
	function fetchContentById($id){
		$select = parent::select();
		$select->from(array('a' => 'content'))
		->where('a.id = ?',$id);
		$rs = parent::fetchRow($select);
		return $rs;
	}
	function fetchCheckEmail($email){
		$select = parent::select();
		$select->from(array('a' => 'users'),array('id','first_name','last_name','email'))
		->where('a.email = ?',trim($email));
		$rs = parent::fetchRow($select);
		return $rs;
	}
	
	function fetchCheckUsername($username){
		$select = parent::select();
		$select->from(array('a' => 'users'),array('id','first_name','last_name','username'))
		->where('a.username = ?',trim($username));
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
	function delete($table,$id){
		$where[] = 'id = '.$id;
		return parent::delete($table,$where);
	}
}