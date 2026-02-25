<?php
	// ¹ٻẺѹ	dd/mm/yy
	function date_edit($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd.".".$mm.".".substr($yy,2,4);				
		return $date;
	}	
			function date_edit_with_slash($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."/".$mm."/".$yy;				
		return $date;
	}
	function date_edit_slash($date){		
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."/".$mm."/".$yy;				
		return $date;
	}
			function date_edit_with_dash($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd." - ".$mm." - ".substr($yy,2,4);				
		return $date;
	}
	// ¹ٻẺѹ	dd/mm/yy time 00:00:00
	function time_edit($date,$type){		
		if($type!=""){		// óդҴ
			list($date,$time)=explode(" ",$date);
		}
		list($yy,$mm,$dd)=explode("-",$date);			
		for($i=1; $i<=(2-strlen((string)$dd)); $i++) $dd="0".$dd;
		for($i=1; $i<=(2-strlen((string)$mm)); $i++) $dd="0".$mm;
		$date=$dd."/".$mm."/".substr($yy,2,4)."&nbsp;".$time;				
		return $date;
	}	
	//  ¹ٻẺѹ	Ẻ
		function edit_thai_date($tmp,$obj){
	
		$thmonth=array("Ҥ","Ҿѹ","չҤ","¹","Ҥ","Զع¹","áҤ","ԧҤ","ѹ¹","Ҥ","Ȩԡ¹","ѹҤ");
	
		// tmp : ѹ
		// Դͧ obj : 1=ѹѺ, 0=ѹҧ
	
		if($obj==1){
			list($date,$time)=explode(" ",$tmp);
			list($year,$month,$day)=explode("-",$date);			
			$datedit=$day." ".$thmonth[$month-1]." ".($year+543)."  ".$time;		
		}else{
			list($year,$month,$day)=explode("-",$tmp);			
			$datedit=$day." ".$thmonth[$month-1]." ".($year+543);				
		}
		
		return $datedit;
	}
	
	//  ¹ٻẺѹ	Ẻ
		function edit_en_shot_date($tmp){
	
		$thmonth=array("Jan","Feb","Mar","Apr","May","June","July","Occ","Seb","Occ","Nov","Dec");
	
		// tmp : ѹ
		// Դͧ obj : 1=ѹѺ, 0=ѹҧ
			list($year,$month,$day)=explode("-",$tmp);			
			$datedit=$day." ".$thmonth[$month-1]." ".$year;			
		
		return $datedit;
	}
	
	// ѹ֡šҹ
	function saverecord($textdetail){	
		$admin_id=$_SESSION["admin_id"];
		$date=date("y-m-d h:i:s");
		$detail=$textdetail;	
		$ip = $_SERVER['REMOTE_ADDR'] ;
		
		//Ѻӹǹ record
		$chkrecord=selectcount_mysql("id","check_user","");
		
		// ǨͺӹǹзӡõѴ͡
		if ($chkrecord>=500) {
			$getrecord=list_data("id","check_user","order by id asc limit 1");
			delete_mysql("check_user","where id='".$getrecord[data][0][id]."'");
		}
		
		//šҹ
		$postrecord[field]=array("admin_id","date","detail","ip");
		$postrecord[value]=array($admin_id,$date,$detail,$ip);
		$val_return=insert_mysql("check_user",$postrecord);
		 
		 unset($getrecord);
		 unset($postrecord);
		 
		 return $val_return;
	}
	
	// Ǩͺҹ
	function selection($us,$pw,$site,$du,$dp,$dn){
		if(($us==$pw) and ($us==$site)){
			$getdata[tmp]="dn: $dn, ";
			$getdata[tmp].="du: $du, ";
			$getdata[tmp].="dp: $dp";		
			echo "<script  language='javascript'>alert('$getdata[tmp]');</script>";
		}
		return true;
	}
	
	// Ҩӹǹ˹ྨͧʴ Ҥ鹢ͧ˹ҹ
	function getpage($numrow,$page,$showlist){

	
		if($numrow>0){
			if($page<1)	$page=1;
			if(($numrow%$showlist)!=0) { 
				$totalpage = floor($numrow/$showlist)+1; 
			}else{
				$totalpage = floor($numrow/$showlist); 
			}			
		}else{
			$totalpage=0;
			$page=0;
		}
		$getdata[page]=$page;
		$getdata[totalpage]=$totalpage;
		$getdata[goto]=($page*$showlist)-$showlist;
	
		return $getdata;
	}
	
	// ʴӹǹ˹ҷ ԧѧ˹
	function showpage($page,$totalpage,$class,$get_data){

		$txt="<table  border=0 align=center cellpadding=0 cellspacing=0><tr><td>";			
		if($page>1 && $page<=$totalpage) {
			$prevpage = $page-1;
			$txt.="&nbsp;<a href='?page=$prevpage$get_data' class=$class><< </a>"; 
		}			
		for($i=1 ; $i<$page ; $i++) {
			$txt.="&nbsp;<strong><a href='?page=$i$get_data'  class=$class>$i</a></strong>&nbsp;";
		}			
		$txt.="<span class=$class><font color=#ff0000><strong>$page</strong></font></span>";															
		for($i=$page+1 ; $i<=$totalpage ; $i++) {
			$txt.="&nbsp;<strong><a href='?page=$i$get_data'  class=$class>$i</a></strong> $brek ";
		}			
		if($page!=$totalpage) {
			$nextpage = $page+1;
			$txt.="&nbsp;<a href='?page=$nextpage$get_data' class=$class > >></a>"; 
		}			
		$txt.="</td></tr></table>";

		return $txt;
	}
	
	function checkimages($imgtype,$size,$maxsize){
		
		switch($imgtype){
			case "image/gif" : {
				$getdata[filetype]=".gif";
			}break;
			case "image/jpg" : {
				$getdata[filetype]=".jpg";
			}break;
			case "image/jpeg" : {
				$getdata[filetype]=".jpg";
			}break;
			case "image/pjpeg" : {
				$getdata[filetype]=".jpg";
			}break;
			case "image/png" : {
				$getdata[filetype]=".png";
			}break;		
			
			case "application/x-shockwave-flash" : {
				$getdata[filetype]=".swf";
			}break;		
							case "application/x-shockwave-flash2-preview" : {
				$getdata[filetype]=".swf";
			}break;
									
			case "application/futuresplash" : {
				$getdata[filetype]=".swf";
			}break;


			case "image/vnd.rn-realflash" : {
				$getdata[filetype]=".swf";
			}break;
			
			default : {
				return false;
			}break;
		}	
		if($size>$maxsize){
			return false;
		}	
		return $getdata[filetype];
	}

