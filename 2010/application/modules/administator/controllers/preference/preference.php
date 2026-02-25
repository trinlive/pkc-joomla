<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Preference extends MY_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
		is_login();
		$this->load->model(ADMIN_MODULE.'/preference/preference_model','admin_preference');
		$user = get_user_cookie();
		
	}
	public function index(){
		echo 'test';
	}
	public function users($action=NULL){
		switch ($action):
		case 'create':
			$data = array();
		$this->_users_action();
		break;
		case 'update':
			$data = array();
			$this->_users_action();
			break;
		case 'delete':
			$data = array();
			$this->_users_action();
			break;
		case 'new':
			$data = array(
			'action'=> 'create'
					);
					$this->_users_form($data);
					break;
		case 'edit':
			$data = array(
			'action'=> 'update'
					);
					$this->_users_form($data);
					break;
		default:
			$this->load->library('paging');
			$this->template->set_template('administator');
			$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
			modules::run('template/administator/breadcrumb',$breadcrumb);
			modules::run('template/administator/header');
			modules::run('template/administator/sidebar');
			$limit = LIMIT_PAGE;
			$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
			$filter['start'] = $page;
			$filter['perpage'] = $limit;
			$users = $this->admin_preference->fetchUsersAll($filter);
		
			if($users){
				$view['userslist'] = $users;
			}
			$view['total_record'] = $users['row_count'];
			$this->paging->set($users['row_count'],$limit,10,$page);
			$this->paging->linkto(site_url(admin_module('preference/users')));
			$html = $this->paging->render();
			$view['paging'] = $html;
			$this->template->write_view('content',ADMIN_MODULE.'/preference/users/lists',$view);
			modules::run('template/administator/footer');
			$this->template->render();
			endswitch;
	}
	private function _users_form($data=array()){
		$this->template->set_template('administator');
		$this->template->add_js('assets/js/libs/jquery.validate.min.js');
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
	
		$users_id = ($this->input->get_post('users_id',TRUE))?$this->input->get_post('users_id',TRUE):0;
		$rs_users = $this->admin_preference->fetchUsersById($users_id);
	
		if(isset($_GET['debug_data'])){
			alert($rs_users);
		}
		$view['user'] = get_user_cookie();
		$view['rs_users'] = isset($rs_users)?$rs_users:'';
		$view['action'] = $data['action'];
		$this->template->write_view('content',ADMIN_MODULE.'/preference/users/form',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	private function _users_action(){
		$this->template->set_template('administator');
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		switch ($this->input->post('MM_action')):
		case 'create':
	
		$data['role'] = $this->input->post('role',TRUE);
		$data['first_name'] = $this->input->post('first_name',TRUE);
		$data['last_name'] = $this->input->post('last_name',TRUE);
		$data['email'] = $this->input->post('email',TRUE);
		$data['username'] = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		$data['password'] = md5($password);
		$data['register_date'] = time_zone_asia();
		$data['status'] = $this->input->post('status',TRUE);
			
	
		$user_id = $this->admin_preference->insert('users',$data);
			
		if($user_id){
			$url = site_url(admin_module('preference/users'));
			$getdata['msg'] ="<span>Add User Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
		}else{
			$getdata['msg']="<span>Add User Not Completed !!</span><br>";
			$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
		}
	
		$head_title = "create";
		break;
		case 'update':
			$data['role'] = $this->input->post('role',TRUE);
			$data['first_name'] = $this->input->post('first_name',TRUE);
			$data['last_name'] = $this->input->post('last_name',TRUE);
			$data['email'] = $this->input->post('email',TRUE);
			$data['status'] = $this->input->post('status',TRUE);
			$user_id = $this->input->post('user_id',TRUE);
	
			$where[] = 'id = '.$user_id;
			$this->admin_preference->update('users',$data,$where);
	
			$url = site_url(admin_module('preference/users'));
			$getdata['msg'] ="<span>Update User Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			$head_title = "update";
			break;
		case 'delete':
			$user_id = $this->input->get_post('user_id');
			$id = $this->admin_preference->delete('users',$user_id);
			return true;
			break;
			endswitch;
			$breadcrumb['head_title'] = ucfirst($head_title);
			modules::run('template/administator/breadcrumb',$breadcrumb);
			$view = array(
					'message' => $getdata['msg'],
					'head_title'=> $head_title
			);
			$this->template->write_view('content',ADMIN_MODULE.'/preference/users/action',$view);
			modules::run('template/administator/footer');
			$this->template->render();
	}
	public function menu($action=NULL){
		switch ($action):
		case 'create':
			$data = array();
			$this->_menu_action();
			break;
		case 'update':
			$data = array();
			$this->_menu_action();
			break;
		case 'delete':
			$data = array();
			$this->_menu_action();
			break;
		case 'new':
			$data = array(
				'action'=> 'create'
			);
			$this->_menu_form($data);
			break;
		case 'edit':
			$data = array(
				'action'=> 'update'
			);
			$this->_menu_form($data);
			break;
			default:
			$this->load->library('paging');
			$this->template->set_template('administator');
			$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
			modules::run('template/administator/breadcrumb',$breadcrumb);
			modules::run('template/administator/header');
			modules::run('template/administator/sidebar');
			$limit = LIMIT_PAGE;
			$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
			$filter['start'] = $page;
			$filter['perpage'] = $limit;
			$filter['level'] = 'main';
			$main_menu = $this->admin_preference->fetchMenusAll($filter);
			if(isset($main_menu['rows'])){
				foreach ($main_menu['rows'] as $main){
					$data = $main;
					$filter_main['level'] = 'sub';
					$filter_main['sub'] = $main['id'];
					$data['sub_menu'] = $this->admin_preference->fetchSubMenusById($filter_main);
					if(isset($data['sub_menu'])){
						foreach ($data['sub_menu'] as $key=>$submenu){
							$filter_sub_main['level'] = 'link';
							$filter_sub_main['sub'] = $submenu['id'];
							$data['sub_menu'][$key]['sub_link_menu'] = $this->admin_preference->fetchSubMenusById($filter_sub_main);
						}
					}
					$menu_temp[] = $data;
				}
			}
			if($menu_temp){
				$view['menulist'] = $menu_temp;
			}
			$view['total_record'] = $main_menu['row_count'];
			$this->paging->set($main_menu['row_count'],$limit,10,$page);
			$this->paging->linkto(site_url(admin_module('preference/menu')));
			$html = $this->paging->render();
			$view['paging'] = $html;
			$this->template->write_view('content',ADMIN_MODULE.'/preference/menu/lists',$view);
			modules::run('template/administator/footer');
			$this->template->render();
		endswitch;
	}
	private function _menu_form($data=array()){
		$this->template->set_template('administator');
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		$menu_id = ($this->input->get_post('menu_id',TRUE))?$this->input->get_post('menu_id',TRUE):0;
		$rs_menu = $this->admin_preference->fetchMenusById($menu_id);
		$rs_content = $this->admin_preference->fetchContentsAll();
		$filter['level'] = 'main';
		$main_menu = $this->admin_preference->fetchMenusAll($filter);
		$filter_sub['level'] = 'sub';
		$sub_menu = $this->admin_preference->fetchMenusAll($filter_sub);

		if(isset($_GET['debug_data'])){
			alert($rs_menu);
		}
		$view['rs_menu'] = isset($rs_menu)?$rs_menu:'';
		$view['rs_content'] = $rs_content;
		$view['main_menu'] = $main_menu;
		$view['sub_menu'] = $sub_menu;
		$view['action'] = $data['action'];
		$this->template->write_view('content',ADMIN_MODULE.'/preference/menu/form',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	private function _menu_action(){
		$this->template->set_template('administator');
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		switch ($this->input->post('MM_action')):
		case 'create':
			$type = $this->input->post('type',TRUE);
			$level = $this->input->post('level',TRUE);
			$data['name'] = $this->input->post('name',TRUE);
			$data['position'] = $this->input->post('position',TRUE);
			$data['indexs'] = $this->input->post('index',TRUE);
			$data['status'] = $this->input->post('status',TRUE);
			$data['date'] = time_zone_asia();
			
			if($type == 'link'){
				$data['type'] = $this->input->post('type',TRUE);
				$data['url'] = $this->input->post('link',TRUE);
			}else{
				$data['type'] = $this->input->post('type',TRUE);
				$data['content'] = $this->input->post('content',TRUE);
			}
			
			if($level == 'main'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['header'] = $this->input->post('imps',TRUE);
			}else if($level == 'sub'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('sub',TRUE);
			}else{
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('subs',TRUE);
			}

			$menu_id = $this->admin_preference->insert('menu',$data);
			
			if($menu_id){
				$url = site_url(admin_module('preference/menu'));
				$getdata['msg'] ="<span>Add Menu Complete</span>";
				$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			}else{
				$getdata['msg']="<span>Add Menu Not Completed !!</span><br>";
				$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
			}
	
			$head_title = "create";
			break;
		case 'update':

			$type = $this->input->post('type',TRUE);
			$level = $this->input->post('level',TRUE);
			$data['name'] = $this->input->post('name',TRUE);
			$data['position'] = $this->input->post('position',TRUE);
			$data['indexs'] = $this->input->post('index',TRUE);
			$data['status'] = $this->input->post('status',TRUE);
			$data['lastupdate'] = time_zone_asia();
				
			if($type == 'link'){
				$data['type'] = $this->input->post('type',TRUE);
				$data['url'] = $this->input->post('link',TRUE);
			}else{
				$data['type'] = $this->input->post('type',TRUE);
				$data['content'] = $this->input->post('content',TRUE);
			}
				
			if($level == 'main'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['header'] = $this->input->post('imps',TRUE);
			}else if($level == 'sub'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('sub',TRUE);
			}else{
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('subs',TRUE);
			}
			
			$menu_id = $this->input->post('menu_id',TRUE);
			
			$where[] = 'id = '.$menu_id;
			$this->admin_preference->update('menu',$data,$where);
			
			$url = site_url(admin_module('preference/menu'));
			$getdata['msg'] ="<span>Update Menu Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			$head_title = "update";
			break;
		case 'delete':
			$menu_id = $this->input->get_post('menu_id');
			$id = $this->admin_preference->delete('menu',$menu_id);
			return true;
			break;
		endswitch;
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(2));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		$view = array(
				'message' => isset($getdata['msg']) ?$getdata['msg']:'' ,
				'head_title'=> isset($head_title)?$head_title:''
				);
		$this->template->write_view('content',ADMIN_MODULE.'/preference/menu/action',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	public function slide($action=NULL){
		switch ($action):
		case 'create':
			$data = array();
		$this->_slide_action();
		break;
		case 'update':
			$data = array();
			$this->_slide_action();
			break;
		case 'delete':
			$data = array();
			$this->_slide_action();
			break;
		case 'new':
			$data = array(
			'action'=> 'create'
					);
			$this->_slide_form($data);
			break;
		case 'edit':
			$data = array(
			'action'=> 'update'
					);
			$this->_slide_form($data);
			break;
		default:
			$this->load->library('paging');
			$this->template->set_template('administator');
			$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
			modules::run('template/administator/breadcrumb',$breadcrumb);
			modules::run('template/administator/header');
			modules::run('template/administator/sidebar');
			$limit = LIMIT_PAGE;
			$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
			$filter['start'] = $page;
			$filter['perpage'] = $limit;
			$slide = $this->admin_preference->fetchSlideAll($filter);

			if($slide){
				$view['slidelist'] = $slide;
			}
			$view['total_record'] = $slide['row_count'];
			$this->paging->set($slide['row_count'],$limit,10,$page);
			$this->paging->linkto(site_url(admin_module('preference/slide')));
			$html = $this->paging->render();
			$view['paging'] = $html;
			$this->template->write_view('content',ADMIN_MODULE.'/preference/slide/lists',$view);
			modules::run('template/administator/footer');
			$this->template->render();
			endswitch;
	}
	private function _slide_form($data=array()){
		$this->template->set_template('administator');
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
	
		$slide_id = ($this->input->get_post('slide_id',TRUE))?$this->input->get_post('slide_id',TRUE):0;
		$rs_slide = $this->admin_preference->fetchSlideById($slide_id);
		
		if(isset($_GET['debug_data'])){
			alert($rs_slide);
		}
		$view['user'] = get_user_cookie();
		$view['rs_slide'] = isset($rs_slide)?$rs_slide:'';
		$view['action'] = $data['action'];
		$this->template->write_view('content',ADMIN_MODULE.'/preference/slide/form',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	private function _slide_action(){
		$this->template->set_template('administator');
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		switch ($this->input->post('MM_action')):
		case 'create':
			
		$data['link'] = $this->input->post('link',TRUE);
		$data['level'] = $this->input->post('level',TRUE);
		$data['name'] = $this->input->post('name',TRUE);
		$data['title'] = $this->input->post('title',TRUE);
		$data['image'] = $this->input->post('imps',TRUE);
		$data['status'] = $this->input->post('status',TRUE);

        $data['start_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $data['end_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
		$data['datepost'] = time_zone_asia();
			
	
		$slide_id = $this->admin_preference->insert('slide',$data);
			
		if($slide_id){
			$url = site_url(admin_module('preference/slide'));
			$getdata['msg'] ="<span>Add Menu Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
		}else{
			$getdata['msg']="<span>Add Menu Not Completed !!</span><br>";
			$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
		}
	
		$head_title = "create";
		break;
		case 'update':
			$data['link'] = $this->input->post('link',TRUE);
			$data['level'] = $this->input->post('level',TRUE);
			$data['name'] = $this->input->post('name',TRUE);
			$data['title'] = $this->input->post('title',TRUE);
			$data['image'] = $this->input->post('imps',TRUE);
			$data['status'] = $this->input->post('status',TRUE);
            $data['start_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
            $data['end_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
			$data['lastupdate'] = time_zone_asia();
			$slide_id = $this->input->post('slide_id',TRUE);
				
			$where[] = 'id = '.$slide_id;
			$this->admin_preference->update('slide',$data,$where);
				
			$url = site_url(admin_module('preference/slide'));
			$getdata['msg'] ="<span>Update Menu Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			$head_title = "update";
			break;
		case 'delete':
			$slide_id = $this->input->get_post('slide_id');
			$id = $this->admin_preference->delete('slide',$slide_id);
			return true;
			break;
			endswitch;
			$breadcrumb['head_title'] = ucfirst($head_title);
			modules::run('template/administator/breadcrumb',$breadcrumb);
			$view = array(
					'message' => $getdata['msg'],
					'head_title'=> $head_title
			);
			$this->template->write_view('content',ADMIN_MODULE.'/preference/slide/action',$view);
			modules::run('template/administator/footer');
			$this->template->render();
	}
	public function link($action=NULL){
		switch ($action):
		case 'create':
			$data = array();
		$this->_link_action();
		break;
		case 'update':
			$data = array();
			$this->_link_action();
			break;
		case 'delete':
			$data = array();
			$this->_link_action();
			break;
		case 'new':
			$data = array(
			'action'=> 'create'
					);
					$this->_link_form($data);
					break;
		case 'edit':
			$data = array(
			'action'=> 'update'
					);
					$this->_link_form($data);
					break;
		default:
			$this->load->library('paging');
			$this->template->set_template('administator');
			$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
			modules::run('template/administator/breadcrumb',$breadcrumb);
			modules::run('template/administator/header');
			modules::run('template/administator/sidebar');
			$limit = LIMIT_PAGE;
			$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
			$filter['start'] = $page;
			$filter['perpage'] = $limit;
			$link = $this->admin_preference->fetchLinkAll($filter);
	
			if($link){
				$view['linklist'] = $link;
			}
			$view['total_record'] = $link['row_count'];
			$this->paging->set($link['row_count'],$limit,10,$page);
			$this->paging->linkto(site_url(admin_module('preference/link')));
			$html = $this->paging->render();
			$view['paging'] = $html;
			$this->template->write_view('content',ADMIN_MODULE.'/preference/link/lists',$view);
			modules::run('template/administator/footer');
			$this->template->render();
			endswitch;
	}
	private function _link_form($data=array()){
		$this->template->set_template('administator');
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
	
		$link_id = ($this->input->get_post('link_id',TRUE))?$this->input->get_post('link_id',TRUE):0;
		$rs_link = $this->admin_preference->fetchLinkById($link_id);
	
		if(isset($_GET['debug_data'])){
			alert($rs_slide);
		}
		$view['user'] = get_user_cookie();
		$view['rs_link'] = isset($rs_link)?$rs_link:'';
		$view['action'] = $data['action'];
		$this->template->write_view('content',ADMIN_MODULE.'/preference/link/form',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	private function _link_action(){
		$this->template->set_template('administator');
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		switch ($this->input->post('MM_action')):
		case 'create':
				
		$data['link'] = $this->input->post('link',TRUE);
		$data['level'] = $this->input->post('level',TRUE);
		$data['name'] = $this->input->post('name',TRUE);
		$data['title'] = $this->input->post('title',TRUE);
		$data['image'] = $this->input->post('imps',TRUE);
		$data['status'] = $this->input->post('status',TRUE);
		$data['datepost'] = time_zone_asia();
			
	
		$link_id = $this->admin_preference->insert('links',$data);
			
		if($link_id){
			$url = site_url(admin_module('preference/link'));
			$getdata['msg'] ="<span>Add Link Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
		}else{
			$getdata['msg']="<span>Add Link Not Completed !!</span><br>";
			$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
		}
	
		$head_title = "create";
		break;
		case 'update':
			$data['link'] = $this->input->post('link',TRUE);
			$data['level'] = $this->input->post('level',TRUE);
			$data['name'] = $this->input->post('name',TRUE);
			$data['title'] = $this->input->post('title',TRUE);
			$data['image'] = $this->input->post('imps',TRUE);
			$data['status'] = $this->input->post('status',TRUE);
			$data['lastupdate'] = time_zone_asia();
			$link_id = $this->input->post('link_id',TRUE);
	
			$where[] = 'id = '.$link_id;
			$this->admin_preference->update('links',$data,$where);
	
			$url = site_url(admin_module('preference/link'));
			$getdata['msg'] ="<span>Update Link Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			$head_title = "update";
			break;
		case 'delete':
			$link_id = $this->input->get_post('link_id');
			$id = $this->admin_preference->delete('links',$link_id);
			return true;
			break;
			endswitch;
			$breadcrumb['head_title'] = ucfirst($head_title);
			modules::run('template/administator/breadcrumb',$breadcrumb);
			$view = array(
					'message' => $getdata['msg'],
					'head_title'=> $head_title
			);
			$this->template->write_view('content',ADMIN_MODULE.'/preference/link/action',$view);
			modules::run('template/administator/footer');
			$this->template->render();
	}
	public function highlight($action=NULL){
		switch ($action):
		case 'create':
			$data = array();
		$this->_highlight_action();
		break;
		case 'update':
			$data = array();
			$this->_highlight_action();
			break;
		case 'delete':
			$data = array();
			$this->_highlight_action();
			break;
		case 'new':
			$data = array(
			'action'=> 'create'
					);
					$this->_highlight_form($data);
					break;
		case 'edit':
			$data = array(
			'action'=> 'update'
					);
					$this->_highlight_form($data);
					break;
		default:
			$this->load->library('paging');
			$this->template->set_template('administator');
			$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
			modules::run('template/administator/breadcrumb',$breadcrumb);
			modules::run('template/administator/header');
			modules::run('template/administator/sidebar');
			$limit = LIMIT_PAGE;
			$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
			$filter['start'] = $page;
			$filter['perpage'] = $limit;
			$filter['level'] = 'main';
			$highlight = $this->admin_preference->fetcHighlightAll($filter);
	
			if($highlight){
				$view['highlightlist'] = $highlight;
			}
			$view['total_record'] = $highlight['row_count'];
			$this->paging->set($highlight['row_count'],$limit,10,$page);
			$this->paging->linkto(site_url(admin_module('preference/highlight')));
			$html = $this->paging->render();
			$view['paging'] = $html;
			$this->template->write_view('content',ADMIN_MODULE.'/preference/highlight/lists',$view);
			modules::run('template/administator/footer');
			$this->template->render();
			endswitch;
	}
	private function _highlight_form($data=array()){
		$this->template->set_template('administator');
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
	
		$highlight_id = ($this->input->get_post('highlight_id',TRUE))?$this->input->get_post('highlight_id',TRUE):0;
		$rs_highlight = $this->admin_preference->fetchHighlightById($highlight_id);
		$rs_content = $this->admin_preference->fetchContentsAll();
	
		if(isset($_GET['debug_data'])){
			alert($rs_highlight);
		}
		$view['user'] = get_user_cookie();
		$view['rs_highlight'] = isset($rs_highlight)?$rs_highlight:'';
		$view['rs_content'] = $rs_content;
		$view['action'] = $data['action'];
		$this->template->write_view('content',ADMIN_MODULE.'/preference/highlight/form',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	private function _highlight_action(){
		$this->template->set_template('administator');
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		switch ($this->input->post('MM_action')):
		case 'create':
	
			$type = $this->input->post('type',TRUE);
			$level = $this->input->post('level',TRUE);
			$data['name'] = $this->input->post('name',TRUE);
			$data['position'] = $this->input->post('position',TRUE);
			$data['status'] = $this->input->post('status',TRUE);
			$data['indexs'] = $this->input->post('index',TRUE);
			$data['date'] = time_zone_asia();
			
			if($type == 'link'){
				$data['type'] = $this->input->post('type',TRUE);
				$data['url'] = $this->input->post('link',TRUE);
			}else{
				$data['type'] = $this->input->post('type',TRUE);
				$data['content'] = $this->input->post('content',TRUE);
			}
				
			if($level == 'main'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['header'] = $this->input->post('imps',TRUE);
			}else if($level == 'sub'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('sub',TRUE);
			}else{
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('subs',TRUE);
			}
			
	
		$highlight_id = $this->admin_preference->insert('highlight',$data);
			
		if($highlight_id){
			$url = site_url(admin_module('preference/highlight'));
			$getdata['msg'] ="<span>Add Highlight Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
		}else{
			$getdata['msg']="<span>Add Highlight Not Completed !!</span><br>";
			$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
		}
	
		$head_title = "create";
		break;
		case 'update':
			$type = $this->input->post('type',TRUE);
			$level = $this->input->post('level',TRUE);
			$data['name'] = $this->input->post('name',TRUE);
			$data['position'] = $this->input->post('position',TRUE);
			$data['status'] = $this->input->post('status',TRUE);
			$data['indexs'] = $this->input->post('index',TRUE);
			$data['lastupdate'] = time_zone_asia();
			
			if($type == 'link'){
				$data['type'] = $this->input->post('type',TRUE);
				$data['url'] = $this->input->post('link',TRUE);
			}else{
				$data['type'] = $this->input->post('type',TRUE);
				$data['content'] = $this->input->post('content',TRUE);
			}
				
			if($level == 'main'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['header'] = $this->input->post('imps',TRUE);
			}else if($level == 'sub'){
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('sub',TRUE);
			}else{
				$data['level'] = $this->input->post('level',TRUE);
				$data['sub'] = $this->input->post('subs',TRUE);
			}
			
			$highlight_id = $this->input->post('highlight_id',TRUE);
	
			$where[] = 'id = '.$highlight_id;
			$this->admin_preference->update('highlight',$data,$where);
	
			$url = site_url(admin_module('preference/highlight'));
			$getdata['msg'] ="<span>Update Highlight Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			$head_title = "update";
			break;
		case 'delete':
			$highlight_id = $this->input->get_post('highlight_id');
			$id = $this->admin_preference->delete('highlight',$highlight_id);
			return true;
			break;
			endswitch;
			$breadcrumb['head_title'] = ucfirst($head_title);
			modules::run('template/administator/breadcrumb',$breadcrumb);
			$view = array(
					'message' => $getdata['msg'],
					'head_title'=> $head_title
			);
			$this->template->write_view('content',ADMIN_MODULE.'/preference/highlight/action',$view);
			modules::run('template/administator/footer');
			$this->template->render();
	}
	public function content($action=NULL){
		switch ($action):
		case 'create':
			$data = array();
		$this->_content_action();
		break;
		case 'update':
			$data = array();
			$this->_content_action();
			break;
		case 'delete':
			$data = array();
			$this->_content_action();
			break;
		case 'new':
			$data = array(
			'action'=> 'create'
					);
					$this->_content_form($data);
					break;
		case 'edit':
			$data = array(
			'action'=> 'update'
					);
					$this->_content_form($data);
					break;
		default:
			$this->load->library('paging');
			$this->template->set_template('administator');
			$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
			modules::run('template/administator/breadcrumb',$breadcrumb);
			modules::run('template/administator/header');
			modules::run('template/administator/sidebar');
			$limit = LIMIT_PAGE;
			$page = ($this->input->get('pg'))?$this->input->get('pg'):1;
			$filter['start'] = $page;
			$filter['perpage'] = $limit;
			$filter['level'] = 'main';
			$content = $this->admin_preference->fetcContentAll($filter);
	
			if($content){
				$view['contentlist'] = $content;
			}
			$view['total_record'] = $content['row_count'];
			$this->paging->set($content['row_count'],$limit,10,$page);
			$this->paging->linkto(site_url(admin_module('preference/content')));
			$html = $this->paging->render();
			$view['paging'] = $html;
			$this->template->write_view('content',ADMIN_MODULE.'/preference/content/lists',$view);
			modules::run('template/administator/footer');
			$this->template->render();
			endswitch;
	}
	private function _content_form($data=array()){
		$this->template->set_template('administator');
		$breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
		modules::run('template/administator/breadcrumb',$breadcrumb);
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
	
		$content_id = ($this->input->get_post('content_id',TRUE))?$this->input->get_post('content_id',TRUE):0;
		$rs_content = $this->admin_preference->fetchContentById($content_id);
	
		if(isset($_GET['debug_data'])){
			alert($rs_content);
		}
		$view['user'] = get_user_cookie();
		$view['rs_content'] = isset($rs_content)?$rs_content:'';
		$view['action'] = $data['action'];
		$this->template->write_view('content',ADMIN_MODULE.'/preference/content/form',$view);
		modules::run('template/administator/footer');
		$this->template->render();
	}
	private function _content_action(){
		$this->template->set_template('administator');
		modules::run('template/administator/header');
		modules::run('template/administator/sidebar');
		switch ($this->input->post('MM_action')):
		case 'create':
	
		$data['name'] = $this->input->post('name',TRUE);
		$data['title'] = $this->input->post('title',TRUE);
		$data['detail'] = $this->input->post('detail',FALSE);
		$data['date'] = time_zone_asia();
		$data['status'] = '1';
	
		$content_id = $this->admin_preference->insert('content',$data);
			
		if($content_id){
			$url = site_url(admin_module('preference/content'));
			$getdata['msg'] ="<span>Add Content Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
		}else{
			$getdata['msg']="<span>Add Content Not Completed !!</span><br>";
			$getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
		}
	
		$head_title = "create";
		break;
		case 'update':
			$data['name'] = $this->input->post('name',TRUE);
			$data['title'] = $this->input->post('title',TRUE);
			$data['detail'] = $this->input->post('detail',FALSE);
			$data['lastupdate'] = time_zone_asia();
			$content_id = $this->input->post('content_id',TRUE);
	
			$where[] = 'id = '.$content_id;
			$this->admin_preference->update('content',$data,$where);
	
			$url = site_url(admin_module('preference/content'));
			$getdata['msg'] ="<span>Update Content Complete</span>";
			$getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
			$head_title = "update";
			break;
		case 'delete':
			$content_id = $this->input->get_post('content_id');
			$id = $this->admin_preference->delete('content',$content_id);
			return true;
			break;
			endswitch;
			$breadcrumb['head_title'] = ucfirst($head_title);
			modules::run('template/administator/breadcrumb',$breadcrumb);
			$view = array(
					'message' => $getdata['msg'],
					'head_title'=> $head_title
			);
			$this->template->write_view('content',ADMIN_MODULE.'/preference/content/action',$view);
			modules::run('template/administator/footer');
			$this->template->render();
	}
    public function intro($action=NULL){
        switch ($action):
            case 'create':
                $data = array();
                $this->_intro_action();
                break;
            case 'update':
                $data = array();
                $this->_intro_action();
                break;
            case 'delete':
                $data = array();
                $this->_intro_action();
                break;
            case 'new':
                $data = array(
                    'action'=> 'create'
                );
                $this->_intro_form($data);
                break;
            case 'edit':
                $data = array(
                    'action'=> 'update'
                );
                $this->_intro_form($data);
                break;
            default:
                $this->load->library('paging');
                $this->template->set_template('administator');
                $breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
                modules::run('template/administator/breadcrumb',$breadcrumb);
                modules::run('template/administator/header');
                modules::run('template/administator/sidebar');
                $limit = LIMIT_PAGE;
                $page = ($this->input->get('pg'))?$this->input->get('pg'):1;
                $filter['start'] = $page;
                $filter['perpage'] = $limit;
                $intro = $this->admin_preference->fetchIntroAll($filter);

                if($intro){
                    $view['introlist'] = $intro;
                }
                $view['total_record'] = $intro['row_count'];
                $this->paging->set($intro['row_count'],$limit,10,$page);
                $this->paging->linkto(site_url(admin_module('preference/intro')));
                $html = $this->paging->render();
                $view['paging'] = $html;
                $this->template->write_view('content',ADMIN_MODULE.'/preference/intro/lists',$view);
                modules::run('template/administator/footer');
                $this->template->render();
        endswitch;
    }
    private function _intro_form($data=array()){
        $this->template->set_template('administator');
        $breadcrumb['head_title'] = ucfirst($this->uri->segment(3));
        modules::run('template/administator/breadcrumb',$breadcrumb);
        modules::run('template/administator/header');
        modules::run('template/administator/sidebar');

        $intro_id = ($this->input->get_post('intro_id',TRUE))?$this->input->get_post('intro_id',TRUE):0;
        $rs_intro = $this->admin_preference->fetchIntroById($intro_id);

        if(isset($_GET['debug_data'])){
            alert($rs_intro);
        }
        $view['user'] = get_user_cookie();
        $view['rs_intro'] = isset($rs_intro)?$rs_intro:'';
        $view['action'] = $data['action'];
        $this->template->write_view('content',ADMIN_MODULE.'/preference/intro/form',$view);
        modules::run('template/administator/footer');
        $this->template->render();
    }
    private function _intro_action(){
        $this->template->set_template('administator');
        modules::run('template/administator/header');
        modules::run('template/administator/sidebar');
        switch ($this->input->post('MM_action')):
            case 'create':

                $data['color'] = $this->input->post('color',TRUE);
                $data['level'] = $this->input->post('level',TRUE);
                $data['name'] = $this->input->post('name',TRUE);
                $data['title'] = $this->input->post('title',TRUE);
                $data['image'] = $this->input->post('imps',TRUE);
                $data['status'] = $this->input->post('status',TRUE);

                $data['start_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
                $data['end_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
                $data['datepost'] = time_zone_asia();


                $intro_id = $this->admin_preference->insert('intro',$data);

                if($intro_id){
                    $url = site_url(admin_module('preference/intro'));
                    $getdata['msg'] ="<span>Add Intro Complete</span>";
                    $getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
                }else{
                    $getdata['msg']="<span>Add Intro Not Completed !!</span><br>";
                    $getdata['msg'].="<br><a href='Javascript:history.back(1)'>Back</a>";
                }

                $head_title = "create";
                break;
            case 'update':
                $data['color'] = $this->input->post('color',TRUE);
                $data['level'] = $this->input->post('level',TRUE);
                $data['name'] = $this->input->post('name',TRUE);
                $data['title'] = $this->input->post('title',TRUE);
                $data['image'] = $this->input->post('imps',TRUE);
                $data['status'] = $this->input->post('status',TRUE);
                $data['start_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
                $data['end_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
                $data['lastupdate'] = time_zone_asia();
                $intro_id = $this->input->post('intro_id',TRUE);

                $where[] = 'id = '.$intro_id;
                $this->admin_preference->update('intro',$data,$where);

                $url = site_url(admin_module('preference/intro'));
                $getdata['msg'] ="<span>Update intro Complete</span>";
                $getdata['msg'] .="<meta http-equiv=\"refresh\" content=\"2; URL= $url \">";
                $head_title = "update";
                break;
            case 'delete':
                $intro_id = $this->input->get_post('intro_id');
                $id = $this->admin_preference->delete('intro',$intro_id);
                return true;
                break;
        endswitch;
        $breadcrumb['head_title'] = ucfirst($head_title);
        modules::run('template/administator/breadcrumb',$breadcrumb);
        $view = array(
            'message' => $getdata['msg'],
            'head_title'=> $head_title
        );
        $this->template->write_view('content',ADMIN_MODULE.'/preference/intro/action',$view);
        modules::run('template/administator/footer');
        $this->template->render();
    }
	public function check_email(){
		$user_id =  $this->input->get('user_id');
		$email =  $this->input->get('email');
	
		$rs = $this->admin_preference->fetchCheckEmail($email);
		if($rs){
			if($rs['id'] == $user_id){
				echo 'true';
			}else{
				echo 'false';
			}
		}else{
			echo 'true';
		}
	}
	public function check_username(){
		$user_id =  $this->input->get('user_id');
		$username =  $this->input->get('username');
	
		$rs = $this->admin_preference->fetchCheckUsername($username);
		if($rs){
			if($rs['id'] == $user_id){
				echo 'true';
			}else{
				echo 'false';
			}
		}else{
			echo 'true';
		}
	}
}