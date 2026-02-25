<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class News extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($news_id) {
		$this->template->set_template('frontend');
		$this->load->model('news_model', 'news');
		modules::run('template/frontend/header');
		$rs_news = $this->news->fetchNewsById($news_id);

		$this->head->meta = array('<meta property="og:image" content="'.site_assets_url('images/news/'.$rs_news['image']).'"/>');
		switch ($rs_news['category_id']){
			case '1':
				$type = 'ข่าวประชาสัมพันธ์';
				$key = 'pr';
				break;
            case '2':
                $type = 'ข่าวกิจกรรม';
                $key = 'event';
                break;
			default:
				$type = '';
				$key = '';
				break;
		}
		modules::run('template/frontend/sidebar_left');
		$view = array(
					'data' => $rs_news,
					'breadcrumb'=> array('include_segments' => array('news/'.$key.'/all/' => $type,$rs_news['title'])),
					'exclude' => array($this->uri->segment(1))
				);
		$this->template->write_view('content', 'news/news', $view);
		//modules::run('template/frontend/sidebar_right');
		modules::run('template/frontend/footer');
		$this->template->render();
	}
	public function all($type) {
		$this->load->library('paging');
		$this->template->set_template('frontend');
		$this->load->model('news_model', 'news');
		modules::run('template/frontend/header');
		switch ($type){
			case 'pr':
				$cate_id = 1;
				$title = 'ข่าวประชาสัมพันธ์';
				break;
            case 'event':
                $cate_id = 2;
                $title = 'ข่าวกิจกกรม';
                break;
			default:
				$cate_id = '';
				$title = '';
				break;
		}
		$limit = 12;
		$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
		$filter['start'] = $page;
		$filter['perpage'] = $limit;
		$filter['cate_id'] = $cate_id;

		
		$rs_news = $this->news->fetchNewsAll($filter);
		modules::run('template/frontend/sidebar_left');
		$view = array(
				'news' => $rs_news,
                'title' => $title,
                'cate_id' => $cate_id,
				'breadcrumb'=> array('include_segments' => array($title)),
				'exclude' => array($this->uri->segment(1),$this->uri->segment(2),$this->uri->segment(3))
		);
		$view['total_record'] = $rs_news['row_count'];
		$this->paging->set($rs_news['row_count'],$limit,3,$page);
		$this->paging->linkto(site_url('news/'.$type.'/all'));
		$html = $this->paging->render();
		$view['paging'] = $html;
		$this->template->write_view('content', 'news/news_all', $view);
		//modules::run('template/frontend/sidebar_right');
		modules::run('template/frontend/footer');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */