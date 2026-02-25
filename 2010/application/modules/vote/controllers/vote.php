<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vote extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('vote_model','vote');
		$this->load->library('session');
	}
	public function index() {
		if(!empty($_POST['ch'])){
			$ch = $this->input->post('ch',TRUE);
			$poll_item = $this->vote->fetchPollItemId($ch);
			$data['vote'] = $poll_item['vote']+1;
			$where[] = 'poll_item.id = '.$ch;
			$poll = $this->vote->update('poll_item',$data,$where);
			if(!empty($poll)){
				unset($data);
				$data['poll_id'] = $this->input->post('ch',TRUE);
				$data['session'] = $this->session->userdata('session_id');
				$data['ip'] = $this->input->ip_address();
				$this->vote->insert('poll_log',$data);
			}
		} 
		return true;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */