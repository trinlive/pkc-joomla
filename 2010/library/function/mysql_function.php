<?php

	//  
	function insert_mysql($tb,$data){
	
		for($i=0; $i<count($data[field]); $i++){		
			$sql[field].=$data[field][$i];
			if($i!=(count($data[field])-1)) $sql[field].=",";			
			$sql[value].="'".$data[value][$i]."'";	
			if($i!=(count($data[value])-1)) $sql[value].=",";
		}
		
		$sql[insert]="insert into $tb ($sql[field]) values ($sql[value]) ";
		//echo $sql[insert];
		//exit;
		$sql[queryinsert]=mysql_query($sql[insert]);
		
		if($sql[queryinsert]){
			$getdata[insertid]=mysql_insert_id();
			return $getdata[insertid];	// êè§¤èò id ¡åñº
		}else{
			return false;		// êè§¢éí¤çòá error
		}		
	}

	// 
	function update_mysql($tb,$data,$condition){
	
		for($i=0; $i<count($data[field]); $i++){		
			$sql[data].=$data[field][$i]."='".$data[value][$i]."'";
			if($i!=(count($data[field])-1)) $sql[data].=",";			
		}		
		
		$sql[update]="update $tb set $sql[data] $condition ";
		//echo $sql[update];echo '<br>';
		//exit;
		$sql[queryupdate]=mysql_query($sql[update]);
		
		if($sql[queryupdate]){
			return true;	// 
		}else{
			return false;		// 
		}			
	}

	function update_mysql2($tb,$data,$condition){
	
		for($i=0; $i<count($data[field]); $i++){		
			$sql[data].=$data[field][$i]."=".$data[value][$i]."";
			if($i!=(count($data[field])-1)) $sql[data].=",";			
		}		
		
		$sql[update]="update $tb set $sql[data] $condition ";
	/*	echo $sql[update];
		echo "<br>" ;
		exit();*/ 
		$sql[queryupdate]=mysql_query($sql[update]);
		
		if($sql[queryupdate]){
			return true;	// 
		}else{
			return false;		// 
		}			
	}
		
	// ¿ñ§¡ìªñè¹åº¢éíáùåã¹°ò¹¢éíáùå
	function delete_mysql($tb,$condition){
	
		$sql[delete]="delete from $tb $condition";
		//echo $sql[delete];exit;
		$sql[querydelete]=mysql_query($sql[delete]);
		
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
	// ¿ñ§¡ìªñè¹åºãù»àò¾íí¡¨ò¡°ò¹¢éíáùå
	function deleteimage_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	function deleteimage_withthumbnail_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//unset($fileimg);
					$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
	
		function deleteimage_withtiny_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//unset($fileimg);
					//$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					//if(file_exists("$fileimg")) unlink("$fileimg");
					$fileimg=$imgpath."/tiny/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
	function deleteimagepdf_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//unset($fileimg);
					$fileimg=$imgpath."/pdf/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
	function deleteimage_withpdf_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//unset($fileimg);
					$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/pdf/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
		function deleteimage_withpopup_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/small/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/popup/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
			function deleteimage_withsmall_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/small/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
	function deleteimage_withtinysmall_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/tiny/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					
					$fileimg=$imgpath."/small/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	
	function deleteimage_withthumbnail_large_mysql($field,$tb,$condition,$imgpath){
	
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//unset($fileimg);
					$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					$fileimg=$imgpath."/large/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	//*******
	function deleteimage_withthumbnail_pdf_mysql($field,$tb,$condition,$imgpath){
		$gettmp=explode(",",$field);	
		$getdata=list_data($field,$tb,$condition);
		for($loop=0; $loop<$getdata[rows]; $loop++){
			foreach($gettmp as $tmp){			
				if ($getdata[data][$loop][$tmp] != ""){
					$fileimg=$imgpath."/thumbnail/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//$fileimg=$imgpath."/tiny/".$getdata[data][$loop][$tmp];
					//if(file_exists("$fileimg")) unlink("$fileimg");
					//unset($fileimg);
					$fileimg=$imgpath."/fullsize/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//pdf
					$fileimg=$imgpath."/pdf/".$getdata[data][$loop][$tmp];
					if(file_exists("$fileimg")) unlink("$fileimg");
					//pdf
				}					
			}
		}
	
		$sql[delete]="delete from $tb $condition";
		$sql[querydelete]=mysql_query($sql[delete]);
				
		if($sql[querydelete]){
			return true;	// 
		}else{
			return false;		// 
		}		
	}
	// ********
	function selectcount_mysql($field,$tb,$condition){	
	
		$sql[select]="select count($field) as counter from $tb $condition";
		//echo $sql[select];//exit;
		$sql[queryselect]=mysql_query($sql[select]);
		$sql[result]=@mysql_fetch_array($sql[queryselect]);
		return $sql[result][counter];	
	}
	
		function selectmax_mysql($field,$tb,$condition){	
	
		$sql[select]="select max($field) as counter from $tb $condition";
		//echo $sql[select];exit;
		$sql[queryselect]=mysql_query($sql[select]);
		$sql[result]=mysql_fetch_array($sql[queryselect]);
		return $sql[result][counter];	
	}
	// 
	
		function selectmin_mysql($field,$tb,$condition){	
	
		$sql[select]="select min($field) as counter from $tb $condition";
		//echo $sql[select];exit;
		$sql[queryselect]=mysql_query($sql[select]);
		$sql[result]=mysql_fetch_array($sql[queryselect]);
		return $sql[result][counter];	
	}
	// 
	
	function list_data($field,$tb,$condition){
	
		$sql[select]="select $field from $tb $condition ";
//echo $sql[select];
//		echo $sql[select];exit;
		$sql[queryselect]=mysql_query($sql[select]);
		$getdata[rows]=@mysql_num_rows($sql[queryselect]);
		
		for($loop=0; $loop<$getdata[rows]; $loop++){		
			$getdata[data][]=mysql_fetch_array($sql[queryselect]);
		} 
		
		return $getdata;
	
	}
	function list_distinctdata($field,$tb,$condition){
	
		$sql[select]="select DISTINCT $field from $tb $condition ";
//echo $sql[select];
//		echo $sql[select];exit;
		$sql[queryselect]=mysql_query($sql[select]);
		$getdata[rows]=@mysql_num_rows($sql[queryselect]);
		
		for($loop=0; $loop<$getdata[rows]; $loop++){		
			$getdata[data][]=mysql_fetch_array($sql[queryselect]);
		} 
		
		return $getdata;
	
	}	

?>