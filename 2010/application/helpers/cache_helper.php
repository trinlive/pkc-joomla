<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function cache_dir($path) {
    if (!is_dir($path))
        @mkdir($path, 0755);

    return $path;
}

function cache_load($_key){
	$CI =& get_instance();
	
	if(isset($_GET['z_cache'])){
		$z_cache = $_GET['z_cache'];
		if($z_cache == 'clear'){
			cache_remove($_key);
		}else if($z_cache == 'no'){
			return false;
		}
	}
	
	$config = $CI->config->load('cache',TRUE);
	$CI->load->library('cache');
	$CI->cache->initialize($config);
	if (($data = $CI->cache->load($_key)) !== FALSE) {
		return $data;
	}else{
		return false;
	}
}

function cache_save($_data,$_key,$_lifetime=10){
	$CI =& get_instance();
	
	if(isset($_GET['z_cache'])){
		$z_cache = $_GET['z_cache'];
		if($z_cache == 'no'){
			return false;
		}
	}
	
	$config = $CI->config->load('cache',TRUE);
	$CI->load->library('cache');
	$config['frontendOption']['lifetime'] = $_lifetime;
    $CI->cache->initialize($config);
	
	$CI->cache->save($_data, $_key);
}

function cache_remove($_key){
	$CI =& get_instance();
	
	$config = $CI->config->load('cache',TRUE);
	$CI->load->library('cache');
	$CI->cache->initialize($config);
	$CI->cache->remove($_key);
}

function cache_genkey($prefix, $params = '') {
    if (is_array($params)) {
        $params = serialize($params);
    }

    return $prefix . '_' . md5($params).md5(site_url());
}

?>