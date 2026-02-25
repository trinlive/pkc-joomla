<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Auction extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($category = NULL) {
		switch ($category):
		case 'checkauction':
			$data = array(
					'table' => 'checkauction',
					'path' => 'checkauction'
			);
		$this->_auction_all($data);
		break;
		case 'auction':
			$data = array(
				'table' => 'auction',
				'path' => 'auction'
			);
		$this->_auction_all($data);
		break;
		case 'planauction':
			$data = array(
			'table' => 'planauction',
			'path' => 'planauction'
					);
		$this->_auction_all($data);
		break;
		case 'finauction':
			$data = array(
			'table' => 'finauction',
			'path' => 'finauction'
					);
		$this->_auction_all($data);
		break;
		case 'reportauction':
			$data = array(
			'table' => 'reportauction',
			'path' => 'reportauction'
					);
		$this->_auction_all($data);
		break;
		case 'rightauction':
			$data = array(
			'table' => 'rightauction',
			'path' => 'rightauction'
					);
		$this->_auction_all($data);
		break;

		default:
		$this->template->set_template('frontend');
		$this->load->model('auction_model', 'auction');
		modules::run('template/frontend/header');
		modules::run('template/frontend/sidebar_left');
		$view = array(
					'breadcrumb'=> array('include_segments' => array(site_url('auction/all') =>'ข่าวประกวดราคา')),
					'exclude' => array($this->uri->segment(1))
				);
		$this->template->write_view('content', 'auction/auction', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
		endswitch;
	}
	public function _auction_all($data){
		$this->load->library('paging');
		$this->template->set_template('frontend');
		$this->load->model('auction_model', 'auction');
		modules::run('template/frontend/header');
		modules::run('template/frontend/sidebar_left');
		$limit = 20;
		$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
		$filter['start'] = $page;
		$filter['perpage'] = $limit;
		$filter['table'] = $data['table'];
		$filter['status'] = '1';
		
		$rs_auction = $this->auction->fetchAuctionAll($filter);
		$view = array(
				'auction' => $rs_auction,
				'breadcrumb'=> array('include_segments' => array('ข่าวประกวดราคา')),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2))
		);
		$view['total_record'] = $rs_auction['row_count'];
		$this->paging->set($rs_auction['row_count'],$limit,10,$page);
		$this->paging->linkto(site_url('auction/'.$data['table']));
		$html = $this->paging->render();
		$view['paging'] = $html;
		$view['path'] = $data['path'];
		$this->template->write_view('content', 'auction/auction_all', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */