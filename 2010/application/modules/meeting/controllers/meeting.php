<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Meeting extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($meeting_id) {
		$this->template->set_template('frontend');
		$this->load->model('meeting_model', 'meeting');
		modules::run('template/frontend/header');
		$rs = $this->meeting->fetchMeetingById($meeting_id);
		modules::run('template/frontend/sidebar_left');
		$view = array(
					'data' => $rs,
					'breadcrumb'=> array('include_segments' => array($rs['title'])),
					'exclude' => array($this->uri->segment(1))
				);
		$this->template->write_view('content', 'meeting/meeting', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
    public function all($id){
        $this->load->library('paging');
        $this->template->set_template('frontend');
        $this->load->model('meeting_model', 'meeting');
        modules::run('template/frontend/header');
        modules::run('template/frontend/sidebar_left');
        $limit = 20;
        $page = ($this->input->get('pg'))?$this->input->get('pg'):1;
        $filter['start'] = $page;
        $filter['perpage'] = $limit;
        $filter['cate'] = $id;

        if($id == 1){
            $title = 'การประชุมสภาเทศบาล';
        }

        if($id == 2){
            $title = 'การประชุมหัวหน้าส่วนราชการ';
        }

        if($id == 3){
            $title = 'รายงานการประชุมคณะกรรมการชุมชน';
        }


        $rs_meeting = $this->meeting->fetchMeetingAll($filter,1);
        $view = array(
            'meeting' => $rs_meeting,
            'breadcrumb'=> array('include_segments' => array($title)),
            'exclude' => array($this->uri->segment(1),$this->uri->segment(2))
        );
        $view['total_record'] = $rs_meeting['row_count'];
        $this->paging->set($rs_meeting['row_count'],$limit,10,$page);
        $this->paging->linkto(site_url('meeting/all'));
        $html = $this->paging->render();
        $view['paging'] = $html;
        $this->template->write_view('content', 'meeting/meeting_all', $view);
        modules::run('template/frontend/footer');
        $this->template->render();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */