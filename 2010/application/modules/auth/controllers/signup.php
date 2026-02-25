<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Signup extends MY_Controller {
	public $secret = "6LdRWGQUAAAAACIxZ5A27RSVpPLx_45iacJ_1f8d";
	public function __construct() {
		parent::__construct();
		//$this->load->library('recaptcha');
		$this->load->helper('breadcrumb');
		$this->load->library('form_validation');
		$this->load->library('ReCaptchaResponse');
		
	}
	public function index($action=NULL) {
		switch ($action):
		case 'create':
			$data = array();
		$this->_signup_action();
		break;
		case 'validate_thai_id':
			$data = array();
			$this->_validate_thai_id();
			break;
			case 'check_thaiid':
				$data = array();
				$this->_check_thaiid();
				break;
		default:
		$this->template->set_template('frontend');
		$this->template->add_js('assets/js/libs/jquery.validate.min.js');
		//modules::run('template/frontend/header');
		//modules::run('template/frontend/sidebar_left');
		$member = get_member_cookie();
		$view = array(
				'breadcrumb'=> array('include_segments' => array('http://pakkretcity.go.th'=>'หน้าแรก','สมัครสมาชิกใหม่')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3))
		);
		// if(isset($_GET['captcha'])){
		// 	$refresh_captcha = '';
		// 	$view['captcha_error'] = sprintf('รหัสไม่ถูกต้อง',$refresh_captcha);
		// }
		// $view['recaptcha'] = $this->recaptcha->get_html();
		$this->template->write_view('content', 'auth/signup/form', $view);
		//modules::run('template/frontend/footer');
		$this->template->render();
		endswitch;
		
	}
	private function _signup_action(){
		$this->template->set_template('frontend');
		$this->load->model('member/member_model', 'member');
		//modules::run('template/frontend/header');
		//modules::run('template/frontend/sidebar_left');

		$config = array(
            
            array(
                'field' => 'idcard',
                'label' => 'กรุณากรอกรหัสบัตรประชาชน',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => lang("Please Enter %s"),
                ),
            ),
            array(
                'field' => 'g-recaptcha-response',
                'label' => 'กรุณากรอกรหัส',
                'rules' => 'required',
                'errors' => array(
                    'required' => lang("Please Enter %s"),
                ),
            ),
        );

		$this->form_validation->set_rules($config);
        $this->form_validation->set_message($config);
	

		$reCaptcha = new ReCaptcha($this->secret);

        if ($this->input->post("g-recaptcha-response")) {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $this->input->post("g-recaptcha-response")
            );
        }

		if ($this->form_validation->run() !== FALSE)
		{
			

				$member = $this->member->fetchCountMemberAll();
				$member_db = $member['cn']+1 ; // นำค่า id มาเพิ่มให้กับค่ารหัสสมาชิกครั้งละ1
				if($member_db >=100) {
					$member_in = "0$member_db" ;
				}else{
					if($member_db >=10) {
						$member_in = "00$member_db" ;
					}
					else {
						$member_in = "000$member_db" ;
					}
				}
				$yourcode = 'ip';
				$member_id = "$yourcode$member_in" ; // รหัสสมาชิกเช่น ip0001
				$signup = date("j/n/").(date("Y")+543) ;
				$pwd_name1 = $this->input->post('pwd_name1', TRUE);

				$data = array(
						'member_id'=> $member_id,
						'signup' => $signup,
						'idcard' => $this->input->post('idcard', TRUE),
						'name' => $this->input->post('name', TRUE),
						'date' => $this->input->post('date', TRUE),
						'month' => $this->input->post('month', TRUE),
						'year' => $this->input->post('year', TRUE),
						'age' => $this->input->post('age', TRUE),
						'sex' => $this->input->post('sex', TRUE),
						'address' => $this->input->post('address', TRUE),
						'amper' => $this->input->post('amper', TRUE),
						'province' => $this->input->post('province', TRUE),
						'zipcode' => $this->input->post('zipcode', TRUE),
						'phone' => $this->input->post('phone', TRUE),
						'username' => $this->input->post('user_name', TRUE),
						'password' => md5($pwd_name1),
						'email' => $this->input->post('email', TRUE),
	
				);
				// Create data to database.
				$member_id  = $this->member->insert('member',$data);
				if($member_id){
					$url = site_url('call');
					$getdata['msg'] ="<span>ท่านสมัครสมาชิก เรียบร้อยแล้ว </span>";
					$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
				}else{
					$getdata['msg']="<span>กรุณาติดต่อเจ้าหน้าที่ !!</span><br>";
					$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
				}
					
			
		}
	
		$view = array(
				'breadcrumb'=> array('include_segments' => array('http://pakkretcity.go.th'=>'หน้าแรก','สมัครสามาชิกใหม่')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3)),
				'message' => $getdata['msg']
		);
		$this->template->write_view('content','auth/signup/action',$view);
		//modules::run('template/frontend/footer');
		$this->template->render();
	}
	function _validate_thai_id()
	{
		$this->load->helper('validator');
		$id_card = $this->input->post('id_card', TRUE);
		$result = checkThaiCitizenID($id_card);
	
		echo $result;
	}
	public function _check_thaiid(){
		$id_card =  $this->input->get('id_card');
		$this->load->model('member/member_model', 'member');
		$rs = $this->member->fetchCheckThaiID($id_card);
		if($rs){
			if($rs['id'] == $id_card){
				echo 'true';
			}else{
				echo 'false';
			}
		}else{
			echo 'true';
		}
	}

}
?>
