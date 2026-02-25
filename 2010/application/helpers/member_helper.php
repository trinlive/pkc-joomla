<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function get_member_cookie($_data=false){
	$CI =& get_instance();
	$CI->load->library('encrypt');
	
	if(!isset($_COOKIE['PAKKREYCITY_member'])){
		return false;
	}else{
		$decrypted_data = $CI->encrypt->decode($_COOKIE['PAKKREYCITY_member']);
		$data = unserialize($decrypted_data);
		if($_data !== false){
			if(isset($data[$_data])){
				return $data[$_data];
			}else{
				return false;
			}
		}else{
			return $data;
		}
	}
}

function set_member_cookie($_data){
	$CI =& get_instance();
	$CI->load->library('encrypt');
	
	if(is_array($_data)){
		//$remember = $_data['remember'];
		$remember = false;
		$data = serialize($_data);
		$encrypted_data = $CI->encrypt->encode($data);
		if($remember){
			$expire = time()+24*60*60*30;
		}else{
			$expire = 0;
		}
		setcookie('PAKKREYCITY_member',$encrypted_data,$expire,'/',$CI->config->item('domain'));
		return TRUE;
	}else{
		return FALSE;	
	}
}

function delete_member_cookie(){
	$CI =& get_instance();
	
	$expire =  time()-3600;
	setcookie('PAKKREYCITY_member','',$expire,'/',$CI->config->item('domain'));
}

function is_member_login(){
	if(!IS_MEMBER_LOGIN){
		redirect(site_url('home'));
	}	
}

?>