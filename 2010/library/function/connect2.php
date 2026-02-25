<?php
 $db = &NewADOConnection($config[driver]); 
#@$db->debug=1;    
 $db->autoRollback = true; # default is false
 $db->Connect($config[host], $config[dbuser], $config[dbpassword],$config[dbname]);
 if (!$db) die("Connection failed");
if ($config[utf8]) @$db->Execute('SET NAMES utf8');
?>