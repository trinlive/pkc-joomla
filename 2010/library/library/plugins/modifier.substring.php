<?php
/*
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * Filename: .../smarty/plugins/modifier.substring.php
 * -------------------------------------------------------------
 * Type: modifier
 * Name: substring
 * Version: 0.1
 * Date: 2006-16-02
 * Author: Thorsten Albrecht <thor_REMOVE.THIS_@wolke7.net>
 * Purpose: "substring" allows you to retrieve a small part (substring) of a string. 
 * Notes: The substring is specified by giving the start  position and the length. 
 * Unlike the original function substr() in PHP the position of the characters	
 * in the string starts at 1 (not at 0 as usual in php).
 * Example smarty code:
 *   {$my_string|substring:2:4} 
 *   returns substring from character 2 until character 6
 * @link based on substr(): http://www.zend.com/manual/function.substr.php
 * @param string
 * @param position: startposition of the substring, beginning with 1
 * @param length: length of  substring
 * @return string
 *
 * -------------------------------------------------------------
 */

function smarty_modifier_substring($string, $position, $length){
		mb_internal_encoding("utf8");
		if(mb_strlen($string, 'utf-8') >$length){
			$gettxt = mb_substr($string,$position-1,$length)."...";
		}else{
			$gettxt=$string ;
		}	
		return  $gettxt;
}
?>