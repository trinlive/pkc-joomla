<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fotoupload
 *
 * @author Rawipong
 */
require_once(APPPATH.'libraries/FotoUpload/class.upload.foto.php');
require_once(APPPATH.'libraries/FotoUpload/class.upload2.php');
class Fotoupload extends upload {
    //put your code here
    var $CI;
	function Fotoupload()
	{
		$this->CI =& get_instance();
	}
}
?>
