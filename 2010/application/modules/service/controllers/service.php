<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Service extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($service_id) {
		$this->template->set_template('frontend');
		$this->load->model('service_model', 'service');
		modules::run('template/frontend/header');
		$rs = $this->service->fetchServiceById($service_id);
		modules::run('template/frontend/sidebar_left');
		$view = array(
					'data' => $rs,
					'breadcrumb'=> array('include_segments' => array($rs['title'])),
					'exclude' => array($this->uri->segment(1))
				);
		$this->template->write_view('content', 'service/service', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
    public function all(){
        $this->load->library('paging');
        $this->template->set_template('frontend');
        $this->load->model('service_model', 'service');
        modules::run('template/frontend/header');
        modules::run('template/frontend/sidebar_left');
        $limit = 20;
        $page = ($this->input->get('pg'))?$this->input->get('pg'):1;
        $filter['start'] = $page;
        $filter['perpage'] = $limit;

        $rs_service = $this->service->fetchServiceAll($filter);
        $view = array(
            'service' => $rs_service,
            'breadcrumb'=> array('include_segments' => array('การบริการประชาชน')),
            'exclude' => array($this->uri->segment(1),$this->uri->segment(2))
        );
        $view['total_record'] = $rs_service['row_count'];
        $this->paging->set($rs_service['row_count'],$limit,10,$page);
        $this->paging->linkto(site_url('service/all'));
        $html = $this->paging->render();
        $view['paging'] = $html;
        $this->template->write_view('content', 'service/service_all', $view);
        modules::run('template/frontend/footer');
        $this->template->render();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */