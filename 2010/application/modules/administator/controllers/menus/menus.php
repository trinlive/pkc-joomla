<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menus extends MY_Controller{
    protected  $access_level_list = array(
        'Administator' => 'Administator'
    );

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
		is_login();
		$this->load->model(ADMIN_MODULE.'/menus/menus_model','admin_menus');
		
	}
	public function index(){
		$this->load->library('paging');
		$this->template->set_template('administator');
		$this->template->js_view(ADMIN_MODULE.'/menus/lists.js');
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(2));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		$perpage = 15;
		$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
		
		$view = array();
		
		$filter['start'] = $perpage*($page-1);
		$filter['perpage'] = $perpage;
		$rs_count = $this->admin_menus->fetchCountMenusAll($filter);
		$total_record = $rs_count['cn'];
		$view['total_record'] = $total_record;
		$view['number'] = $filter['start'];
		$rs = $this->admin_menus->fetchMenusAll($filter);
		if($rs){
			$view['menulist'] = $rs;
		}
		$this->paging->set($total_record,$perpage,5,$page);
		$this->paging->linkto(site_url(ADMIN_MODULE.'/menus'));
		$html = $this->paging->render();
		$view['paging'] = $html;
		$this->template->write_view('content',ADMIN_MODULE.'/menus/lists',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	public function create(){
		$data = array();
		$data['head_title'] = ucfirst($this->uri->segment(3));
		$data['form'] = 'form_create';
		$this->_form($data);
	}
	public function edit(){
		$data = array();
		$data['head_title'] = ucfirst($this->uri->segment(3));
		$data['form'] = 'form_edit';
		$this->_form($data);
	}
	public function _form($data){
		$this->template->set_template('administator');
		$this->template->js_view(ADMIN_MODULE.'/menus/form.js');
		$this->template->add_js('assets/js/libs/jquery.validate.min.js');
		modules::run('template/administator/header');
		modules::run('template/administator/breadcrumb',$data);
		modules::run('template/administator/sidebar');
		
		$menu_id = ($this->input->get('menu_id'))?$this->input->get('menu_id'):0;
		$rs_menus = $this->admin_menus->fetchMenusById($menu_id);
		
		if($rs_menus){
			$view['menus'] = $rs_menus;
		}

        $view['access_level_list'] = $this->access_level_list;

        $this->template->write_view('content',ADMIN_MODULE.'/menus/'.$data['form'],$view);
		 modules::run('template/administator/footer');
		$this->template->render();
	}
	public function action(){
		$this->template->set_template('administator');
		$breadcrumb = array();
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
		modules::run('template/administator/header');
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/sidebar');
		switch ($this->input->post('MM_action')):
		case 'create':
			$access_level = $this->input->get_post('access_level');
			$title = $this->input->get_post('title');
			if(is_array($access_level)){
				$level = implode(',', $access_level);
			}
			$data['access_level'] = $level;
			$data['title'] = $title;
			$menu_id = $this->admin_menus->insert($data);
			if($menu_id){
				$url = site_url(admin_module('/menus'));
				$getdata['msg'] ="<span>Add Menu Complete</span>";
				$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			}else{
				$getdata['msg']="<span>Add Menu Not Completed !!</span><br>";
				$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
			}
			break;
			
		case 'update':
			$access_level = $this->input->get_post('access_level');
			$title = $this->input->get_post('title');
			$menu_id = $this->input->get_post('menu_id');
			if(is_array($access_level)){
				$level = implode(',', $access_level);
			}
			$data['access_level'] = $level;
			$data['title'] = $title;
	
			$where = array();
			$where[] = 'id = '.$menu_id;
			$this->admin_menus->update($data,$where);

			$url = site_url(admin_module_2013('/menus'));
			$getdata['msg'] ="<span>Update Menu Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			break;
		case 'delete':
			$menu_id = $this->input->get_post('menu_id');
			$id = $this->admin_menus->delete($menu_id);
			return true;
			break;
		endswitch;
		$view = array(
				'message' => $getdata['msg'],
		);
		$this->template->write_view('content',ADMIN_MODULE.'/menus/action',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}

}
