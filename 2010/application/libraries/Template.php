<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/Template_lib' . EXT;

class CI_Template extends CI_Template_lib {

    public $base_uri = '';
    public $cache_path = '';
    public $cache_uri = '';
    private $_set_template = FALSE;
    private $_config;
    private $_template;
    private $carabiner_config;

    public function __construct() {
        parent::__construct();

        $this->CI = & get_instance();

        // Asset Management Library
        $this->CI->load->library('head');
        $this->CI->load->library('carabiner');
        $this->CI->load->helper(array('cache', 'hashing'));

        $this->CI->config->load('carabiner');
        $this->cb_config = $this->CI->config->item('carabiner');
    }

    /**
     * Load Config
     * @access	public
     * @param	Array of config variables. Requires script_dir(string), style_dir(string), and cache_dir(string).
     * 			base_uri(string), dev(bool), combine(bool), minify_js(bool), minify_css(bool), and force_curl(bool) are optional.
     * @return   Void
     */
    public function config($config) {
        $this->CI->carabiner->config($config);
    }

    /**
     * Add CSS file to queue
     * @access	public
     * @param	String of the path to development version of the CSS file. Could also be an array, or array of arrays.
     * @param	String of the media type, usually one of (screen, print, handheld) for css. Defaults to screen.
     * @param	String of the path to production version of the CSS file. NOT REQUIRED
     * @param	Boolean flag whether the file is to be combined. NOT REQUIRED
     * @return   Void
     */
    public function css($dev_file, $media = 'screen', $prod_file = '', $combine = TRUE, $minify = TRUE, $group = 'main') {
        $this->CI->carabiner->css($dev_file, $media, $prod_file, $combine, $minify, $group);
        $base_uri = isset($this->cb_config['base_url']) ? $this->cb_config['base_url'] : $this->CI->config->item('base_url');
        if (is_url($dev_file)) {
            $file = $dev_file;
        } else {
            $file = $base_uri . $this->cb_config['style_dir'] . $dev_file;
        }

        return array('path' => $file, 'media' => $media, 'prod' => $prod_file, 'combine' => $combine, 'minify' => $minify, 'group' => $group);
    }

    public function css_view($dev_file, $data = NULL, $media = 'screen', $prod_file = '', $combine = TRUE, $minify = TRUE, $group = 'main') {
        $file = $this->add_view('css', $dev_file, $data);
        return $this->css($file, $media, $prod_file, $combine, $minify, $group);
    }

    /**
     * Add JS file to queue
     * @access	public
     * @param	String of the path to development version of the JS file.  Could also be an array, or array of arrays.
     * @param	String of the path to production version of the JS file. NOT REQUIRED
     * @param	Boolean flag whether the file is to be combined. NOT REQUIRED
     * @return   Void
     */
    public function js($dev_file, $prod_file = '', $combine = TRUE, $minify = TRUE, $group = 'main') {
        $this->CI->carabiner->js($dev_file, $prod_file, $combine, $minify, $group);
        $base_uri = isset($this->cb_config['base_url']) ? $this->cb_config['base_url'] : $this->CI->config->item('base_url');
        if (is_url($dev_file)) {
            $file = $dev_file;
        } else {
            $file = $base_uri . $this->cb_config['script_dir'] . $dev_file;
        }

        return array('path' => $file, 'prod' => $prod_file, 'combine' => $combine, 'minify' => $minify, 'group' => $group);
    }

    public function js_view($dev_file, $data = NULL, $prod_file = '', $combine = TRUE, $minify = TRUE, $group = 'main') {
        $file = $this->add_view('js', $dev_file, $data);
        return $this->js($file, $prod_file, $combine, $minify, $group);
    }

    /**
     * Display HTML references to the assets
     * @access	public
     * @param	String flag the asset type: css || js || both, OR the group name
     * @param	String flag the asset type to filter a group (e.g. only show 'js' for this group)
     * @return   Void
     */
    public function display($flag = 'both', $group_filter = NULL) {
        $this->CI->carabiner->display($flag, $group_filter);
    }

