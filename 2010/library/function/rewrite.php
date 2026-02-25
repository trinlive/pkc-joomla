<?php
if (!isset($_SERVER['REQUEST_URI']))
{
       $_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'],1 );
       if (isset($_SERVER['QUERY_STRING'])) { $_SERVER['REQUEST_URI'].='?'.$_SERVER['QUERY_STRING']; }
}
// getPath returns any path info as an array
function getPathInfo() {
//$_SERVER['PATH_INFO'] ;
if(isset($_SERVER['REQUEST_URI'])) {
list($nulll,$URI) = array_filter(explode('?',$_SERVER['REQUEST_URI']));
$params = array_filter(explode('/', $URI));
return $params;
}
else { return $params=array(); }
}
 // print_r(getPathInfo()) ; 
list($nulll,$where,$andwhere,$what,$andwhat,$with,$andwith) = getPathInfo()  ;
?>