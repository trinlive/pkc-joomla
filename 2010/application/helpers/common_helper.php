<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function alert($str) {
	print "<pre>";
	print_r($str);
	print "</pre>";
}

function get_dir($id=NULL, $type=NULL)
{
	$path['thumbnail']	= "assets/org/{$type}/".get_hashing($id)."/";
	$path['upload']	= config_item('assets_path')."org/{$type}/".get_hashing($id)."/";

	mkdir_r($path['thumbnail']);
	$path['thumbnail']	= "/".$path['thumbnail'];
	//alert($path);
	//die();
	return $path;
}

function get_hashing($id)
{
	return ceil($id/5000);
}

function mkdir_r($dirname, $rights=0777){
    $dirs = explode('/', $dirname);
    $dir='';
	try{
		foreach ($dirs as $part) {
			$dir.=$part.'/';
			if (!is_dir($dir) && strlen($dir)>0){
					//mkdir($dir, $rights);  <- Can't change mode
					mkdir($dir);
					chmod($dir,$rights);
				}
		}
		return true;
	}catch(Exception $e){
		return false;
	}
}

function removeFolder($dir){
   if(!is_dir($dir)){
	return false;
   }
   else
   {
	   for($s = DIRECTORY_SEPARATOR, $stack = array($dir), $emptyDirs = array($dir); $dir = array_pop($stack);)
	   {
	   if(!($handle = @dir($dir)))
	   continue;
	   while(false !== $item = $handle->read())
		 $item != '.' && $item != '..' && (is_dir($path = $handle->path . $s . $item) ?
		 array_push($stack, $path) && array_push($emptyDirs, $path) : unlink($path));
		 $handle->close();
	  }
	  for($i = count($emptyDirs); $i--; rmdir($emptyDirs[$i]));
		return true;
   }
}

function external_ip(){
	return $_SERVER['REMOTE_ADDR'];
}

function internal_ip(){
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		return '';
	}
}

function EncryptRC4 ($pwd, $data){
	$cipher = '';
	$key[] = '';
	$box[] = '';
	$pwd_length = strlen($pwd);
	$data_length = strlen($data);
	for ($i = 0; $i < 256; $i++)
	{
		if(isset($pwd[$i % $pwd_length])){
		$key[$i] = ord($pwd[$i % $pwd_length]);
		$box[$i] = $i;
		}

	}
	for ($j = $i = 0; $i < 256; $i++)
	{
		$j = ($j + $box[$i] + $key[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for ($a = $j = $i = 0; $i < $data_length; $i++)
	{
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$k = $box[(($box[$a] + $box[$j]) % 256)];
		((strlen(dechex(ord($data[$i]) ^ $k)) == 1) ? $Zero = "0" : $Zero = "");
		$cipher = $cipher . $Zero . dechex(ord($data[$i]) ^ $k);
	}
	return $cipher;
}

function ASC2CHR($inp){
	$TempChar = "";
	$PartStr = "";
	While (strlen($inp) > 1)
	{
		$TempChar = substr($inp,0,2);
		$inp = substr($inp,2,(strlen($inp)-2));
		$PartStr = $PartStr . chr(hexdec($TempChar));
	}
	return $PartStr;
}

function DecryptRC4($key, $data){
	return ASC2CHR(EncryptRC4($key, ASC2CHR($data)));
}

function fncSaveStatus($status,$message){
	$_SESSION['ssSave']->status = $status;
	$_SESSION['ssSave']->message = $message;
}

function admin_module($path){
	if(substr($path,0,1) == '/'){
		return ADMIN_MODULE.$path;
	}else{
		return ADMIN_MODULE.'/'.$path;
	}
}

function header_menu_active($menu=''){
	$CI =& get_instance();
	$seg1 = $CI->uri->segment(1);
	if($seg1 == '' && $menu == 'home'){
		return 'active';
	}else{
		if($menu == $seg1){
			return 'active';
		}else{
			return '';
		}
	}
	
}

function title_text($str=NULL,$length=15){
	if(is_null($str)) return;
		
	if (mb_strlen($str,"utf-8") > $length){
		$exp_str = explode(" ",$str);
		$cn_arr = count($exp_str);
		if($cn_arr > 1){
			$n = 0;
			$chk = TRUE;
			$new_str = '';
			$temp_str = '';
			while($chk && $n < $cn_arr){
				if($temp_str == ''){
					$temp_str = $exp_str[$n];
				}else{
					$temp_str = $new_str.' '.$exp_str[$n];
				}
				
				if(mb_strlen($temp_str,"utf-8") > $length){
					if($n == 0){
						$new_str = mb_substr($temp_str,0,$length,"utf-8")."...";
					}
					$chk = FALSE;
				}else{
					$new_str = $temp_str;
				}
				$n++;
			}
		}else{
			$new_str = mb_substr($str,0,$length,"utf-8")."...";
		}
	}else{
		$new_str = $str;
	}
	
	return $new_str;
}

////////////////////// View Stat /////////////////////
//													//
//	Get all stat   Ex:: view_stats('cms');			//
//	Get stat by id Ex:: view_stats('cms','3')		//
//	Get stat by id and inc count					//
//			Ex:: view_stats('cms','3', TRUE)		//
//													//
//////////////////////////////////////////////////////
function view_stats($type=NULL,$ref_id=NULL,$inc=FALSE)
{
	$CI	=& get_instance();
	$CI->load->helper('cache');
	$CI->load->model('stats_model','stats');

	/*$params = array(
				'type' => $type,
				'ref_id' => $ref_id
			);
	$cache_key = cache_genkey('view_stats',$params);
	*/
	$cache_key	= cache_genkey("view_stats_{$type}");
	if(!$cache_data = cache_load($cache_key)):

		// No data in cache
		$stats_view	= $CI->stats->get_view($type);

		if($stats_view['row_count'] > 0):
			foreach($stats_view['rows'] as $items):
				$cache_data[$items['id']]	= $items['count'];
			endforeach;
			$cache_data['time']	= time();

			cache_save($cache_data, $cache_key, CACHE_STATS_TIME);
		endif;
	endif;

	// Check time for update
	if(time()-$cache_data['time'] > CHECK_STATS_UPDATE):
		unset($cache_data['time']);
		foreach($cache_data as $id=>$count):
			unset($data);
			$data['count']	= $count;
			$where	= "id = '{$id}' AND type = '{$type}' ";
			$CI->stats->set_view($data, 'update', $where);
		endforeach;
		$cache_data['time']	= time();	// Reset time
		cache_save($cache_data, $cache_key, CACHE_STATS_TIME);
	endif;

	if(!is_null($ref_id)):
		// No data in cache
		if(!isset($cache_data[$ref_id])):
			$stats_id	= $CI->stats->get_view($type,$ref_id);
			//alert($stats_id);
			if($stats_id['row_count'] > 0):
				$cache_data[$ref_id]	= $stats_id['rows'][0]['count'];
			else:
				$cache_data[$ref_id]	= 0;
				unset($data);
				$data['id']	= $ref_id;
				$data['type']	= $type;
				$data['count']	= 0;
				$CI->stats->set_view($data,'insert');
			endif;
		endif;

		if($inc):
			$cache_data[$ref_id]++;
		endif;
		cache_save($cache_data, $cache_key, CACHE_STATS_TIME);

		return number_format($cache_data[$ref_id]);
	endif;

	return number_format($cache_data);
}


if ( ! function_exists('get_var_static'))
{
    function get_var_static(&$var, $default='', $output_buffer=true)
    {
        if (!isset($var) || $var == '')
        {
            $var = $default;
        }

        if ($output_buffer == true)
            return $var;
    }
}

function strip_tag_a_with_text($content)
{
    return preg_replace('#<a(.*?)>(.*?)</a>#is', '', $content);
}

function strip_tag_a_with_out_text($content)
{
    return preg_replace("/<\/?a[^>]*\>/i", "", $content);
}
function format_date($date){
	global $server_time1;
	if($date!=''){
		$rsss = date("d/m/Y",($date));
	}else{$rsss='';}
	return $rsss;
}
function format_date1($date){
	global $server_time1;
	if($date!=''){
		$rsss = date("d/m/Y  H:i",($date));
	}else{$rsss='';}
	return $rsss;
}
function format_date2($date){
	global $server_time1;
	if($date!=''){
		$rsss = date("d/m/Y | H:i",($date));
	}else{$rsss='';}
	return $rsss;
}
function getOnlineUsers(){
	
	define("MAX_IDLE_TIME", 3); 
	if ( $directory_handle = opendir( session_save_path() ) ) {
			$count = 0;
			while ( false !== ( $file = readdir( $directory_handle ) ) ) {
			if($file != '.' && $file != '..'){
				if(time()- fileatime(session_save_path() . '\\' . $file) < MAX_IDLE_TIME * 60) {
					$count++;
				}
			}

		}
		closedir($directory_handle);
		return $count;
	}else{
		return FALSE;
	}
}
function time_zone_asia(){
	//$server_time = '25200';  ## Time- GMT +7 Hrs For Time zone Asia/Bangkok ( 7 Hrs = 25200 )
	$server_timestamp = time();//+$server_time;
	return $server_timestamp;
}
function edit_th_shot_month($month){

	$thmonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$datedit=$thmonth[$month-1];
		
	return $datedit;
}
function edit_th_gettoshot_year($year){
	$year += 543 ;
	$datedit = $year;
	return $datedit;
}
function checkfile($fullname)
{
	list($name,$type_ext)=explode(".",$fullname);
	switch (strtolower($type_ext))
	{
		case "jpg" :
			{
				$file_ext = ".jpg";
			}
			break;

		case "swf" :
			{
				$file_ext = ".swf";
			}
			break;

		case "zip" :
			{
				$file_ext = ".zip";
			}
			break;
		case "rar" :
			{
				$file_ext = ".rar";
			}
			break;

		case "rtf" :
			{
				$file_ext = ".rtf";
			}

		case "doc" :
			{
				$file_ext = ".doc";
			}
			break;
		case "xls" :
			{
				$file_ext = ".xls";
			}
			break;
		case "ppt" :
			{
				$file_ext = ".ppt";
			}
			break;
		case "pdf" :
			{
				$file_ext = ".pdf";
			}
			break;
		default :
			{
				return false;
			}
			break;
	}

	return $file_ext;
}
?>