<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller{
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
		is_login();
	}
	public function index(){
		$this->template->set_template('administator');
		modules::run('template/administator/header');

		$breadcrumb = array(
/* 				'breadcrumb'=> array('include_segments' =>array (
						'/some/link/'             => 'Most Popular',
						'/some/other/link'        => 'Post Title'
							)
						), */
				'head_title' => 'Dashboard'
		);
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/sidebar');
		$view = array();
		$this->template->write_view('content',ADMIN_MODULE.'/dashboard/dashboard',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
}
