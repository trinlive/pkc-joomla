<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($category = NULL) {
        $this->_account_all($category);
	}
	public function _account_all($category){
		$this->load->library('paging');
		$this->template->set_template('frontend');
		$this->load->model('account_model', 'account');
		modules::run('template/frontend/header');
		modules::run('template/frontend/sidebar_left');
		$limit = 20;
		$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
		$filter['start'] = $page;
		$filter['perpage'] = $limit;
		$filter['status'] = '1';
		$filter['cate'] = $category;

        if($category == 1){
            $title = 'การโอนเงินงบประมาณรายจ่ายประจำปี ';
        }else if($category == 2){
            $title = 'งบการเงิน ';
        }else if($category == 3){
            $title = 'งบแสดงฐานะการเงิน ';
        }else if($category == 4){
            $title = 'รายงานแสดงผลการดำเนินงาน ';
        }else if($category == 5){
            $title = 'ประกาศรายงานการรับจ่ายเงิน ';
        }

		
		$rs_account = $this->account->fetchAccountAll($filter);
		$view = array(
				'account' => $rs_account,
				'breadcrumb'=> array('include_segments' => array('รายงานทางการเงิน',$title)),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2))
		);
		$view['total_record'] = $rs_account['row_count'];
		$this->paging->set($rs_account['row_count'],$limit,10,$page);
		$this->paging->linkto(site_url('account/'.$category));
		$html = $this->paging->render();
		$view['paging'] = $html;
		$view['title'] = $title;
		$this->template->write_view('content', 'account/account_all', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */