<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Heighlight_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}
    function fetchHeighlightAll($filter=''){
        $select = parent::select();
        $select->from(array('a' => 'highlight'))
            ->where($this->quoteInto('a.position =?','left'))
            ->where($this->quoteInto('a.status =?', 1));

        $select->order(array('a.id DESC'));
        if(isset($filter['start']) && isset($filter['perpage'])){
            $rs = parent::fetchPage($select,NULL,$filter['start'],$filter['perpage']);
        }else{
            $rs = parent::fetchAll($select);
        }


        return $rs;
    }

}
