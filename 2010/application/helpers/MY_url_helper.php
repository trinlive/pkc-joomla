<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function site_path($uri='')
{
	$CI =& get_instance();
	if (is_array($uri))
	{
		$uri = implode('/', $uri);
	}
	
	return ($uri == '') ? $CI->config->slash_item('base_path') : $CI->config->slash_item('base_path').trim($uri, '/');
}

function site_assets_url($uri='')
{
	$CI =& get_instance();
	if (is_array($uri))
	{
		$uri = implode('/', $uri);
	}
	
	return ($uri == '') ? $CI->config->slash_item('assets_url') : $CI->config->slash_item('assets_url').trim($uri, '/');
}

function site_assets_path($uri='')
{
	$CI =& get_instance();
	if (is_array($uri))
	{
		$uri = implode('/', $uri);
	}
	
	return ($uri == '') ? $CI->config->slash_item('assets_path') : $CI->config->slash_item('assets_path').trim($uri, '/');
}

function is_url($url) {
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function product_url($id,$name,$type='detail',$channel='store'){
	$name = rewrite_url($name);
	$url = site_url($channel.'/product/'.$type.'/'.$id.'/'.$name);
	return $url;
}

function package_url($id,$name,$type='detail',$channel='store'){
	$name = rewrite_url($name);
	if($type == 'detail'){
		$url = site_url($channel.'/packagedetail/'.$id.'/'.$name);
	}else if($type == 'buy'){
		$url = site_url($channel.'/package/buy/'.$id.'/'.$name);
	}
	return $url;
}

function rewrite_url($t){
	$t = trim(stripslashes($t));
	$arrMacro = array(
					" ",
					"-",
					"/",
					"'",
					"&gt;",
					"&lt;",
					"&quot;",
					'"',
					"%",
					"#",
					"+",
					"(",
					")",
					",",
					"&"
				);		
	$arrReplaceValue = array(
					"_",
					"_",
					"_",
					"_",
					"",
					"",
					"",
					"",
					"_percent_",
					"",
					"_",
					"",
					"",
					"",
					""
				);
	$t = str_replace($arrMacro,$arrReplaceValue,$t);
	while(strpos($t,'__')) {
		$t = str_replace('__','_',$t);
	}
	
	if(strlen($t) > 220)
	{
		$t = iconv_substr($t,0,70,'UTF-8');
	}
	
	return $t;
}
?>