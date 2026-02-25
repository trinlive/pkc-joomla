<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template
| group to make active.  By default there is only one group (the
| "default" group).
|
*/
$template['active_template'] = 'default';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land.
|   You may also include default markup, wrappers and attributes here
|   (though not recommended). Region keys must be translatable into variables
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/

/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['default']['template'] = 'layouts/default/index';
$template['default']['template_core'] = 'layouts/index';
$template['default']['regions'] = array(
    'content'
);
$template['default']['regions_map'] = '';
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;
$template['default']['css'] = array();
$template['default']['js'] = array();
$template['default']['doctype'] = '';
$template['default']['use_favicon'] = FALSE;
$template['default']['favicon_location'] = '';
$template['default']['meta_content'] = '';
$template['default']['meta_language'] = '';
$template['default']['meta_author'] = '';
$template['default']['meta_description'] = '';
$template['default']['meta_keywords'] = '';
$template['default']['meta'] = array();
$template['default']['body_id'] = '';
$template['default']['body_class'] = '';
$template['default']['site_title'] = '';
$template['default']['title'] = '';
//----

/*
|--------------------------------------------------------------------------
| Weadmin login Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/
$template['administator_login']['template'] = 'layouts/administator/index_login';
$template['administator_login']['template_core'] = 'layouts/index';
$template['administator_login']['regions'] = array(
	'title',
    'content'
);
$template['administator_login']['regions_map'] = '';
$template['administator_login']['parser'] = 'parser';
$template['administator_login']['parser_method'] = 'parse';
$template['administator_login']['parse_template'] = FALSE;
$template['administator_login']['css'] = array(
	array('layouts/administator/plugins/bootstrap/css/bootstrap.min.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/font-awesome/css/font-awesome.min.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/fonts/style.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/main.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/main-responsive.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/perfect-scrollbar/src/perfect-scrollbar.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/theme_light.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/print.css', 'print', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/font-awesome/css/font-awesome-ie7.min.css', 'print', '', FALSE, FALSE, 'css_core'),

);
$template['administator_login']['js'] = array(
	array('layouts/administator/lib/jquery-1.8.1.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/lib/bootstrap/js/bootstrap.js', '', FALSE, FALSE, 'js_core'),
);

$template['administator_login']['doctype'] = 'html5';
$template['administator_login']['use_favicon'] = FALSE;
$template['administator_login']['favicon_location'] = '';
$template['administator_login']['meta_content'] = '';
$template['administator_login']['meta_language'] = 'utf-8';
$template['administator_login']['meta_author'] = '';
$template['administator_login']['meta_description'] = '';
$template['administator_login']['meta_keywords'] = '';
$template['administator_login']['meta'] = array();
$template['administator_login']['body_id'] = '';

$template['administator_login']['body_class'] = 'login example1';
$template['administator_login']['site_title'] = '';
$template['administator_login']['title'] = 'เทศบาลนครปากเกร็ด | Administator';

/*
|--------------------------------------------------------------------------
| Weadmin Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/
$template['administator']['template'] = 'layouts/administator/index';
$template['administator']['template_core'] = 'layouts/index';
$template['administator']['regions'] = array(
	'title',
    'header',
	'breadcrumb',
	'sidebar',
	'content',
	'footer'
);
$template['administator']['regions_map'] = '';
$template['administator']['parser'] = 'parser';
$template['administator']['parser_method'] = 'parse';
$template['administator']['parse_template'] = FALSE;
$template['administator']['css'] = array(
	array('layouts/administator/plugins/bootstrap/css/bootstrap.min.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/font-awesome/css/font-awesome.min.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/fonts/style.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/main.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/main-responsive.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/iCheck/skins/all.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/plugins/perfect-scrollbar/src/perfect-scrollbar.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/theme_light.css', 'screen', '', FALSE, FALSE, 'css_core'),

	array('layouts/administator/css/common.css', 'screen', '', FALSE, FALSE, 'css_core'),

    array('layouts/administator/plugins/datepicker/css/datepicker.css', 'screen', '', FALSE, FALSE, 'css_core'),
    array('layouts/administator/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'screen', '', FALSE, FALSE, 'css_core'),
    array('layouts/administator/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', 'screen', '', FALSE, FALSE, 'css_core'),
    array('layouts/administator/plugins/bootstrap-datetimepicker-0.0.11/css/bootstrap-datetimepicker.min.css', 'screen', '', FALSE, FALSE, 'css_core'),
    array('layouts/administator/plugins/jQuery-Tags-Input/jquery.tagsinput.css', 'screen', '', FALSE, FALSE, 'css_core'),
    array('layouts/administator/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css', 'screen', '', FALSE, FALSE, 'css_core'),
    array('layouts/administator/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css', 'screen', '', FALSE, FALSE, 'css_core'),
    array('layouts/administator/plugins/bootstrap-modal/css/bootstrap-modal.css', 'screen', '', FALSE, FALSE, 'css_core'),


);
$template['administator']['js'] = array(
	array('layouts/administator/plugins/respond.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/excanvas.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/js/ajax/libs/jquery/1.10.2/jquery.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/js/ajax/libs/jquery/2.0.3/jquery.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap/js/bootstrap.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/blockUI/jquery.blockUI.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/iCheck/jquery.icheck.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/perfect-scrollbar/src/jquery.mousewheel.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/perfect-scrollbar/src/perfect-scrollbar.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/jquery-cookie/jquery.cookie.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/ckeditor/ckeditor.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/ckeditor/build-config.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/js/main.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/jquery.maskedinput/src/jquery.maskedinput.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-daterangepicker/daterangepicker.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/jQuery-Tags-Input/jquery.tagsinput.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/fullcalendar/fullcalendar/fullcalendar.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-modal/js/bootstrap-modal.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/plugins/bootstrap-modal/js/bootstrap-modalmanager.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/js/ui-modals.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/js/form-elements.js', '', FALSE, FALSE, 'js_core'),

);
$template['administator']['doctype'] = 'html5';
$template['administator']['use_favicon'] = FALSE;
$template['administator']['favicon_location'] = '';
$template['administator']['meta_content'] = '';
$template['administator']['meta_language'] = '';
$template['administator']['meta_author'] = '';
$template['administator']['meta_description'] = '';
$template['administator']['meta_keywords'] = '';
$template['administator']['meta'] = array();
$template['administator']['body_id'] = '';
$template['administator']['body_class'] = '';
$template['administator']['site_title'] = '';
$template['administator']['title'] = 'เทศบาลนครปากเกร็ด | Admin';

/*
|--------------------------------------------------------------------------
| Weadmin login Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/
$template['administator_blank']['template'] = 'layouts/administator/index_blank';
$template['administator_blank']['template_core'] = 'layouts/index';
$template['administator_blank']['regions'] = array(
    'content'
);
$template['administator_blank']['regions_map'] = '';
$template['administator_blank']['parser'] = 'parser';
$template['administator_blank']['parser_method'] = 'parse';
$template['administator_blank']['parse_template'] = FALSE;
$template['administator_blank']['css'] = array(
	array('layouts/administator/css/black/screen_blank.css', 'screen', '', FALSE, FALSE, 'css_core'),
	array('layouts/administator/css/custom.css', 'screen', '', FALSE, FALSE, 'css_core')
);
$template['administator_blank']['js'] = array(
	array('js/libs/jquery-1.6.4.min.js', '', FALSE, FALSE, 'js_core'),
	array('js/libs/jquery-ui-1.8.2.custom.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/administator/js/hint.js', '', FALSE, FALSE, 'js_core'),
);
$template['administator_blank']['doctype'] = '';
$template['administator_blank']['use_favicon'] = FALSE;
$template['administator_blank']['favicon_location'] = '';
$template['administator_blank']['meta_content'] = '';
$template['administator_blank']['meta_language'] = '';
$template['administator_blank']['meta_author'] = '';
$template['administator_blank']['meta_description'] = '';
$template['administator_blank']['meta_keywords'] = '';
$template['administator_blank']['meta'] = array();
$template['administator_blank']['body_id'] = '';
$template['administator_blank']['body_class'] = '';
$template['administator_blank']['site_title'] = '';
$template['administator_blank']['title'] = 'TRUE | Admin';


/*
|--------------------------------------------------------------------------
| frontend Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/
$template['frontend']['template'] = 'layouts/frontend/index';
$template['frontend']['template_core'] = 'layouts/index';
$template['frontend']['regions'] = array(
    'header',
	'sidebar_left',
	'breadcrumb',
	'content',
	'sidebar_right',
	'footer'
);
$template['frontend']['regions_map'] = '';
$template['frontend']['parser'] = 'parser';
$template['frontend']['parser_method'] = 'parse';
$template['frontend']['parse_template'] = FALSE;
$template['frontend']['css'] = array(
    array('layouts/frontend/css/bootstrap.min.css', 'all', '', FALSE, FALSE, 'css_core'),
    array('layouts/frontend/fancybox2/source/jquery.fancybox.css?v=2.1.5', 'all', '', FALSE, FALSE, 'css_core'),
    array('layouts/frontend/css/prettyPhoto.css', 'all', '', FALSE, FALSE, 'css_core'),
    array('layouts/frontend/css/layout.css', 'all', '', FALSE, FALSE, 'css_core'),
    array('layouts/frontend/css/navbar.css', 'all', '', FALSE, FALSE, 'css_core'),
    array('layouts/frontend/css/theme.css', 'all', '', FALSE, FALSE, 'css_core'),
    array('layouts/frontend/css/fonts.css', 'all', '', FALSE, FALSE, 'css_core')
		
);
$template['frontend']['js'] = array(
		
	array('js/libs/jquery-1.10.2.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/frontend/js/bootstrap.min.js', '', FALSE, FALSE, 'js_core'),
    array('layouts/frontend/fancybox2/source/jquery.fancybox.js?v=2.1.5', '', FALSE, FALSE, 'js_core'),
    array('layouts/frontend/js/jquery.prettyPhoto.js', '', FALSE, FALSE, 'js_core'),
    array('layouts/frontend/plugins/ckeditor/ckeditor.js', '', FALSE, FALSE, 'js_core'),
    array('layouts/frontend/plugins/ckeditor/build-config.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/frontend/js/docs.min.js', '', FALSE, FALSE, 'js_core'),
	array('layouts/frontend/js/ie10-viewport-bug-workaround.js', '', FALSE, FALSE, 'js_core'),

);
$template['frontend']['doctype'] = 'html5';
$template['frontend']['use_favicon'] = TRUE;
$template['frontend']['favicon_location'] = '';
$template['frontend']['meta_content'] = '';
$template['frontend']['meta_language'] = '';
$template['frontend']['meta_author'] = '';
$template['frontend']['meta_description'] = '';
$template['frontend']['meta_keywords'] = '';
$template['frontend']['meta'] = array();
$template['frontend']['body_id'] = '';
$template['frontend']['body_class'] = '';
$template['frontend']['site_title'] = '';
$template['frontend']['title'] = 'เทศบาลนครปากเกร็ด';

/*
 |--------------------------------------------------------------------------
| frontend Blank Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/
$template['frontend_blank']['template'] = 'layouts/frontend/index_blank';
$template['frontend_blank']['template_core'] = 'layouts/index';
$template['frontend_blank']['regions'] = array(
		'title',
		'content'
);
$template['frontend_blank']['regions_map'] = '';
$template['frontend_blank']['parser'] = 'parser';
$template['frontend_blank']['parser_method'] = 'parse';
$template['frontend_blank']['parse_template'] = FALSE;
$template['frontend_blank']['css'] = array(

);
$template['frontend_blank']['js'] = array(
		array('js/libs/jquery-1.6.4.min.js', '', FALSE, FALSE, 'js_core'),
);
$template['frontend_blank']['doctype'] = '';
$template['frontend_blank']['use_favicon'] = TRUE;
$template['frontend_blank']['favicon_location'] = '';
$template['frontend_blank']['meta_content'] = '';
$template['frontend_blank']['meta_language'] = '';
$template['frontend_blank']['meta_author'] = '';
$template['frontend_blank']['meta_description'] = '';
$template['frontend_blank']['meta_keywords'] = '';
$template['frontend_blank']['meta'] = array();
$template['frontend_blank']['body_id'] = '';
$template['frontend_blank']['body_class'] = '';
$template['frontend_blank']['site_title'] = '';
$template['frontend_blank']['title'] = 'เทศบาลนครปากเกร็ด';


/* End of file template.php */
/* Location: ./system/application/config/template.php */