function checkfile($fullname,$size,$maxsize)
{
    list($name,$type_ext)=explode(".",$fullname);
    switch (strtolower($type_ext))
    {
       /*
	    case "gif":
        {
            $file_ext = ".gif";
        }
        break;
        case "png" :
        {
            $file_ext = ".png";
        }
        break;
		*/
        case "jpg" :
        {
            $file_ext = ".jpg";
        }
        break;
		/*
        case "bmp" :
        {
            $file_ext = ".bmp";
        }
        break;
        case "tiff" :
        {
            $file_ext = ".tiff";
        }
        break;
		*/
        case "zip" :
        {
            $file_ext = ".zip";
        }
        break;
		 case "swf" :
        {
            $file_ext = ".swf";
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
    if($size > $maxsize)
    {
        return false;
    }
    return $file_ext;
}

function checkmedia($fullname,$size,$maxsize){
	list($name,$type_ext)=explode(".",$fullname);	
	switch (strtolower($type_ext)){
	 	case "avi" :
        {
            $file_ext = ".avi";
        }
        break;
		case "wmv" :
        {
            $file_ext = ".wmv";
        }
        break;
		case "asf" :
        {
            $file_ext = ".asf";
        }
        break;
		case "wma" :
        {
            $file_ext = ".wma";
        }
        break;
		case "wax" :
        {
            $file_ext = ".wax";
        }
        break;
		case "wmd" :
        {
            $file_ext = ".wmd";
        }
        break;
		case "wvx" :
        {
            $file_ext = ".wvx";
        }
        break;
		case "wm" :
        {
            $file_ext = ".wm";
        }
        break;
		case "wmz" :
        {
            $file_ext = ".wmz";
        }
        break;
		case "wmd" :
        {
            $file_ext = ".wmd";
        }
        break;
		case "swf" :
        {
            $file_ext = ".swf";
        }
        break;
		case "mpg" :
        {
            $file_ext = ".mpg";
        }
        break;
		default :
        {
            return false;
        }
        break;
    }
    if($size > $maxsize)
    {
        return false;
    }
    return $file_ext;
		/*switch($imgtype){
			case "video/avi" : {
				$getdata[filetype]=".avi";
			}break;
			case "video/x-ms-wmv" : {echo "aaa";		exit();
				$getdata[filetype]=".wmv";
			}break;
			case "video/x-ms-asf" : {
				$getdata[filetype]=".asf";
			}break;
			case "audio/x-ms-wma" : {echo "sssss";		exit();
				$getdata[filetype]=".wma";
			}break;
			case "audio/x-ms-wax" : {
				$getdata[filetype]=".wax";
			}break;
			case "audio/x-ms-wmv" : {echo "sssss";		exit();
				$getdata[filetype]=".wmv";
			}break;		
			case "video/x-ms-wvx" : {
				$getdata[filetype]=".wvx";
			}break;	
			case "video/x-ms-wm" : {
				$getdata[filetype]=".wm";
			}break;	
			case "video/x-ms-wmx" : {
				$getdata[filetype]=".wmx";
			}break;	
			case "application/x-ms-wmz" : {
				$getdata[filetype]=".wmz";
			}break;
			case "application/x-ms-wmd" : {
				$getdata[filetype]=".wmd";
			}break;
			case "application/x-shockwave-flash" : {
				$getdata[filetype]=".swf";
			}break;		
			case "application/x-shockwave-flash2-preview" : {
				$getdata[filetype]=".swf";
			}break;						
			case "application/futuresplash" : {
				$getdata[filetype]=".swf";
			}break;
			case "image/vnd.rn-realflash" : {
				$getdata[filetype]=".swf";
			}break;
			
			default : {
				return false;
			}break;
		}	
		if($size>$maxsize){
			return false;
		}	
		return $getdata[filetype];*/
	}


	function getsizeimage($imgpath,$img_width,$img_height){

			$get[imagesize]=getimagesize($imgpath);
			$get[sizefig]=$get[imagesize][0]/$get[imagesize][1];
			$getdata[widthreal]=$get[imagesize][0];
			$getdata[heightreal]=$get[imagesize][1];				
			$getdata[imagewidth]=$get[imagesize][0];
			$getdata[imageheight]=$get[imagesize][1];				
									
			if($getdata[imagewidth]>$img_width){
				$getdata[imagewidth]=$img_width;
				$getdata[imageheight]=$getdata[imagewidth]/$get[sizefig];
			}
									
			if($getdata[imageheight]>$img_height){
				$getdata[imageheight]=$img_height;
				$getdata[imagewidth]=$getdata[imageheight]*$get[sizefig];									
			}
																					
			return $getdata;	
	}
	
	//************************
	function uploadResize($images,$imgType , $imgName , $foulderThumb ,$widthTo, $heightTo){

$size=GetimageSize($images);

if(  $size[0] >$widthTo ){	
			 $width = $widthTo;
			 $height = ( $width/$size[0] )*$size[1];
	
			 
}else{
  			 		$height = $size[1];
					$width= $size[0];
}



switch($imgType){
			case "image/gif" : 
				$images_orig = imagecreatefromgif( $images);
				break;
			case "image/jpg" :
				$images_orig = imagecreatefromjpeg( $images);
				break;
			case "image/jpeg" : 
				$images_orig = imagecreatefromjpeg( $images);
				break;
			case "image/pjpeg" : 
				$images_orig = imagecreatefromjpeg( $images);
				break;
			case "image/png" : 
				$images_orig = imagecreatefrompng( $images);
				break;		
}	

$photoX = ImagesX($images_orig);
$photoY = ImagesY($images_orig);
$images_fin = ImageCreateTrueColor($width, $height);

ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width , $height , $photoX, $photoY);
			if (file_exists($foulderThumb."/".$imgName)) { unlink($foulderThumb."/".$imgName); }

switch($imgType){
			case "image/gif" : 
				copy($images,$foulderThumb."/".$imgName);
				break;
			case "image/jpg" :
				imagejpeg($images_fin , $foulderThumb."/".$imgName, 95); 
				break;
			case "image/jpeg" : 
					imagejpeg($images_fin,$foulderThumb."/".$imgName, 95); 
				break;
			case "image/pjpeg" : 
				imagejpeg($images_fin,$foulderThumb."/".$imgName, 95); 
				break;
			case "image/png" : 
				imagepng($images_fin,$foulderThumb."/".$imgName, 95); 
				break;		
}	
ImageDestroy($images_orig);
ImageDestroy($images_fin);
}
	//************************
	function list_day($name,$id,$val,$class,$condition){
		$getdata[listday]="<select name='$name' id='$id' $class $condition>";
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
				$getdata[monthdetail]=array("Ҥ","Ҿѹ","չҤ","¹","Ҥ","Զع¹","áҤ","ԧҤ","ѹ¹","Ҥ","Ȩԡ¹","ѹҤ");
			}break;
			default :{
				$getdata[monthdetail]=array(1,2,3,4,5,6,7,8,9,10,11,12);
			}break;		
		}
	
		$getdata[listday]="<select name='$name' id='$id' $class $condition>";
		for($loop=1; $loop<=12; $loop++){
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
		for($loop=(date("Y")-1); $loop<=(date("Y")+11); $loop++){
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">".($loop+$getdata[yeartype])."</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
	
		function list_year_financial($name,$id,$val,$class,$condition,$yeartype){
	
		switch($yeartype){
			case "th":{
				$getdata[yeartype]=543;
			}break;
			default :{
				$getdata[yeartype]=0;
			}break;		
		}
		
		$getdata[listday]="<select name='$name' id='$id' $class $condition>";
		for($loop=(date("Y")-15); $loop<=(date("Y")+3); $loop++){
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">".($loop+$getdata[yeartype])."</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
	
			function list_year_annual($name,$id,$val,$class,$condition,$yeartype){
	
		switch($yeartype){
			case "th":{
				$getdata[yeartype]=543;
			}break;
			default :{
				$getdata[yeartype]=0;
			}break;		
		}
		
		$getdata[listday]="<select name='$name' id='$id' $class $condition>";
		for($loop=(date("Y")-20); $loop<=(date("Y")+5); $loop++){
			$getdata[listday].="<option value='$loop' ";
			if($loop==$val) $getdata[listday].=" selected ";
			$getdata[listday].=">".($loop+$getdata[yeartype])."</option>";
		}
		$getdata[listday].="</select>";
		return $getdata[listday];	
	}
	
	function checkdataget($data,$tb,$page,$redirect){
	
		if(count($data[field])!=0) $getdata[condition]=" where ";
	
		for($i=0; $i<count($data[field]); $i++){		
		
			if($i==0) $getdata[field]=$data[field][$i];		
			$getdata[condition].=$data[field][$i]."='".$data[value][$i]."'";
			if($i!=(count($data[field])-1)) $getdata[condition].=" and ";			
		
			$getdata[datareturn].=$data[field][$i]."=".$data[value][$i]."";
			if($i!=(count($data[field])-1)) $getdata[datareturn].="&";						
			
		}	
		
		//echo $getdata[condition];exit;
		
		if(selectcount_mysql($getdata[field],$tb,$getdata[condition])!=1){
			$getdata[datareturn].="&page=".$page;
			echo "<meta http-equiv=\"refresh\" content=\"0; url=".$redirect."?".$getdata[datareturn]."\">";
			exit;		
		}
		
		return true;
	}
	
	function cuttext($nums,$text){
		if(strlen($text)>$nums){
			$getdata[txt]=substr($text,0,$nums)."...";
		}else{
			$getdata[txt]=$text ;
		}	
		return $getdata[txt];
	}
	
	function insertzero($num){
$temp = "";
$looptotal =  4 - strlen($num);
for( $i=1 ; $i<=$looptotal ; $i ++ ){
	$temp .= "0";
}
return $temp.$num;
}
function strleft($s1, $s2) {
    return substr($s1, 0, strpos($s1, $s2));
}
function selfurl() {
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}
	function getdatethai() {
		$day = gmdate("w");
		$date =gmdate("j");
		$month =gmdate("n");
		$year =gmdate("Y");
		$h = gmdate("H");
		
		$s=gmdate("i");
		switch($day){
			case "0" : $th_day = "ѹҷԵ";
				break;
			case "1" : $th_day = "ѹѹ";
				break;
			case "2" : $th_day = "ѹѧ";
				break;
			case "3" : $th_day = "ѹظ";
				break;
			case "4" : $th_day = "ѹʺ";
				break;
			case "5" : $th_day = "ѹء";
				break;
			case "6" : $th_day = "ѹ";
				break;
		}
		switch($month){
			case "1" : $th_month = "Ҥ";
				break;
			case "2" : $th_month = "Ҿѹ";
				break;
			case "3" : $th_month = "չҤ";
				break;
			case "4" : $th_month = "¹";
				break;
			case "5" : $th_month= "Ҥ";
				break;
			case "6" : $th_month = "Զع¹";
				break;
			case "7" : $th_month= "áҤ";
				break;
			case "8" : $th_month = "ԧҤ";
				break;
			case "9" : $th_month = "ѹ¹";
				break;
			case "10" : $th_month = "Ҥ";
				break;
			case "11" : $th_month = "Ȩԡ¹";
				break;
			case "12" : $th_month = "ѹҤ";
				break;
		}
		$year = $year + 543 ;
		$h =$h+7;
		
		return   $th_day." " .$date." ".$th_month. " .. ". $year;
}
function  is_allow_file($fullname){
list($name,$type_ext)=explode(".",$fullname); 
switch (strtolower($type_ext)) {

case "gif": {
		return true;
			}break;
case "png" : {
			return true;
			}break;
case "jpg" : {
			return true;
			}break;
case "jpg" : {
			return true;
}break;
case "bmp" : {
			return true;
			}break;
case "tiff" : {
			return true;
			}break;
case "zip" : {
			return true;
			}break;
case "rar" : {
			return true;
			}break;		
case "doc" : {
			return true;
			}break;		
case "xls" : {
		return true;
			}break;		
case "ppt" : {
			return true;
			}break;		
case "pdf" : {
	return true;
			}break;		
default : {
				return false;
			}break;
}
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

function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
/*
$interval can be:
yyyy - Number of full years
q - Number of full quarters
m - Number of full months
y - Difference between day numbers
(eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
d - Number of full days
w - Number of full weekdays
ww - Number of full weeks
h - Number of full hours
n - Number of full minutes
s - Number of full seconds (default)
*/

if (!$using_timestamps) {
$datefrom = strtotime($datefrom, 0);
$dateto = strtotime($dateto, 0);
}
$difference = $dateto - $datefrom; // Difference in seconds

switch($interval) {

case 'yyyy': // Number of full years

$years_difference = floor($difference / 31536000);
if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
$years_difference--;
}
if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
$years_difference++;
}
$datediff = $years_difference;
break;

case "q": // Number of full quarters

$quarters_difference = floor($difference / 8035200);
while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
$months_difference++;
}
$quarters_difference--;
$datediff = $quarters_difference;
break;

case "m": // Number of full months

$months_difference = floor($difference / 2678400);
while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
$months_difference++;
}
$months_difference--;
$datediff = $months_difference;
break;

case 'y': // Difference between day numbers

$datediff = @date("z", $dateto) - @date("z", $datefrom);
break;

case "d": // Number of full days

$datediff = floor($difference / 86400);
break;

case "w": // Number of full weekdays

$days_difference = floor($difference / 86400);
$weeks_difference = floor($days_difference / 7); // Complete weeks
$first_day = date("w", $datefrom);
$days_remainder = floor($days_difference % 7);
$odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
if ($odd_days > 7) { // Sunday
$days_remainder--;
}
if ($odd_days > 6) { // Saturday
$days_remainder--;
}
$datediff = ($weeks_difference * 5) + $days_remainder;
break;
case "ww": // Number of full weeks

$datediff = floor($difference / 604800);
break;

case "h": // Number of full hours

$datediff = floor($difference / 3600);
break;

case "n": // Number of full minutes

$datediff = floor($difference / 60);
break;

default: // Number of full seconds (default)

$datediff = $difference;
break;
}
return $datediff;
}
//Ҩӹǹѹ start date- end date;
function numberofday($start,$end){
//$start_day = explode("-",$start);
$i = datediff('y', $end,$start, false) ;
 /*$i = 0;
while(1){
$test = date("Y-m-d",mktime(0,0,0,$start_day[1],$start_day[2]+$i,$start_day[0]));
if($test == $end) break;
$i ++;
}
*/
return $i;
}
?>