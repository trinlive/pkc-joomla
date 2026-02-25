<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function get_user_cookie($_data=false){
	$CI =& get_instance();
	$CI->load->library('encrypt');
	
	if(!isset($_COOKIE['PAKKREYCITY_user'])){
		return false;
	}else{
		$decrypted_data = $CI->encrypt->decode($_COOKIE['PAKKREYCITY_user']);
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

function set_user_cookie($_data){
	$CI =& get_instance();
	$CI->load->library('encrypt');
	
	if(is_array($_data)){
		$remember = $_data['remember'];
		$data = serialize($_data);
		$encrypted_data = $CI->encrypt->encode($data);
		if($remember){
			$expire = time()+24*60*60*30;
		}else{
			$expire = 0;
		}
		setcookie('PAKKREYCITY_user',$encrypted_data,$expire,'/',$CI->config->item('domain'));
		return TRUE;
	}else{
		return FALSE;	
	}
}

function delete_user_cookie(){
	$CI =& get_instance();
	
	$expire =  time()-3600;
	setcookie('PAKKREYCITY_user','',$expire,'/',$CI->config->item('domain'));
}

function is_login(){
	if(!IS_LOGIN){
		redirect(site_url(ADMIN_MODULE.'/access_denied'));
	}	
}

function is_permission($member_id,$menu_id){
	$CI =& get_instance();
	
	$CI->load->model(ADMIN_MODULE.'/admin_users_model','admin_users');
	
	$rs = $CI->admin_users->fetchCheckPermission($member_id,$menu_id);
	if($rs){
		return $rs;
	}else{
		return false;	
	}
	
	return true;
}
?>