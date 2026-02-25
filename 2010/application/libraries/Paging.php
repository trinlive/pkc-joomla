<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Paging{
		
		var $correntpage;
		var $startpage;
		var $endpage;
		var $prevpage;
		var $nextpage; 
		var $firstpage;
		var $lastpage;
		var $linkto = '';
		
		function Paging(){
			
		}
		
		function set($TotalRecordCount,$ShowPerPage,$ShowPage,$Page){
			$TotalPage = ceil($TotalRecordCount/$ShowPerPage);
			
			if($ShowPage % 2 == 0){
				$CBackPage = $ShowPage/2;
				$CNextPage = $CBackPage-1;
			}else{
				$CBackPage = intval($ShowPage/2);
				$CNextPage = $CBackPage;
			}
		
			$PreviousPage = $Page-1;
			$NextPage = $Page+1;
			
			$LimitStartPage = ($TotalPage-$ShowPage)+1;
			if($LimitStartPage < 1){
				$LimitStartPage = 1;
			}
			$ChkStartPage = $Page-$CBackPage;
			if($ChkStartPage < 1){
				$StartPage = 1;
			}else if($ChkStartPage > $LimitStartPage){
				$StartPage = $LimitStartPage;
			}else{
				$StartPage = $ChkStartPage;
			}
			
			$LimitEndPage = $ShowPage;
			if($LimitEndPage > $TotalPage){
				$LimitEndPage = $TotalPage;
			}
			$ChkEndPage = $Page+$CNextPage;
			if($ChkEndPage > $TotalPage){
				$EndPage = $TotalPage;
			}else if($ChkEndPage < $LimitEndPage){
				$EndPage = $LimitEndPage;
			}else{
				$EndPage = $ChkEndPage;
			}
			
			$this->currentpage = $Page;
			$this->prevpage = $PreviousPage;
			$this->nextpage = $NextPage;
			$this->startpage = $StartPage;
			$this->endpage = $EndPage;
			$this->firstpage =1;
			$this->lastpage = $TotalPage;
			//return $this->prevpage."-".$this->nextpage."-".$this->startpage."-".$this->endpage;
		}
		
		function start(){
			return $this->startpage;
		}
		
		function end(){
			return $this->endpage;
		}
		
		function prev(){
			return $this->prevpage;
		}
		
		function next(){
			return $this->nextpage;
		}
		
		function first(){
			return $this->firstpage;
		}
		
		function last(){
			return $this->lastpage;
		}
		
		function linkto($url){
			$this->linkto = $url;
		}
		
		function create_link($page_no){
			$url = $this->linkto;
			$exp_link = explode('?',$this->linkto);
			if(count($exp_link) == 1){
				$url .= '?pg='.$page_no;
			}else{
				if($exp_link[1] == ''){
					$url .= 'pg='.$page_no;
				}else{
					$url .= '&pg='.$page_no;
				}
			}
			return $url;
		}
		function render(){
			$paging = '<div class="dataTables_paginate paging_bootstrap"><ul class="pagination">';

			if($this->prevpage >= 1){
				$paging .= '<li><a href="'.$this->create_link($this->prevpage).'">ย้อนกลับ</a></li>';
			}
				
			for($i=$this->startpage;$i<=$this->endpage;$i++){
				if($i == $this->currentpage){
					$paging .= '<li class="active"><a href="'.$this->create_link($i).'">'.$i.'</a></li>';
				}else{
					$paging .= '<li><a href="'.$this->create_link($i).'">'.$i.'</a></li>';
				}
		
			}
				
			if($this->nextpage <= $this->lastpage){
				$paging .= '<li><a href="'.$this->create_link($this->nextpage).'">ถัดไป</a></li>';
			}

			$paging .= '</ul></div>';
				
			return $paging;
		}
		
	}
?>