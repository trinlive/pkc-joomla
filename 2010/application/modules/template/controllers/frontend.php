<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Frontend extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('frontend_model','frontend');
        $this->load->model('home/home_model','home');
	}
	public function index(){
		echo 'Page Not Found';
	}
	/**
	 * 
	 * 
	 */
	public function header(){
		$highlight_express = $this->frontend->fetchHighlightExpressAll();
        $slider = $this->home->fetchSlideAll();

        $main_menu = $this->frontend->fetchMenusAll();
        if(isset($main_menu)){
            foreach ($main_menu as $main):
                $data = $main;
                $filter_main['level'] = 'sub';
                $filter_main['sub'] = $main['id'];
                $data['sub_menu'] = $this->frontend->fetchSubMenusById($filter_main);
                if(isset($data['sub_menu'])){
                    foreach ($data['sub_menu'] as $key=>$submenu):
                        $filter_sub_main['level'] = 'link';
                        $filter_sub_main['sub'] = $submenu['id'];
                        $data['sub_menu'][$key]['sub_link_menu'] = $this->frontend->fetchSubMenusById($filter_sub_main);
                    endforeach;
                }
                $menu_temp[] = $data;
            endforeach;
        }
        if($menu_temp){
            $header_view['menulist'] = $menu_temp;
        }
		$header_view['user'] = get_user_cookie();
		$header_view['express'] = $highlight_express;
        $header_view['slider'] = $slider;
 		$this->template->write_view('header', 'template/frontend/header', $header_view);
	}
	/**
	 * @param unknown_type $data
	 */

	function breadcrumb($data = NULL) {
		$view['breadcrumb'] = $data['breadcrumb'];
		$view['exclude'] = $data['exclude'];
		$this->template->write_view('breadcrumb', 'template/frontend/breadcrumb',$view);
	}
	function sidebar_left(){
		$member = get_member_cookie();
		$main_menu = $this->frontend->fetchMenusAll();
		if(isset($main_menu)){
			foreach ($main_menu as $main):
				$data = $main;
				$filter_main['level'] = 'sub';
				$filter_main['sub'] = $main['id'];
				$data['sub_menu'] = $this->frontend->fetchSubMenusById($filter_main);
				if(isset($data['sub_menu'])){
					foreach ($data['sub_menu'] as $key=>$submenu):
						$filter_sub_main['level'] = 'link';
						$filter_sub_main['sub'] = $submenu['id'];
						$data['sub_menu'][$key]['sub_link_menu'] = $this->frontend->fetchSubMenusById($filter_sub_main);
					endforeach;
				}
				$menu_temp[] = $data;
			endforeach;
		}
		$view = array();
		if($menu_temp){
				$view['menulist'] = $menu_temp;
			}
		$main_highlight= $this->frontend->fetchHighlightLeftAll();
		$service = $this->frontend->fetchServiceAll();
		$link = $this->frontend->fetchLinkAll();
		$view['highlight'] = $main_highlight;
		$view['member'] = $member;
		$view['service'] = $service;
		$view['link'] = $link;
//		$view['useronline'] = $this->getUserOnline();
//		$view['counter'] = $this->get_Counter();
		$this->template->write_view('sidebar_left', 'template/frontend/sidebar_left',$view);
	}
	function sidebar_right(){
		$view = array();
		$main_highlight= $this->frontend->fetchHighlightAll();
		$poll = $this->frontend->fetchPollRow();
        $link = $this->frontend->fetchLinkAll();
		if(isset($poll)){
			foreach ($poll as $m_poll):
			$data = $m_poll;
			$filter_main['poll_id'] = $m_poll['id'];
			$data['poll_item'] = $this->frontend->fetchPollItemById($filter_main);
			$data['total_vote'] = $this->frontend->fetchPollItemTotalById($filter_main);
			$poll_temp = $data;
			endforeach;
		}
        $view['link'] = $link;
		$view['highlight'] = $main_highlight;
		$view['poll'] = $poll_temp;
        $view['useronline'] = $this->getUserOnline();
        $view['useronlineday'] = $this->getUserOnlineDay();
        $view['counter'] = $this->get_Counter();
		/* alert($view['highlight']);
		exit(); */
		$this->template->write_view('sidebar_right', 'template/frontend/sidebar_right',$view);
	}
	/**
	 * 
	 * 
	 */
	public function footer(){
		$this->template->write_view('footer', 'template/frontend/footer');
	}
	function getUserOnline(){

		$timeoutseconds = 300; //ตั้งเวลาสำหรับเช็คคนออนไลน์ เป็นวินาที 300= 5 นาที
		$timestamp = time();
		$timeout = $timestamp - $timeoutseconds;
		$data = array(
				'timestamp' => $timestamp,
				'ip' => $_SERVER['REMOTE_ADDR'],
				'file' => $_SERVER['PHP_SELF'],
                'date' => date('Y-m-d')
		);
		// เมื่อมีการโหลดเวบเพจขึ้นมา จะกำหนดให้เก็บค่า IP ของคนเยี่ยมชม และเวลาที่โหลดหน้าเวบเพจ ลงในฐานข้อมูลทันที
		$this->frontend->insert_useronline('useronline',$data);
		//หลังจากนั้นเช็คว่า คนเยี่ยมชมหมายเลข IP ใด เกินกำหนดเวลาที่ตั้งไว้แล้ว ให้ลบออกฐานข้อมูล
		$this->frontend->delete_useronline('useronline',$timeout);
		//ให้นับจำนวนเรคคอร์ดในตารางทั้งหมด ที่มี IP ต่างกัน ว่ามีเท่าไหร่ โดย IP เดียวกันให้นับเป็นคนเดียว
		$filter['file'] = $_SERVER['PHP_SELF'];
		$rs = $this->frontend->getUserOnlineNow($filter);
		$user = count($rs);
		return $user;
	}
    function getUserOnlineDay(){

        $timeoutseconds = 300; //ตั้งเวลาสำหรับเช็คคนออนไลน์ เป็นวินาที 300= 5 นาที
        $timestamp = time();
        $filter['date'] = date('Y-m-d');
        $rs = $this->frontend->getUserOnlineDay($filter);
        $user = count($rs);
        return $user;
    }
	function get_Counter(){
		$this->load->model('frontend_model','frontend');
		$rs = $this->frontend->fetchCounter();
		$data['counter'] = $rs['counter']+1;
	
		if(!isset($_COOKIE['CheckCounter'])){
			$where[] = 'counter = '.$rs['counter'];
			$this->frontend->update_counter('counter',$data,$where);
			setcookie('CheckCounter','Y',time()+86400);
		}
		return $rs['counter'];
		//return printf("%08d", $rs['counter']);
	}
}
