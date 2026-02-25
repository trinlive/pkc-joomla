<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!my_get_cookie('intro')){
            redirect(site_url('intro'));
        }
    }

	public function index()
	{

        $this->template->set_template('frontend');
		$this->load->model('home_model','home');
		$this->load->model('template/frontend_model','frontend');
		$this->template->add_js('assets/layouts/frontend/js/frontend.js');
		$this->template->add_js('assets/layouts/frontend/js/jquery.bxslider.min.js');
		$this->template->add_css('assets/layouts/frontend/css/jquery.bxslider.css');
		modules::run('template/frontend/header');
		$special = $this->home->fetchSpecialAll();
		$news_pr = $this->home->fetchNewsByCateId(1);
		$news_event = $this->home->fetchNewsByCateId(2);
		$news_seminar = $this->home->fetchNewsByCateId(3);
		$slider = $this->home->fetchSlideAll();
		$activity = $this->home->fetchActivityAll();
		$download = $this->home->fetchDownloadAll();
        $checkauction = $this->home->fetchAuctionAll(array('table' => 'checkauction'));
        $finauction = $this->home->fetchAuctionAll(array('table' => 'finauction'));
        $planauction = $this->home->fetchAuctionAll(array('table' => 'planauction'));
        $auction = $this->home->fetchAuctionAll(array('table' => 'auction'));
        $highlight= $this->frontend->fetchHighlightLeftAll();
        $service = $this->frontend->fetchServiceAll();

        $meeting_cate1 = $this->home->fetchMeetingAll(array('table' => 'meeting','cate' => 1));
        $meeting_cate2 = $this->home->fetchMeetingAll(array('table' => 'meeting','cate' => 2));
        $meeting_cate3 = $this->home->fetchMeetingAll(array('table' => 'meeting','cate' => 3));

		$view = array(
				'rs_special' => $special,
				'news_pr' => $news_pr,
				'news_event' => $news_event,
				'news_seminar' => $news_seminar,
				'slider' => $slider,
				'activity' => $activity,
				'download'=> $download,
                'checkauction' => $checkauction,
                'finauction' => $finauction,
                'planauction' => $planauction,
                'auction' => $auction,
                'highlight' => $highlight,
                'service' => $service,
                'meeting1' => $meeting_cate1,
                'meeting2' => $meeting_cate2,
                'meeting3' => $meeting_cate3
				);
		modules::run('template/frontend/sidebar_left');
		$this->template->write_view('content','home/home',$view);
		modules::run('template/frontend/sidebar_right');
		modules::run('template/frontend/footer');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */