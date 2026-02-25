<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class MY_Controller extends MX_Controller
{
	function __construct(){
		parent::__construct();
		if(!defined('MY_CONTROLLER_LOADED')){
			define('MY_CONTROLLER_LOADED',1);
			define('IS_LOGIN',get_user_cookie('user_id'));
			define('IS_MEMBER_LOGIN',get_member_cookie('m_id'));
			if($this->input->get('debug')){
				define('DEBUG',TRUE);
			}else{
				define('DEBUG',FALSE);
			}
		
		
		}
	}
}
