<?php

/*****************************************************************************
*
*   Author   : Eric Sizemore ( www.secondversion.com )
*   Package  : SV's Simple Contact
*   Version  : 1.0.3
*   Copyright: (C) 2005-2006 Eric Sizemore
*   Site     : www.secondversion.com
*   Email    : esizemore05@gmail.com
*   File     : includes/functions.php
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
*   This program is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*   GNU General Public License for more details.
*
*****************************************************************************/

if (!defined('IN_SC'))
{
    die();
}

/**
* Strip any unsafe tags/chars/attributes from input values.
*
* @param  string  Value to be cleaned
* @param  boolean Strip \r\n ?
* @return string
*/
function sanitize($value, $strip_crlf = true)
{
    // Some of what we have in the $search array may not be needed, but let's be safe.
    $search = array(
        '@<script[^>]*?>.*?</script>@si',
        '@<applet[^>]*?>.*?</applet>@si',
        '@<object[^>]*?>.*?</object>@si',
        '@<iframe[^>]*?>.*?</iframe>@si',
        '@<style[^>]*?>.*?</style>@si',
        '@<form[^>]*?>.*?</form>@si',
        '@<[\/\!]*?[^<>]*?>@si',
        '@&(?!(#[0-9]+|[a-z]+);)@si'
    );

    if ($strip_crlf)
    {
        $search[] = '@([\r\n])[\s]+@';
    }
    $value = preg_replace($search, '', $value);

    // Make sure we get everything..
    $value = strip_tags($value);
    return clean($value);
}

/**
* Trim and strip slashes from data
*
* @param  string  Data to be cleaned
* @return string
*/
function clean($data)
{
    return trim(stripslashes($data));
}

/**
* Tests for a valid email address
*
* @param  string  Email address
* @return boolean
*/
function is_valid_email($email)
{
    if (preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s\'"<>]+\.+[a-z]{2,6}))$#si', $email))
    {
        return true;
    }
    return false;
}

/**
* Tests input data from the contact form for email injection - very basic
*
* @param  string  Data to check
* @return boolean
*/
function is_email_injection($data)
{
    if (preg_match('#(To:|Bcc:|Cc:|Content-type:|Mime-version:|Content-Transfer-Encoding:|\\r\\n)#i', urldecode($data)))
    {
        return true;
    }
    return false;
}

/**
* Checks input values from the contact form for a set number of links.
* Can be useful to catch someone trying to spam you.
*
* @param  string  Value to check
* @return boolean
*/
function is_spam($value, $numlinks)
{
    preg_match_all('#(<a href|\[url|http:\/\/)#i', $value, $matches, PREG_PATTERN_ORDER);

    if (count($matches[0]) > SPAM_NUM_LINKS)
    {
        return true;
    }
    return false;
}

/*
*Get the users ip address
*
*@return string
*/
function get_ip()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else if (isset($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (isset($_SERVER['HTTP_FROM']))
    {
        $ip = $_SERVER['HTTP_FROM'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>