<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}
	public function index() {

	}
	function login(){

		$this->load->helper('cookie');
		$username = ($this->input->get_post('username',TRUE))?$this->input->get_post('username',TRUE):'';
		$password = ($this->input->get_post('password',TRUE))?$this->input->get_post('password',TRUE):'';
		$remember_password = ($this->input->get_post('remember_password',TRUE))?$this->input->get_post('remember_password',TRUE):'N';
	
		$message = '';
		$redirect = site_url('home');

		if($remember_password == 'Y'){
			$login_remember_data = array(
					$username => $password
			);
			my_set_cookie('Remember_password',$login_remember_data);
		}else{
			my_delete_cookie('Remember_password');
		}
		$response = $this->_login_action($username,$password);
		if($response){
			$status = 'success';
		}else{
			$status = 'fail';
			$message = 'รหัสผ่านไม่ถูกต้อง';
		}
		$data = array(
				'status' => $status,
				'message' => $message,
		);
	
		if(isset($_GET['callback'])){
			echo $_GET['callback'].'('.json_encode($data).')';
		}else{
			echo json_encode($data);
		}
	}
	function _login_action($username,$password){
		$this->load->model('member/member_model','member');
		$response = $this->member->login($username,$password);
		if($response){
			$_set_data = array(
					'm_id' => $response['member_id'],
					'name' => $response['name'],
					'picture' => $response['picture']
			);
			set_member_cookie($_set_data);

			return true;
		}else{
			return false;
		}
	
	}
	function logout(){
		delete_member_cookie();
		redirect(site_url());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */