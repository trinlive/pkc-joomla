<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['content/(:num)'] = 'content/index/$1';
$route['content/heighlight/(:num)'] = 'content/heighlight/$1';

$route['news/(:any)/all'] = 'news/all/$1';
$route['news/(:any)'] = 'news/index/$1';
$route['call/(:any)'] = 'call/index/$1';
$route['auth/signup/(:any)'] = 'auth/signup/index/$1';

$route['activity/(:num)'] = 'activity/index/$1';
$route['download/(:num)'] = 'download/index/$1';
$route['auction/(:any)'] = 'auction/index/$1';
$route['account/(:any)'] = 'account/index/$1';
$route['service/(:num)'] = 'service/index/$1';


$route['administator/upload/(:any)'] = 'administator/upload/index/$1';
$route['administator/upload/(:any)/(:any)'] = 'administator/upload/index/$1/$2';
$route['administator/preference/menu/(:any)'] = 'administator/preference/menu/$1';
$route['administator/media/activity/(:any)/(:any)'] = 'administator/media/activity/$1/$2';


/* End of file routes.php */
/* Location: ./application/config/routes.php */