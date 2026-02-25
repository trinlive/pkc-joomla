<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Content_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
	function fetchPageById($page_id){
		$select = parent::select();
		$select->from(array('a' => 'menu'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.id =?',$page_id));
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
	function fetchContentById($content_id){
		$select = parent::select();
		$select->from(array('a' => 'content'))
		->where($this->quoteInto('a.status =?',1))
		->where($this->quoteInto('a.id =?',$content_id));
		$rs = parent::fetchRow($select);
	
		return $rs;
	}
    function fetchContent($content_id){
        $select = parent::select();
        $select->from(array('a' => 'content'))
            ->where($this->quoteInto('a.status =?',1))
            ->where($this->quoteInto('a.id =?',$content_id));
        $rs = parent::fetchRow($select);

        return $rs;
    }
}
