<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Activity extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($activity_id) {
		$this->template->set_template('frontend');
		
		$this->load->model('activity_model', 'activity');
		modules::run('template/frontend/header');
		$rs_activity = $this->activity->fetchActivityById($activity_id);
		$rs_activity_thumb = $this->activity->fetchActivityThumbById($activity_id);
		modules::run('template/frontend/sidebar_left');
		$view = array(
					'data' => $rs_activity,
					'data_thumb' => $rs_activity_thumb,
					'breadcrumb'=> array('include_segments' => array('activity/all/' => 'ภาพข่าวกิจกรรม',$rs_activity['title'])),
					'exclude' => array($this->uri->segment(1))
				);
		$this->template->write_view('content', 'activity/activity', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
	public function all() {
		$this->load->library('paging');
		$this->template->set_template('frontend');
		$this->load->model('activity_model', 'activity');
		modules::run('template/frontend/header');
		modules::run('template/frontend/sidebar_left');
		$limit = 20;
		$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
		$filter['start'] = $page;
		$filter['perpage'] = $limit;
		$filter['cate_id'] = 1;
		
		$rs_activity = $this->activity->fetchActivityAll($filter);
		$view = array(
				'activity' => $rs_activity,
				'breadcrumb'=> array('include_segments' => array('ภาพกิจกรรม')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3))
		);
		$view['total_record'] = $rs_activity['row_count'];
		$this->paging->set($rs_activity['row_count'],$limit,10,$page);
		$this->paging->linkto(site_url('activity/all'));
		$html = $this->paging->render();
		$view['paging'] = $html;
		$this->template->write_view('content', 'activity/activity_all', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */