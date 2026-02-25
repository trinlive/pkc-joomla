<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administator extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		echo 'Page Not Found';
	}
	/**
	 * 
	 * 
	 */
	public function header(){
		$header_view['user'] = get_user_cookie();
		$this->template->write_view('header', 'template/administator/header', $header_view);
	}
	function breadcrumb($data = NULL) {
		$view['breadcrumb'] = $data['breadcrumb'];
		$view['head_title'] = $data['head_title'];
		$this->template->write_view('breadcrumb', 'template/administator/breadcrumb',$view);
	}
	function sidebar()
	{
		$sidebar_view = array();
		$user = get_user_cookie();
		$sidebar_view['user'] = $user;
		$this->template->write_view('sidebar', 'template/administator/sidebar', $sidebar_view);
	}
	/**
	 * 
	 * 
	 */
	public function footer(){
		$this->template->write_view('footer', 'template/administator/footer');
	}
}