    private function add_view($type, $dev_file, $data = NULL) {
        $file_data = $this->CI->load->view($dev_file, $data, TRUE);
        $filename = md5($file_data) . '.' . $type;

        // set the default value for base_uri from the config
        $hash_path = hashing_dir($filename);
        $this->base_uri = isset($this->cb_config['base_url']) ? $this->cb_config['base_url'] : $this->CI->config->item('base_url');
        $this->cache_path = FCPATH . $this->cb_config['cache_dir'] . 'views/' . $hash_path . '/';
        $this->cache_uri = $this->base_uri . $this->cb_config['cache_dir'] . 'views/' . $hash_path . '/';

        $filepath = $this->cache_path . $filename;

        if (!file_exists($filepath)) {
            $cache_path_lv1 = implode('/', explode('/', $this->cache_path, -2)) . '/';
            cache_dir($cache_path_lv1);
            cache_dir($this->cache_path);
            $success = file_put_contents($filepath, $file_data);
            if ($success)
                log_message('debug', 'Carabiner: Cache file ' . $filename . ' was written to ' . $this->cache_path);
            else
                log_message('error', 'Carabiner: There was an error writing cache file ' . $filename . ' to ' . $this->cache_path);
        }

        return $this->cache_uri . $filename;
    }

    private function set_head() {
        if ($this->_template['doctype'] != '')
            $this->CI->head->doctype = $this->_template['doctype'];
        if ($this->_template['use_favicon'] != '')
            $this->CI->head->use_favicon = $this->_template['use_favicon'];
        if ($this->_template['favicon_location'] != '')
            $this->CI->head->favicon_location = $this->_template['favicon_location'];
        if ($this->_template['meta_content'] != '')
            $this->CI->head->meta_content = $this->_template['meta_content'];
        if ($this->_template['meta_language'] != '')
            $this->CI->head->meta_language = $this->_template['meta_language'];
        if ($this->_template['meta_author'] != '')
            $this->CI->head->meta_author = $this->_template['meta_author'];
        if ($this->_template['meta_description'] != '')
            $this->CI->head->meta_description = $this->_template['meta_description'];
        if ($this->_template['meta_keywords'] != '')
            $this->CI->head->meta_keywords = $this->_template['meta_keywords'];
		if ($this->_template['meta'] != '')
            //$this->CI->head->meta = $this->_template['meta'];
        if ($this->_template['body_id'] != '')
            $this->CI->head->body_id = $this->_template['body_id'];
        if ($this->_template['body_class'] != '')
            $this->CI->head->body_class = $this->_template['body_class'];
        if ($this->_template['site_title'] != '')
            $this->CI->head->site_title = $this->_template['site_title'];
        if ($this->_template['title'] != '')
            $this->CI->head->title = $this->_template['title'];

        $_var_css = 'css';

        if (count($this->_template[$_var_css]) > 0) {
            foreach ($this->_template[$_var_css] as $item) {
                $item[1] = isset($item[1]) ? $item[1] : 'screen';
                $item[2] = isset($item[2]) ? $item[2] : '';
                $item[3] = isset($item[3]) ? $item[3] : TRUE;
                $item[4] = isset($item[4]) ? $item[4] : TRUE;
                $item[5] = isset($item[5]) ? $item[5] : 'main';
                $this->css($item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);
            }
        }

        if (count($this->_template['js']) > 0) {
            foreach ($this->_template['js'] as $item) {
                $item[1] = isset($item[1]) ? $item[1] : '';
                $item[2] = isset($item[2]) ? $item[2] : TRUE;
                $item[3] = isset($item[3]) ? $item[3] : TRUE;
                $item[4] = isset($item[4]) ? $item[4] : 'main';
                $this->js($item[0], $item[1], $item[2], $item[3], $item[4]);
            }
		}
    }

    private function set_config() {
        include(APPPATH . 'config/template' . EXT);

        $_config = $template;

        if ($this->_set_template === FALSE)
            $this->_set_template = $_config['active_template'];

        $this->_template = $_config[$this->_set_template];
    }

    private function set_region() {
        $regions_map = $this->_template['regions_map'];
        $model = $regions_map . '_template';

        if ($regions_map !== FALSE && $regions_map != '') {
            $this->CI->load->model('template/' . $model);
            foreach ($this->_template['regions'] as $method) {
                if (method_exists($model, $method))
                    $this->CI->$model->$method();
            }
        }
    }

    public function set_template($group) {
        $this->_set_template = $group;

        parent::set_template($group);

        $this->set_config();
        $this->set_head();
        $this->set_region();
    }

    public function render($region = NULL, $buffer = FALSE, $parse = FALSE){
        if (is_null($region)) {
            $template = parent::render(NULL, TRUE, $parse) . "\n";

            $template_core = $this->_template['template_core'];

            if ($buffer === FALSE) {
                $render = $this->CI->load->view($template_core, array('template' => $template), TRUE);
                echo $render;
            } else {
                $render = $this->CI->load->view($template_core, array('template' => $template), TRUE);
                return $render;
            }
        } else {
            if ($buffer === FALSE) {
                $render = parent::render($region, TRUE, $parse);
                echo $render;
            } else {
                $render = parent::render($region, $buffer, $parse);
                return $render;
            }
        }
    }

}

// END Template Class

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */