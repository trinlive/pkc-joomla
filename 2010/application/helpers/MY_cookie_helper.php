<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function my_get_cookie($name='member'){
	$CI =& get_instance();
	$CI->load->library('encrypt');
	
	$cookie_name = 'PAKKREYCITY_'.$name;
	
	if(!isset($_COOKIE[$cookie_name])){
		return false;
	}else{
		$decrypted_data = $CI->encrypt->decode($_COOKIE[$cookie_name]);
		$data = unserialize($decrypted_data);
		return $data;
	}
}

function my_set_cookie($name='member',$value,$expire=0){
	$CI =& get_instance();
	$CI->load->library('encrypt');
	
	$value = serialize($value);
	$encrypted_data = $CI->encrypt->encode($value);
	
	setcookie('PAKKREYCITY_'.$name,$encrypted_data,$expire,'/',$CI->config->item('domain'));
	return TRUE;
}

function my_delete_cookie($name='member'){
	$CI =& get_instance();
	
	$expire =  time()-3600;
	setcookie('PAKKREYCITY_'.$name,'',$expire,'/',$CI->config->item('domain'));
}


?>