<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Call extends MY_Controller {
	public $secret = "6LdRWGQUAAAAACIxZ5A27RSVpPLx_45iacJ_1f8d";
	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
		$this->load->library('form_validation');
		$this->load->library('ReCaptchaResponse');
		$this->load->library('fotoupload');
	}
	public function index($action=NULL) {
		switch ($action):
		case 'create':
			$data = array();
			$this->_call_action();
		break;
		case 'view':
			$this->_call_view();
			break;
		case 'new':
			$data = array(
				'action'=> 'create'
			);
			$this->_call_form($data);
			break;
		default:
		$this->load->library('paging');
		$this->template->set_template('frontend');
		$this->load->model('call_model', 'call');
		//modules::run('template/frontend/header');
		//modules::run('template/frontend/sidebar_left');
		$limit = 20;
		$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
		$filter['start'] = $page;
		$filter['perpage'] = $limit;
		$filter['cate_id'] = 1;
		
		$rs_call = $this->call->fetchCallAll($filter);
		if(isset($_GET['debug_data'])){
			alert($rs_call);
		}
		$view = array(
				'call' => $rs_call,
				'breadcrumb'=> array('include_segments' => array('สายตรงเทศบาล')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3))
		);
		$view['total_record'] = $rs_call['row_count'];
		$this->paging->set($rs_call['row_count'],$limit,5,$page);
		$this->paging->linkto(site_url('call/index'));
		$html = $this->paging->render();
		$view['number'] = ($page - 1)*$limit;
		$view['paging'] = $html;
		$this->template->write_view('content', 'call/call_all', $view);
		//modules::run('template/frontend/footer');
		$this->template->render();
		endswitch;
	}
	private function _call_form($data=array()){
			is_member_login();
		$this->template->set_template('frontend');
		$this->template->add_js('assets/js/libs/jquery.validate.min.js');
		//modules::run('template/frontend/header');
		//modules::run('template/frontend/sidebar_left');
		$member = get_member_cookie();
		$view = array(
				//'breadcrumb'=> array('include_segments' => array(site_url('call')=>'สายตรงเทศบาล','ตั้งคำถามใหม่')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3))
		);

		$view['action'] = $data['action'];
		$view['member'] = $member;
		
		$this->template->write_view('content', 'call/call_form', $view);
		//modules::run('template/frontend/footer');
		$this->template->render();
	}
	private function _call_view($data=array()){
		$this->template->set_template('frontend');
		//modules::run('template/frontend/header');
		//modules::run('template/frontend/sidebar_left');
		$this->load->model('call_model', 'call');
	
		$call_id = ($this->input->get_post('call_id',TRUE))?$this->input->get_post('call_id',TRUE):0;
		$rs_call = $this->call->fetchCallById($call_id);
		
		$rs_call_reply = $this->call->fetchCallReplyById($call_id);

		if(isset($_GET['debug_data'])){
			alert($rs_slide);
		}
		$view = array(
				'breadcrumb'=> array('include_segments' => array(site_url('call')=>'สายตรงเทศบาล',$rs_call['title'])),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3))
		);
		$view['rs_call'] = isset($rs_call)?$rs_call:'';
		$view['rs_call_reply'] = $rs_call_reply;
		$this->template->write_view('content','call/views',$view);
		//modules::run('template/frontend/footer');
		$this->template->render();
	}
	private function _call_action(){
		$this->template->set_template('frontend');
		$this->load->model('call_model', 'call');
		//modules::run('template/frontend/header');
		//modules::run('template/frontend/sidebar_left');

		$config = array(
			array(
                'field' => 'title',
                'label' => 'กรุณากรอกคำถาม',
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
	
		$member = get_member_cookie();

		if ($this->form_validation->run() !== FALSE)
		{
			
				
				$thmhandle = new upload($_FILES['image']);
				//$issize = getimagesize($_FILES['image'][tmp_name]);
				if ($thmhandle->uploaded) :
				//if ($issize[0] > 542 ) :
				//$thmhandle->image_resize	= true;
				
				$thmhandle->image_convert = 'jpg';
				$thmhandle->file_auto_rename = true;
				$thmhandle->image_ratio_y = true;
				//endif ;
				$thmhandle->Process('./assets/uploads/img_call');
				
				if ($thmhandle->processed):
				$new_imagename3 =  $thmhandle->file_dst_name ;
				$file = $new_imagename3 ;
				$thmhandle->clean();
				else :
				echo 'error : ' . $thmhandle->error;
				endif ;
				endif ;
				
				$data = array(
						'title' => $this->input->post('title', TRUE),
						'detail' => $this->input->post('detail', FALSE),
						'name' => $member['name'],
						'datepost' => time_zone_asia(),
						'ip' => $this->input->ip_address(),
						'file' => isset($file)?$file:'',
						'status' => 0
		
				);
	
				// Create data to database.
				$call_id  = $this->call->insert('callcenter',$data);
				if($call_id){
					$url = site_url('call');
					$getdata['msg'] ="<span>ระบบได้รับคำถามของท่านแล้ว</span>";
					$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
				}else{
					$getdata['msg']="<span>กรุณาติดต่อเจ้าหน้าที่ !!</span><br>";
					$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
				}
					
			
		}	

		$view = array(
				'breadcrumb'=> array('include_segments' => array(site_url('call')=>'สายตรงเทศบาล','ตั้งคำถามใหม่')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3)),
				'message' => $getdata['msg']
		);
		$this->template->write_view('content','call/action',$view);
		//modules::run('template/frontend/footer');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */