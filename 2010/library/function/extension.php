<?php
function urlsafe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

	function cuttext($nums,$text){
		if(strlen($text)>$nums){
			$getdata[txt]=substr($text,0,$nums)."...";
		}else{
			$getdata[txt]=$text ;
		}	
		return $getdata[txt];
	}

function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) :
        $data .= substr('====', $mod4);
    endif ;
    return base64_decode($data);
}
function saverecord($textdetail){	
	global $db ;
	 	$rs = $db->Execute(' SELECT `chk_logs`.id FROM `chk_logs` ');
	 	$numrows=$rs->RecordCount();
	 		if ($numrows>=500) 	$db->Execute('DELETE `chk_logs` FROM `chk_logs` ') ;


				ADOdb_Active_Record::SetDatabaseAdapter($db);
					class chk_log extends ADOdb_Active_Record{}
   			 		$chk_log = new chk_log();
					$chk_log->user_id = $_SESSION['adminid'];
					$chk_log->sdate = date("y-m-d h:i:s");
					$chk_log->ip =$_SERVER['REMOTE_ADDR'] ;
					$chk_log->detail =$textdetail;	
					$updatecommit = $chk_log->Save();
						if (!$updatecommit) :
							return	$chk_log->ErrorMsg();
							$chk_log = NULL ;
						else:
							$chk_log = NULL ;
							return	$updatecommit;
						endif;
}
function updatestatus($textdetail){	
	global $db ;
	// 	$rs = $db->Execute(' SELECT `chk_logs`.id FROM `chk_logs` ');
	//	$numrows=$rs->RecordCount();
	// 		if ($numrows>=500) 	$db->Execute('DELETE `chk_logs` FROM `chk_logs` ') ;
				ADOdb_Active_Record::SetDatabaseAdapter($db);
					class admin extends ADOdb_Active_Record{}
   			 		$admin = new admin();					
					$admin->load("admin_id=?", array($_SESSION['adminid']));					
					$admin->login_status = $textdetail;
					$updatecommit = $admin->Replace();
						if (!$updatecommit) :
							return	$chk_log->ErrorMsg();
							$chk_log = NULL ;
						else:
							$chk_log = NULL ;
							return	$updatecommit;
						endif;
}

