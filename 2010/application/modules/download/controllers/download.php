<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Download extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($download_id) {
		$this->template->set_template('frontend');
		$this->load->model('download_model', 'download');
		modules::run('template/frontend/header');
		$rs_download = $this->download->fetchDownloadById($download_id);
		if($rs_download){
			$rs_download_item = $this->download->fetchDownloadItemById($rs_download['id']);
		}else{
			$rs_download_item = NULL;
		}
		
		modules::run('template/frontend/sidebar_left');
		$view = array(
					'breadcrumb'=> array('include_segments' => array(site_url('download/all') =>'ดาวน์โหลดแบบฟอร์ม',$rs_download['title'])),
					'exclude' => array($this->uri->segment(1))
				);
		$view['rs_download'] = isset($rs_download)?$rs_download:'';
		$view['rs_download_item'] = $rs_download_item;
		$this->template->write_view('content', 'download/download', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
	public function all(){
		$this->load->library('paging');
		$this->template->set_template('frontend');
		$this->load->model('download_model', 'download');
		modules::run('template/frontend/header');
		modules::run('template/frontend/sidebar_left');
		$limit = 20;
		$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
		$filter['start'] = $page;
		$filter['perpage'] = $limit;
		
		$rs_download = $this->download->fetchDownloadAll($filter);
		$view = array(
				'download' => $rs_download,
				'breadcrumb'=> array('include_segments' => array('ดาวน์โหลดแบบฟอร์ม')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2))
		);
		$view['total_record'] = $rs_download['row_count'];
		$this->paging->set($rs_download['row_count'],$limit,10,$page);
		$this->paging->linkto(site_url('download/all'));
		$html = $this->paging->render();
		$view['paging'] = $html;
		$this->template->write_view('content', 'download/download_all', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */