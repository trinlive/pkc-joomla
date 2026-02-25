<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	function now_db(){
		return date("Y-m-d H:i:s");
	}
	
	function date_fieldtodb($date='')
	{
		if($date != ''){
			$date = explode(' ',$date);
			$tmp_date = explode('-',$date[0]);
			$day = $tmp_date[0];
			$month = $tmp_date[1];
			$year = $tmp_date[2];
			if(isset($date[1])){
				$tmp_time = explode(':',$date[1]);
				$hour = $tmp_time[0];
				$minute = $tmp_time[1];
				$return = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute;
			}else{
				$return = $year.'-'.$month.'-'.$day;
			}
			
			return $return;
		}
	}
	
	function date_dbtofield($date='')
	{
		if($date != ''){
			$date = explode(' ',$date);
			$tmp_date = explode('-',$date[0]);
			$day = $tmp_date[2];
			$month = $tmp_date[1];
			$year = $tmp_date[0];
			if(isset($date[1])){
				$tmp_time = explode(':',$date[1]);
				$hour = $tmp_time[0];
				$minute = $tmp_time[1];
				$return = $day.'-'.$month.'-'.$year.' '.$hour.':'.$minute;
			}else{
				$return = $day.'-'.$month.'-'.$year;
			}
			
			return $return;
		}
	}
	
	function formatDate($_date,$_format='Y-m-d H:i:s',$_lang='en'){
		
		$th_format = array(
							// Day
							'd' => array('type' => 'day', 'value' => array()),
							'D' => array('type' => 'day','value' => array('อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.')),
							'j' => array('type' => 'day', 'value' => array()),
							'l' => array('type' => 'day','value' => array('อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์')), //'lower case [L]'
							'N' => array('type' => 'day', 'value' => array()),
							'S' => array('type' => 'day', 'value' => array()),
							'w' => array('type' => 'day', 'value' => array()),
							'z' => array('type' => 'day', 'value' => array()),
							// Month
							'F' => array('type' => 'month','value' => array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม')),
							'm' => array('type' => 'month', 'value' => array()),
							'M' => array('type' => 'month','value' => array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.')),
							'n' => array('type' => 'month', 'value' => array()),
							't' => array('type' => 'month', 'value' => array()),
							// Year
							'L' => array('type' => 'year', 'value' => array()),
							'o' => array('type' => 'year', 'value' => array()),
							'Y' => array('type' => 'year', 'value' => array()),
							'y' => array('type' => 'year', 'value' => array()),
							// Time
							'a' => array('type' => 'time', 'value' => array()),
							'A' => array('type' => 'time', 'value' => array()),
							'B' => array('type' => 'time', 'value' => array()),
							'g' => array('type' => 'time', 'value' => array()),
							'G' => array('type' => 'time', 'value' => array()),
							'h' => array('type' => 'time', 'value' => array()),
							'H' => array('type' => 'time', 'value' => array()),
							'i' => array('type' => 'time', 'value' => array()),
							's' => array('type' => 'time', 'value' => array()),
							'u' => array('type' => 'time', 'value' => array()),
						);
		$pattern_format = array('th' => $th_format);

		if($_date != ''){
			$return = '';
			$date = explode(' ',$_date);
			if(count($date) > 1){
				$tmp_date = explode('-',$date[0]);
				if($tmp_date[0] != '0000'){
					$exDate['day'] = $tmp_date[2];
					$exDate['month'] = $tmp_date[1];
					$exDate['year'] = $tmp_date[0];
					if(isset($date[1])){
						$tmp_time = explode(':',$date[1]);
						$exDate['hour'] = $tmp_time[0];
						$exDate['minute'] = $tmp_time[1];
						$exDate['second'] = $tmp_time[2];
					}else{
						$hour = 0;
						$minute = 0;
						$second = 0;
					}
					
					if($_lang == 'en'){
						$return = date($_format,mktime($exDate['hour'],$exDate['minute'],$exDate['second'],$exDate['month'],$exDate['day'],$exDate['year']));
						return $return;
					}else{
						$str_format = preg_split('//', $_format, -1, PREG_SPLIT_NO_EMPTY);
						foreach($str_format as $chr){
							if(isset($pattern_format[$_lang][$chr])){
								if(count($pattern_format[$_lang][$chr]['value']) > 0){
									$type = $pattern_format[$_lang][$chr]['type'];
									if($type == 'day'){
										$index_day = date('w',strtotime($_date));
									}else{
										$index_day = intval($exDate[$type]);
									}
									$return .= $pattern_format[$_lang][$chr]['value'][$index_day];
								}else{
									$type = $pattern_format[$_lang][$chr]['type'];
									if($type == 'year'){
										$return .= $exDate[$type]+543;
									}else{
										$tmp_date = date("Y-m-d H:i:s", mktime(intval($exDate['hour']),intval($exDate['minute']),intval($exDate['second']),intval($exDate['month']),intval($exDate['day']),intval($exDate['year'])));
										$return .= date($chr,strtotime($tmp_date));
									}
								}
							}else{
								$return .= $chr;
							}
						}
						
						//$return = '[]';
						return $return;
					}
				}
			}	
		}
		
		return false;
	}
	
	function date_shift($date,$shift,$type='days')
	{
		$date = explode(' ',$date);
		$tmp_date = explode('-',$date[0]);
		$day = $tmp_date[2];
		$month = $tmp_date[1];
		$year = $tmp_date[0];
		if(isset($date[1])){
			$tmp_time = explode(':',$date[1]);
			$hour = $tmp_time[0];
			$minute = $tmp_time[1];
			$second = $tmp_time[2];
			$pre_return = strtotime(date("Y-m-d H:i:s",mktime($hour,$minute,$second,$month,$day,$year))." ".$shift." ".$type);
		}else{
			$pre_return = strtotime(date("Y-m-d H:i:s",mktime(0,0,0,$month,$day,$year))." ".$shift." ".$type);
		}
		$return = date("Y-m-d H:i:s",$pre_return);
	
		return $return;
	}
?>