<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Heighlight extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
	}
    public function all(){
        $this->load->library('paging');
        $this->template->set_template('frontend');
        $this->load->model('heighlight_model', 'heighlight');
        modules::run('template/frontend/header');
        modules::run('template/frontend/sidebar_left');
        $limit = 20;
        $page = ($this->input->get('pg'))?$this->input->get('pg'):1;
        $filter['start'] = $page;
        $filter['perpage'] = $limit;

        $rs_heighlight = $this->heighlight->fetchHeighlightAll($filter);
        $view = array(
            'heighlight' => $rs_heighlight,
            'breadcrumb'=> array('include_segments' => array('เกี่ยวกับเทศบาลนครปากเกร็ด')),
            'exclude' => array($this->uri->segment(1),$this->uri->segment(2))
        );
        $view['total_record'] = $rs_heighlight['row_count'];
        $this->paging->set($rs_heighlight['row_count'],$limit,10,$page);
        $this->paging->linkto(site_url('heighlight/all'));
        $html = $this->paging->render();
        $view['paging'] = $html;
        $this->template->write_view('content', 'heighlight/heighlight_all', $view);
        modules::run('template/frontend/footer');
        $this->template->render();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */