<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Intro_model extends MY_Model
{
	function __construct(){
		parent::__construct();
	}

	function fetchIntroAll($filter=''){
		$select = parent::select();
		$select->from(array('a' => 'intro'))
		->where($this->quoteInto('a.status =?', 1))
        ->where('('.$this->quoteInto('a.start_date <= ?', date('Y-m-d H:i:s')).' AND '.$this->quoteInto('a.end_date >= ?', date('Y-m-d H:i:s')).') OR ('.$this->quoteInto('a.start_date = ?', '0000-00-00 00:00:00').' AND '.$this->quoteInto('a.end_date = ?', '0000-00-00 00:00:00').')');
		$select->order(array('a.level DESC'));
		$rs = parent::fetchRow($select);
	
		return $rs;
	}

}
