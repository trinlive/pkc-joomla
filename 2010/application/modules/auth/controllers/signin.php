<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Signin extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
	}
	public function index() {
		//is_member_login();
		$this->popup();
		
	}
	function popup(){
		$this->template->set_template('frontend_blank');
		$this->template->add_js('assets/js/libs/jquery.validate.min.js');
		$this->template->add_js('assets/js/libs/jquery.watermark.min.js');
		$this->template->add_css('assets/layouts/frontend/css/login.css');

		$view = array();
		$register_url = $this->input->get('register_url',TRUE);
		$reidrect = $this->input->get('ref',TRUE);
		if($reidrect != ''){
			$_SESSION['login_redirect'] = $reidrect;
		}else{
			$_SESSION['login_redirect'] = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
		}

		$view['register_url'] = ($register_url != '')?$register_url:site_url('auth/signup');
		$this->template->write_view('content','auth/signin/signin_popup',$view);
		$this->template->render();
	}
}
?>
