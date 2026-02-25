<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends MY_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper('breadcrumb');
		$this->load->library('upload_lib');
		is_login();
		/* $this->load->model(ADMIN_MODULE.'/upload/upload_model','admin_upload'); */
		
	}
	public function index($file_name=NULL,$file_name_sub = NULL){
		$this->template->add_css('layouts/administator/lib/bootstrap/css/bootstrap.css');
		if(!empty($file_name_sub)){
			$path = $file_name.'/'.$file_name_sub.'/';
		}else{
			$path = $file_name.'/';
		}
		$ph = './assets/images/'.$path;
		if($this->input->get('action',TRUE) == 'save'){
			if(isset($_FILES['imp'])){
				$handle = new Upload_lib($_FILES['imp']);
				if ($handle->uploaded) {
					$handle->Process($ph);
				}
			}
			$action = 'save';
		}
		// Delete
		if ($this->input->get('action',TRUE) == 'delete') {
			$file_images = $this->input->get('file',TRUE);
			unlink($ph.$file_images);
			
			$action = 'delete';
		}
		
		if ($this->input->get('action',TRUE) == 'file') {
			$file_images = $this->input->get('file',TRUE);
			$filess = pathinfo($ph.$file_images);
			$ext = $filess['extension'];
			$action = 'file';
			list($width, $height, $type, $attr) = getimagesize($ph.$file_images);

			if($height>$width){
				if($height>450){ $height=' height="450"'; $width=''; }
			}else{
				if($width>280){ $height=''; $width=' width="280" ';}
			}

		
			if($ext=='jpg'	 || $ext=='jpeg' || $ext=='gif' || $ext=='png'){
				$img_name = $file_images;
			}else{
				/* if($ext=='doc'){$imp.="<br><br><br><br><center>ไฟล์ จากโปรแกรม Microsoft Word</center>";}
				if($ext=='docx'){$imp.="<br><br><br><br><center>ไฟล์ จากโปรแกรม Microsoft Word</center>";}
				if($ext=='xls'){$imp.="<br><br><br><br><center>ไฟล์ จากโปรแกรม Microsoft Excel</center>";}
				if($ext=='pdf'){$imp.="<br><br><br><br><center>ไฟล์ จากโปรแกรม Adobe Acrobat / PDF file</center>";}
				if($ext=='zip'){$imp.="<br><br><br><br><center>ไฟล์ จากโปรแกรม Winzip</center>";}
				if($ext=='rar'){$imp.="<br><br><br><br><center>ไฟล์ จากโปรแกรม Win Rar</center>";} */
				$img_name = $file_images;
			}
	
		}
		$dir = $ph;
		$dh = opendir($dir);
		$view['ph'] = $ph;
		$view['dh'] = $dh;
		$view['file_name']= isset($path)?$path:'';
		$view['file_extension'] = isset($filess['extension'])?$filess['extension']:'';
		$view['file_basename'] = isset($filess['basename'])?$filess['basename']:'';
		$view['img_name'] = isset($img_name)?$img_name:'';
		$view['width'] = isset($width)?$width:'';
		$view['height'] = isset($height)?$height:'';
		$view['action'] = isset($action)? $action:'';
		if(isset($_GET['tg'])){
			$html = $this->load->view('upload/download',$view,TRUE);
		}else{
			$html = $this->load->view('upload/upload',$view,TRUE);
		}
		echo $html;
	}
}