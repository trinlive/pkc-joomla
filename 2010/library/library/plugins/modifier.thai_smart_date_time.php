<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty thai smart date/time
 *
 * Type:     modifier<br>
 * Name:     thai_smart_date_time<br>
 * Version:  1.01
 * Created:  2007-09-02
 * Purpose:  Convert date/time to smart thai date/time format with 3 conditions.
 *              1. DataTime as today, this modifier will return only time string. 
 *                 Example: INPUT '2007-09-02 23:08:01', OUTPUT: '23:08'
 *              2. DataTime as this year, return only date string without year. 
 *                 Example: INPUT '2007-09-02 23:08:01', OUTPUT: '2 กย.'
 *              3. DataTime as past year, return date string with year. 
 *                 Example: INPUT '2007-09-02 23:08:01', OUTPUT: '2 กย. 2550'
 * Last Updated :  2008-02-14
 * By           : Roteee
 * Descrioption : Added the input date/time, date and time separator
 *
 * @author Roteee <roteee at gmail dot com>, http://www.phpzealots.com
 * @param  string $dateTime: Y-m-d H:i:s, for example: 2007-09-02 23:08:01
 * @param  string $dateSeperator default to one space (' ')
 * @param  string $dateTimeSeperator default to one dash ('-')
 * @param  string $timeSeperator default to one colon (':')
 * @return string
 */
function smarty_modifier_thai_smart_date_time($dateTime, $dateSeperator='-', $dateTimeSeperator=' ', $timeSeperator=':')
{
    if( empty($dateTime) )
    {
        return false;
    }

    $thMonthMap = array(
           1 => 'มกราคม'
        , 2 => 'กุมภาพันธ์'
        , 3 => 'มีนาคม'
        , 4 => 'เมษายน'
        , 5 => 'พฤษภาคม'
        , 6 => 'มิถุนายน'
        , 7 => 'กรกฎาคม'
        , 8 => 'สิงหาคม'
        , 9 => 'กันยายน'
        ,10 => 'ตุลาคม'
        ,11 => 'พฤศจิกายน'
        ,12 => 'ธันวาคม'
    );

    list($date, $time)  = @explode($dateTimeSeperator, $dateTime);
    list($Y, $m, $d)    = @explode($dateSeperator, $date);
    list($H, $i, $s)    = @explode($timeSeperator, $time);

   
        // Past year
		return intval($d) . ' ' . $thMonthMap[intval($m)] . ' ' . ($Y+543);

}
?>