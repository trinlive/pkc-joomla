<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Content extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
	public function index($page_id) {
		$this->template->set_template('frontend');
		$this->load->model('content_model', 'content');
		modules::run('template/frontend/header');
		$rs = $this->content->fetchPageById($page_id);
		$rs_content = $this->content->fetchContentById($rs['content']);
		modules::run('template/frontend/sidebar_left');
		$view = array(
					'data' => $rs_content,
                    'name' => $rs['name'],
					'breadcrumb'=> array('include_segments' => array($rs['name'])),
					'exclude' => array($this->uri->segment(1))
				);
		$this->template->write_view('content', 'content/content', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
	public function heighlight($content_id) {
		$this->template->set_template('frontend');
		$this->load->model('content_model', 'content');
		modules::run('template/frontend/header');
		$rs_content = $this->content->fetchContentById($content_id);
		modules::run('template/frontend/sidebar_left');
		$view = array(
				'data' => $rs_content,
                'name' => $rs_content['name'],
				'breadcrumb'=> array('include_segments' => array($rs_content['name'])),
				'exclude' => array($this->uri->segment(1))
		);
		$this->template->write_view('content', 'content/content', $view);
		modules::run('template/frontend/footer');
		$this->template->render();
	}
    public function heighlight_all() {
        $this->template->set_template('frontend');
        $this->load->model('content_model', 'content');
        modules::run('template/frontend/header');
        $rs_content = $this->content->fetchContentById($content_id);
        modules::run('template/frontend/sidebar_left');
        $view = array(
            'data' => $rs_content,
            'name' => $rs_content['name'],
            'breadcrumb'=> array('include_segments' => array($rs_content['name'])),
            'exclude' => array($this->uri->segment(1))
        );
        $this->template->write_view('content', 'content/content', $view);
        modules::run('template/frontend/footer');
        $this->template->render();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */