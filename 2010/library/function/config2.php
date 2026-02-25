<?php
// config database
$config[driver]='mysqli';
$config[dbname]='pakkretcitydb';
$config[host]='wh-db06.csloxinfo.com';
$config[dbuser]='pakkretcity';
$config[dbpassword]='ojA6iarKnl';
$config[utf8]= true ;
// config site
$config[website]='http://www.sakulthiti.com';
$config[basesite]='http://www.sakulthiti.com'; //no tailing plz
$config[shownews]=5;
$config[showproduct]=21;
$config[showlist]=50;
$config[showproduct]=15;
$config[showimage]=8;
$config[maxfilesize]=4*1024*1024;
$config[maxfilesize2]="4 mb.";

// config for news
$config[news][normal][imgwidth]=114;
$config[news][normal][imgheight]=86;
$config[news][activitys][imgwidth]=100;
$config[news][activitys][imgheight]=75;
$config[news][activityb][imgwidth]=400;
$config[news][activityb][imgheight]=300;

// config for image upload
$config[err][database]="database error, please try again!!!";
$config[err][deletefile]="delete files is complete!!!";
$config[err][uploadtype]="file extensions should only be .gif, .jpg, .png and max file size ($config[maxfilesize2])";
$config[err][uploadcomplete]="upload images is complete!!!";
$config[err][uploadfail]="upload images is not complete!!!";
?>
