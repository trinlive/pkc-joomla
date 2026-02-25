<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intro extends MY_Controller {

	public function index()
	{
        my_set_cookie('intro','Y',time()+3600);

        $this->template->set_template('frontend_blank');
		$this->load->model('intro_model','intro');
		$intro = $this->intro->fetchIntroAll();
		$view = array(
				'intro' => $intro
				);
		$this->template->write_view('content','intro/index',$view);
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */