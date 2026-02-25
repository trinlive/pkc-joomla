<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Hasing string to be path
 *
 * To increase file system performance
 * Directory Node
 *
 * @access	 public
 * @param string anything to be hashed
 * @param integer path deep level
 * @param string algorithm to hash (adler32, md5, sha1)
 * @return	string
 */
if (!function_exists('hashing_dir')) {

    function hashing_dir($string, $level=2, $algorithm='adler32') {
        if ($level <= 0) {
            return false;
        }

        $hash_string = hash($algorithm, $string);

        $dirs = array();
        for ($i = 1; $i <= $level; $i++) {
            array_push($dirs, substr($hash_string, 0, $i));
        }

        return implode('/', $dirs);
    }

}
?>