function list_day($name,$id,$val,$class,$condition){
		$getdata[listday]="<select name='$name' id='$id' $class $condition >";
		$getdata[listday].="<option value='' ";
		if($val =='') $getdata[listday].=" selected ";
		$getdata[listday].=">Date</option>";
		for($loop=1; $loop<=31; $loop++){
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">$loop</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
	
function list_month($name,$id,$val,$class,$condition,$monthtype){
	
		switch($monthtype){
			case "en":{
				$getdata[monthdetail]=array("January","February","March","April","May","June","July","August","September","October","November","December");
			}break;
			case "th":{
				$getdata[monthdetail]=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			}break;
			default :{
				$getdata[monthdetail]=array(01,02,03,04,05,06,07,08,09,10,11,12);
			}break;		
		}
	
		$getdata[listday]="<select name='$name' id='$id' $class $condition >";
		$getdata[listday].="<option value='' >Month</option>";
		for($loop=01; $loop<=12; $loop++){
		
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">".$getdata[monthdetail][$loop-1]."</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
	
	function list_year($name,$id,$val,$class,$condition,$yeartype){
	
		switch($yeartype){
			case "th":{
				$getdata[yeartype]=543;
			}break;
			default :{
				$getdata[yeartype]=0;
			}break;		
		}
		
		$getdata[listday]="<select name='$name' id='$id' $class $condition>";
		$getdata[listday].="<option value='-' >Year</option>";
		for($loop=(date("Y")); $loop<=(date("Y")+10); $loop++){
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">".($loop+$getdata[yeartype])."</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
		function list_year_full($name,$id,$val,$class,$condition,$yeartype){
	
		switch($yeartype){
			case "th":{
				$getdata[yeartype]=543;
			}break;
			default :{
				$getdata[yeartype]=0;
			}break;		
		}
		
		$getdata[listday]="<select name='$name' id='$id' $class $condition>";
		$getdata[listday].="<option value='-' >Year</option>";
		for($loop=(date("Y")); $loop<=(date("Y")+5); $loop++){
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">".($loop+$getdata[yeartype])."</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
		function list_year_age($name,$id,$val,$class,$condition,$yeartype){
	
		switch($yeartype){
			case "th":{
				$getdata[yeartype]=543;
			}break;
			default :{
				$getdata[yeartype]=0;
			}break;		
		}
		
		$getdata[listday]="<select name='$name' id='$id' $class $condition>";
		$getdata[listday].="<option value='' > Year</option>";
		for($loop=(date("Y")); $loop>=(date("Y")-100); $loop--){
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">".($loop+$getdata[yeartype])."</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
	
	function date_nottime_edit_with_slash($date){		
		list($yy,$mm,$dd)=explode("-",$date);			
		if($dd < 10){		// óդҴ
			$dd = substr($dd,1,2);
		}
		if($mm < 10){		// óդҴ
			$mm = substr($mm,1,2);
		}
		$date=$dd."/".$mm."/".$yy;				
		return $date;
	}
	function date_edit_with_slash($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		if($dd < 10){		// óդҴ
			$dd = substr($dd,1,2);
		}
		if($mm < 10){		// óդҴ
			$mm = substr($mm,1,2);
		}
		$date=$dd."/".$mm."/".$yy."&nbsp;".$time;				
		return $date;
	}
		function date_edit_with_slash2($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		if($dd < 10){		// óդҴ
			$dd = substr($dd,1,2);
		}
		if($mm < 10){		// óդҴ
			$mm = substr($mm,1,2);
		}
		$date=$dd."-".$mm."-".$y;				
		return $date;
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

	function insertzeroid($num){
		$temp = "";
		$looptotal =  4 - strlen($num);
		for( $i=1 ; $i<=$looptotal ; $i ++ ){
			$temp .= "0";
		}
		return $temp.$num;
	}
	
	function randompassword($length) {
/*
Programmed by Christian Haensel, christian@chftp.com, LINK1http://www.chftp.comLINK1
Exclusively published on weberdev.com.
If you like my scripts, please let me know or link to me.

You may copy, redistirubte, change and alter my scripts as long as this information remains intact
*/


$length        =    6; // Must be a multiple of 2 !! So 14 will work, 15 won't, 16 will, 17 won't and so on

// Password generation
    $conso=array("b","c","d","f","g","h","j","k","l",
    "m","n","p","r","s","t","v","w","x","y","z");
    $vocal=array("a","e","i","o","u");
    $password="";
    srand ((double)microtime()*1000000);
    $max = $length/2;
    for($i=1; $i<=$max; $i++)
    {
    $password.=$conso[rand(0,19)];
    $password.=$vocal[rand(0,4)];
    }
    $newpass = $password;
	return $newpass ;
	}

	function list_keycode($val){
		$getdata[keylist]=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		for($loop=1; $loop<=52; $loop++){
			if($loop==$val) {
				$getdata[keycode] = $getdata[keylist][$loop-1] ;
			}
		}
		return $getdata[keycode] ;
	}
		function valid_email($email) { 
  // First, we check that there's one @ symbol, and that the lengths are right 
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) { 
  $a=1;
    // Email invalid because wrong number of characters in one section, or wrong number of @ symbols. 
    return $a; 
  } 
  // Split it into sections to make life easier 
  $email_array = explode("@", $email); 
  $local_array = explode(".", $email_array[0]); 
  for ($i = 0; $i < sizeof($local_array); $i++) { 
     if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) { 
	  $a=1;
      return $a; 
    } 
  }   
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name 
    $domain_array = explode(".", $email_array[1]); 
    if (sizeof($domain_array) < 2) { 
        return false; // Not enough parts to domain 
    } 
    for ($i = 0; $i < sizeof($domain_array); $i++) { 
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) { 
	   $a=1;
        return  $a; 
      } 
    } 
  }  $a=2;
  return $a; 
} 
	function date_edit($date,$dlm){		
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd.$dlm.$mm.$dlm.$yy;				
		return $date;
	}
	
	function date_edit_with_dash($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."-".$mm."-".substr($yy,2,4)." ".$time;				
		return $date;
	}
	

			function edit_en_shot_date($tmp){
	
		//$thmonth=array("January","February","March","April","May","June","July","August","September","October","November","December");
		$thmonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		// tmp : value date
		// type of  obj : 1=วันที่กับเวลา, 0=วันที่อย่างเดีย
			list($year,$month,$day)=explode("-",$tmp);	
			if($day<10){
			$day = substr($day,1,2);
			}
			$year = $year+543 ;	
			$datedit=$day." ".$thmonth[$month-1]." ".$year;			
		
		return $datedit;
	}
		function time_edit($date,$type){		
		// type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว
		if($type!=""){		// กรณีมีค่าเวลามาด้วย
			list($date,$time)=explode(" ",$date);
			list($hh,$mmm,$ss)=explode(":",$time) ;
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."-".$mm."-".substr($yy,2,4)."&nbsp;".$hh.":".$mmm;	
		return $date;
	}
	
			function time_only_edit($date,$type){		
		// type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว
		if($type!=""){		// กรณีมีค่าเวลามาด้วย
			list($date,$time)=explode(" ",$date);
			}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."-".$mm."-".substr($yy,2,4);	
		return $date;
	}
	
	function date_edit2($date,$type){	
			// type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว	
		if($type!=""){		// กรณีมีค่าเวลามาด้วย
			list($date,$time)=explode(" ",$date);
			list($hh,$mmm,$ss)=explode(":",$time) ;
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd.".".$mm.".".substr($yy,2,4)."&nbsp;".$hh.":".$mmm;		
		return $date;
	}
	function date_edit3($date,$type){	
			// type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว	
		if($type!=""){		// กรณีมีค่าเวลามาด้วย
			list($date,$time)=explode(" ",$date);
			list($hh,$mmm,$ss)=explode(":",$time) ;
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."-".$mm."-".substr($yy,2,4)."&nbsp;".$hh.":".$mmm;		
		return $date;
	}
	
	function datetime_with_dep($datetime){
		list($date,$time)=explode(" ",$datetime);
		list($yy,$mm,$dd)=explode("-",$date);		
		list($hh,$ii,$ss)=explode(":",$time);	
		$printdate = date("d / m / y   h.i  a.",(mktime($hh,$ii,0,$mm,$dd,$yy)));
		return $printdate ;
	}
	function date_edit_with_dash2($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$MM)); $i++) $dd="0".$MM;
		$date=$dd."-".$MM."-".substr($yy,4,4)." ".$time;				
		return $date;
	}
	
	  //calculate years of age (input string: YYYY-MM-DD)
  function birthday($birthday){ 
    list($year,$month,$day) = explode("-",$birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return $year_diff;
  }
//get old
function getage($dobdate){	
    list($year,$month,$day) = explode("-",$dobdate);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return $year_diff;
}
function icontype($fullname){
    list($name,$type_ext)=explode(".",$fullname);
    switch (strtolower($type_ext))
    {
        case "jpg" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.jpg.gif' border='0' />";
        }
        break;
		
		case "ai" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.ai.gif' border='0' />";
        }
        break;
		
        case "zip" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.zip.gif' border='0' />";
        }
        break;
        case "rar" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.rar.gif' border='0' />";
        }
        break;
		
		case "rtf" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.rtf.gif' border='0' />";
        }
        break;		
        case "doc" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.doc.gif' border='0' />";
        }
        break;
        case "xls" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.xls.gif' border='0' />";
        }
        break;
        case "ppt" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.ppt.gif' border='0' />";
        }
        break;
        case "pdf" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.pdf.gif' border='0' />";
        }
        break;
        case "psd" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.psd.gif' border='0' />";
        }
        break;
        case "tiff" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.tiff.gif' border='0' />";
        }
        break;	
		case "tif" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.tif.gif' border='0' />";
        }
        break;	
		case "png" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.png.gif' border='0' />";
        }
        break;	
		case "gif" :
        {
            $file_ext = "<img src='".$config[website]."/images/i.gif.gif' border='0'  />";
        }
        break;								
	}
 
    return $file_ext;
}	
function getfilesize($filepath,$sizeunit)
{
$SizeBite = filesize($filepath);

switch ($sizeunit) {

case "k": {
$Sizeoffiile=$SizeBite/1024;
			}break;

case "m": {
$Sizeoffiile=$SizeBite/1024/1024;
			}break;
}
return  number_format($Sizeoffiile,2);
}
	function date_edit_with_dash_xx($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."-".$mm."-".$yy;				
		return $date;
	}
function getdatethai() {
		$month =gmdate("n");
		switch($month){
			case "1" : $th_month = "มกราคม";
				break;
			case "2" : $th_month = "กุมภาพันธ์";
				break;
			case "3" : $th_month = "มีนาคม";
				break;
			case "4" : $th_month = "เมษายน";
				break;
			case "5" : $th_month= "พฤษภาคม";
				break;
			case "6" : $th_month = "มิถุนายน";
				break;
			case "7" : $th_month= "กรกฎาคม";
				break;
			case "8" : $th_month = "สิงหาคม";
				break;
			case "9" : $th_month = "กันยายน";
				break;
			case "10" : $th_month = "ตุลาคม";
				break;
			case "11" : $th_month = "พฤศจิกายน";
				break;
			case "12" : $th_month = "ธ้ันวาคม";
				break;
		}
		
		
		return   $th_month ;
}	
	
?>