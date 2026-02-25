<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_lang_all(){
		$CI =& get_instance();
		$CI->load->model('lang/lang_model');
		
		$rs = $CI->lang_model->fetchAll();
		return $rs;
	}
	
	function switch_language_url($lang){
		$query_string = $_SERVER['QUERY_STRING'];
		$url = ($query_string != '')?current_url().'?'.$query_string:current_url();
		$exp_link = explode('?',$url);
		if(count($exp_link) == 1){
			$url .= '?ln='.$lang;
		}else{
			if($exp_link[1] == ''){
				$url .= 'ln='.$lang;
			}else{
				$exp_q_str = explode('&',$exp_link[1]);
				$url = $exp_link[0];
				foreach($exp_q_str as $key =>  $rows){
					$exp_val = explode('=',$rows);
					if($exp_val[0] != 'ln'){
						$url .= ($key == 0)?'?':'&';
						if(isset($exp_val[1])){
							$url .= $exp_val[0].'='.$exp_val[1];
						}else{
							$url .= $exp_val[0].'=';
						}
					}
				}
				
				
				if(count($exp_q_str) == 1){
					$exp_val = explode('=',$exp_q_str[0]);
					if($exp_val[0] != 'ln'){
						$url .= '&ln='.$lang;
					}else{
						$url .= '?ln='.$lang;
					}
				}else{
					$url .= '&ln='.$lang;
				}
			}
		}
		return $url;
	}
	

/* End of file MY_language_helper.php */
/* Location: ./application/helpers/MY_language_helper */  