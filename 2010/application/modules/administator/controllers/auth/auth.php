<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Auth extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Redirect go to Login 
	 * 
	 */
	public function index()
	{
		
		$this->template->set_template('administator_login');
		$this->template->render();
	}
	/**
	 * Function Login for Admin
	 * 
	 */
	public function login()
	{
		$this->load->model(ADMIN_MODULE.'/auth/auth_model','auth');
		$submit = $this->input->post('submit',TRUE);
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		$remember = $this->input->post('remember',TRUE);

		if(strtolower($submit) == 'sign in'){
			$rs = $this->auth->login($username,$password);
			if($rs){
				$_set_data = array(
						'user_id'=> $rs['id'],
						'firstname' => $rs['first_name'],
						'lastname' => $rs['last_name'],
						'username' => $rs['username'],
						'role' => $rs['role'],
						'remember' => $remember
				);
				set_user_cookie($_set_data);
		
				redirect(site_url(ADMIN_MODULE.'/dashboard'));
			}else{
				redirect(site_url(ADMIN_MODULE.'/auth'));
			}
		}else{
			redirect(site_url(ADMIN_MODULE.'/auth'));
		}
	}
	function logout(){
		delete_user_cookie();
		redirect(site_url(ADMIN_MODULE.'/auth'));
	}

}
