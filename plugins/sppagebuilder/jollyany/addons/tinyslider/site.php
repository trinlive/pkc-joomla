<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonTinyslider extends SppagebuilderAddons {

    public function render() {

        $settings = $this->addon->settings;
        $class = (isset($settings->class) && $settings->class) ? $settings->class : '';
        $interval = (isset($settings->interval) && $settings->interval) ? ((int) $settings->interval * 1000) : 3000;
        $controls = (isset($settings->controls) && $settings->controls) ? $settings->controls : 0;
        $bullet_position = (isset($settings->bullet_position) && $settings->bullet_position) ? $settings->bullet_position : 'bottom-center';
        $arrow_controls = (isset($settings->arrow_controls) && $settings->arrow_controls) ? $settings->arrow_controls : 0;
        $addon_id = '#jollyany-tinyslider-' . $this->addon->id;

        //Options
        $content_alignment = (isset($settings->content_alignment)) ? $settings->content_alignment : 'sppb-text-center';

        //Output
        $output = '<div id="jollyany-tinyslider-' . $this->addon->id . '" class="jollyany-tinyslider sppb-slide '.$content_alignment.' ' . $class . '"' . '>';
        $output .= '<div class="tiny-slider">';
        $dots   =   '';
        if (!isset($settings->sp_tinyslider_item)) return '';
        foreach ($settings->sp_tinyslider_item as $key => $value) {
            $name = (isset($value->title) && $value->title) ? $value->title : '';
            $content_position = (isset($value->content_position)) ? $value->content_position : 'middle-center';

            //Button options
            $btn_text = (isset($value->btn_text) && trim($value->btn_text)) ? $value->btn_text : '';
            $btn_class = '';
            $btn_class .= (isset($value->btn_type) && $value->btn_type) ? ' sppb-btn-' . $value->btn_type : '';
            $btn_class .= (isset($value->btn_size) && $value->btn_size) ? ' sppb-btn-' . $value->btn_size : '';
            $btn_class .= (isset($value->btn_shape) && $value->btn_shape) ? ' sppb-btn-' . $value->btn_shape : ' sppb-btn-rounded';
            $btn_class .= (isset($value->btn_appearance) && $value->btn_appearance) ? ' sppb-btn-' . $value->btn_appearance : '';
            $attribs    =   '';

            if(isset($value->btn_url) && $value->btn_url) {
                $attribs .= ' href="' . $value->btn_url . '"';
                $attribs .= ' id="btn-' . $this->addon->id . '-'.$key.'"';
                $video = parse_url($value->btn_url);
                if (isset($video['host']) && in_array($video['host'], ['youtu.be','www.youtube.com','youtube.com','vimeo.com','www.vimeo.com'])) {
                    $doc = JFactory::getDocument();
                    $doc->addStyleSheet('media/jollyany/assets/js/vendor/jquery.fancybox.min.css');
                    $doc->addScript('media/jollyany/assets/js/vendor/jquery.fancybox.min.js');
                    $attribs .= ' data-fancybox=""';
                } else {
                    $attribs .= (isset($value->btn_target) && $value->btn_target) ? ' target="' . $value->btn_target . '"' : '';
                }
            }
            $btn_icon = (isset($value->btn_icon) && $value->btn_icon) ? $value->btn_icon : '';
            $btn_icon_position = (isset($value->btn_icon_position) && $value->btn_icon_position) ? $value->btn_icon_position : 'left';

            $icon_arr = array_filter(explode(' ', $btn_icon));
            if (count($icon_arr) === 1) {
                $btn_icon = 'fa ' . $btn_icon;
            }

            if ($btn_icon_position == 'left') {
                $btn_text = ($btn_icon) ? '<i class="' . $btn_icon . '" aria-hidden="true"></i> ' . $btn_text : $btn_text;
            } else {
                $btn_text = ($btn_icon) ? $btn_text . ' <i class="' . $btn_icon . '" aria-hidden="true"></i>' : $btn_text;
            }

            $output .= '<div class="sppb-slider-item">';
            $output .= '<div class="sppb-slider-item-image">';
            if (isset($value->image) && $value->image) {
                $image_src = $value->image;
                if ( strpos( $image_src, 'http://' ) !== false || strpos( $image_src, 'https://' ) !== false ) {
                    $image_src = $image_src;
                } elseif ( $image_src ) {
                    $image_src = JURI::base( true ) . '/' . $image_src;
                }
                $output .= '<img src="' . $image_src . '" class="featured-image" alt="' . $name . '">';
            }

            $output .= '</div>';
            $output .= '<div class="sppb-slider-item-inner-container '.$content_position.'">';
            $output .= '<div class="sppb-slider-item-inner">';
            if(isset($value->title) && $value->title){
                $output .= '<h3 class="sppb-slider-title">';
                $output .= $value->title;
                $output .= '</h3>';
            }
            if(isset($value->message) && $value->message){
                $output .= '<div class="sppb-slider-message">';
                $output .= $value->message;
                $output .= '</div>';
            }
            if(isset($value->btn_url) && $value->btn_url) {
                $output .= '<a' . $attribs . ' class="sppb-btn ' . $btn_class . '">' . $btn_text . '</a>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $dots .= '<li class="dot"></li>';
        }
        $output .= '</div>';
        $jstext =   '';
        if ($arrow_controls) {
            $output .= '<ul class="controls">
            <li class="prev">
              <i class="lnr lnr-chevron-left"></i>
            </li>
            <li class="next">
              <i class="lnr lnr-chevron-right"></i>
            </li>
          </ul>';
            $jstext     .=      '"controlsContainer": "'.$addon_id.' .controls","controls": true,';
        } else {
            $jstext     .=   '"controls": false,';
        }
        if ($controls) {
            $output .= '<ul class="dots '.$bullet_position.'">'. $dots .'</ul>';
            $jstext     .=      '"navContainer": "'.$addon_id.' .dots","nav": true,';
        } else {
            $jstext     .=      '"nav": false,';
        }
        $output .= '<script type="text/javascript">
    tns({
    "container": "'.$addon_id.' .tiny-slider",
    "mode": "gallery",
    '.$jstext.'
  "items": 1,
  "animateIn": "fadeIn",
  "animateOut": "fadeOut",
  "speed": '.$interval.',
  "swipeAngle": false,
  "autoplay":true,
  "mouseDrag": true,
  "autoplayButtonOutput":false
  });
</script>';
        $output .= '</div>';

        return $output;
    }

    public function scripts() {
        return array(JURI::base(true) . '/media/jollyany/assets/js/vendor/tiny-slider.min.js');
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $settings = $this->addon->settings;

        //Css output start
        $css = '';

        //Background color
        $css .= (isset($settings->message_background) && $settings->message_background) ? $addon_id . " .sppb-slider-item-inner {background-color: " . $settings->message_background . ";}" : "";
        $css .= (isset($settings->overlay) && $settings->overlay) ? $addon_id . " .sppb-slider-item::before {content: ''; position: absolute; top:0; left:0; right:0; bottom:0; background-color: " . $settings->overlay . ";}" : "";

        //Arrow Style
        $arrow_style = '';
        $arrow_style .= (isset($settings->arrow_background) && $settings->arrow_background) ? "background-color: " . $settings->arrow_background . ";" : "";
        $arrow_style .= (isset($settings->arrow_color) && $settings->arrow_color) ? "color: " . $settings->arrow_color . ";" : "";

        //Arrow hover style
        $arrow_hover_style = '';
        $arrow_hover_style .= (isset($settings->arrow_hover_background) && $settings->arrow_hover_background) ? "background-color: " . $settings->arrow_hover_background . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_color) && $settings->arrow_hover_color) ? "color: " . $settings->arrow_hover_color . ";" : "";

        if($arrow_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .jollyany-tinyslider ul.controls li{';
            $css .= $arrow_style;
            $css .= '}';
        }

        if($arrow_hover_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .jollyany-tinyslider ul.controls li:hover{';
            $css .= $arrow_hover_style;
            $css .= '}';
        }
        if (isset($settings->content_padding->md)) $settings->content_padding = $settings->content_padding->md;
        $css .= (isset($settings->content_padding) && trim($settings->content_padding)) ? $addon_id . ' .sppb-slider-item-inner{padding:' . $settings->content_padding . ';}' : '';
        if (isset($settings->content_margin->md)) $settings->content_margin = $settings->content_margin->md;
        $css .= (isset($settings->content_margin) && trim($settings->content_margin)) ? $addon_id . ' .sppb-slider-item-inner{margin:' . $settings->content_margin . ';}' : '';

        //Content style
        $content_style ='';
        $content_style .= (isset($settings->content_color) && $settings->content_color) ? 'color:' . $settings->content_color . ';' : '';
        if (isset($settings->content_lineheight->md)) $settings->content_lineheight = $settings->content_lineheight->md;
        $content_style .= (isset($settings->content_lineheight) && $settings->content_lineheight) ? 'line-height:' . $settings->content_lineheight . 'px;' : '';
        if (isset($settings->content_fontsize->md)) $settings->content_fontsize = $settings->content_fontsize->md;
        $content_fontsize = (isset($settings->content_fontsize) && $settings->content_fontsize) ? 'font-size:' . $settings->content_fontsize . 'px;' : '';
        $content_font_style = (isset($settings->content_font_style) && $settings->content_font_style) ? $settings->content_font_style : '';

        if(isset($content_font_style->underline) && $content_font_style->underline){
            $content_style .= 'text-decoration:underline;';
        }
        if(isset($content_font_style->italic) && $content_font_style->italic){
            $content_style .= 'font-style:italic;';
        }
        if(isset($content_font_style->uppercase) && $content_font_style->uppercase){
            $content_style .= 'text-transform:uppercase;';
        }
        if(!isset($content_font_style->weight)){
            $content_style .= 'font-weight:400;';
        }
        if(isset($content_font_style->weight) && $content_font_style->weight){
            $content_style .= 'font-weight:'.$content_font_style->weight.';';
        }
        if($content_style || $content_fontsize){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-message {';
            $css .= $content_style;
            $css .= $content_fontsize;
            $css .= '}';
        }
        //Title style
        $title_style = '';
        $title_style .= (isset($settings->title_color) && $settings->title_color) ? 'color:'.$settings->title_color . ';' : '';
        if (isset($settings->title_font_size->md)) $settings->title_font_size = $settings->title_font_size->md;
        $title_style .= (isset($settings->title_font_size) && $settings->title_font_size) ? 'font-size:'.$settings->title_font_size . 'px;' : '';
        if (isset($settings->title_line_height->md)) $settings->title_line_height = $settings->title_line_height->md;
        $title_style .= (isset($settings->title_line_height) && $settings->title_line_height) ? 'line-height:'.$settings->title_line_height . 'px;' : '';
        $title_style .= (isset($settings->title_letterspace) && $settings->title_letterspace) ? 'letter-spacing:'.$settings->title_letterspace . ';' : '';
        $title_style .= (isset($settings->title_margin_top) && $settings->title_margin_top) ? 'margin-top:'.$settings->title_margin_top . 'px;' : '';
        if (isset($settings->title_margin_bottom->md)) $settings->title_margin_bottom = $settings->title_margin_bottom->md;
        $title_style .= (isset($settings->title_margin_bottom) && $settings->title_margin_bottom) ? 'margin-bottom:'.$settings->title_margin_bottom . 'px;' : '';
        $title_font_style = (isset($settings->title_font_style) && $settings->title_font_style) ? $settings->title_font_style : '';
        if(isset($title_font_style->underline) && $title_font_style->underline){
            $title_style .= 'text-decoration:underline;';
        }
        if(isset($title_font_style->italic) && $title_font_style->italic){
            $title_style .= 'font-style:italic;';
        }
        if(isset($title_font_style->uppercase) && $title_font_style->uppercase){
            $title_style .= 'text-transform:uppercase;';
        }
        if(!isset($title_font_style->weight)){
            $title_style .= 'font-weight:700;';
        }
        if(isset($title_font_style->weight) && $title_font_style->weight){
            $title_style .= 'font-weight:'.$title_font_style->weight.';';
        }
        if($title_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-title {';
            $css .= $title_style;
            $css .= '}';
        }

        //Bullet style
        $bullet_border_color = (isset($settings->bullet_border_color) && $settings->bullet_border_color) ? $settings->bullet_border_color . ';' : '';
        if($bullet_border_color){
            $css .= '#sppb-addon-' . $this->addon->id . ' .jollyany-tinyslider ul.dots li:before {';
            $css .= 'background-color:'.$bullet_border_color.';';
            $css .= '}';
        }
        //Active Bullet
        $bullet_active_bg_color = (isset($settings->bullet_active_bg_color) && $settings->bullet_active_bg_color) ? $settings->bullet_active_bg_color . ';' : '';
        if($bullet_active_bg_color){
            $css .= '#sppb-addon-' . $this->addon->id . ' .jollyany-tinyslider ul.dots li.tns-nav-active:before  {';
            $css .= 'background-color:'.$bullet_active_bg_color.';';
            $css .= '}';
        }

        //Height of Slider
        if (isset($settings->height->md)) $settings->height = $settings->height->md;
        $height = (isset($settings->height)) ? $settings->height : '530';
        $css .= $addon_id . ' .tiny-slider {height:'.$height.'px;}';

        //Button Style
        foreach ($settings->sp_tinyslider_item as $key => $value) {
            $layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
            $css_path = new JLayoutFile('addon.css.button', $layout_path);
            $options = new stdClass;
            $options->button_type = (isset($value->btn_type) && $value->btn_type) ? $value->btn_type : '';
            $options->button_appearance = (isset($value->btn_appearance) && $value->btn_appearance) ? $value->btn_appearance : '';
            $options->button_color = (isset($value->btn_color) && $value->btn_color) ? $value->btn_color : '';
            $options->button_color_hover = (isset($value->btn_color_hover) && $value->btn_color_hover) ? $value->btn_color_hover : '';
            $options->button_background_color = (isset($value->btn_background_color) && $value->btn_background_color) ? $value->btn_background_color : '';
            $options->button_background_color_hover = (isset($value->btn_background_color_hover) && $value->btn_background_color_hover) ? $value->btn_background_color_hover : '';
            $options->button_fontstyle = (isset($value->btn_fontstyle) && $value->btn_fontstyle) ? $value->btn_fontstyle : '';
            $options->button_font_style = (isset($value->btn_font_style) && $value->btn_font_style) ? $value->btn_font_style : '';
            if (isset($value->button_padding->md)) $value->button_padding = $value->button_padding->md;
            $options->button_padding = (isset($value->button_padding) && $value->button_padding) ? $value->button_padding : '';
            $options->button_padding_sm = (isset($value->button_padding_sm) && $value->button_padding_sm) ? $value->button_padding_sm : '';
            $options->button_padding_xs = (isset($value->button_padding_xs) && $value->button_padding_xs) ? $value->button_padding_xs : '';
            if (isset($value->btn_fontsize->md)) $value->btn_fontsize = $value->btn_fontsize->md;
            $options->fontsize = (isset($value->btn_fontsize) && $value->btn_fontsize) ? $value->btn_fontsize : '';
            $options->fontsize_sm = (isset($value->btn_fontsize_sm) && $value->btn_fontsize_sm) ? $value->btn_fontsize_sm : '';
            $options->fontsize_xs = (isset($value->btn_fontsize_xs) && $value->btn_fontsize_xs) ? $value->btn_fontsize_xs : '';
            $options->button_letterspace = (isset($value->btn_letterspace) && $value->btn_letterspace) ? $value->btn_letterspace : '';
            $options->button_background_gradient = (isset($value->btn_background_gradient) && $value->btn_background_gradient) ? $value->btn_background_gradient : new stdClass();
            $options->button_background_gradient_hover = (isset($value->btn_background_gradient_hover) && $value->btn_background_gradient_hover) ? $value->btn_background_gradient_hover : new stdClass();

            //Button Margin
            if (isset($value->button_margin->md)) $value->button_margin = $value->button_margin->md;
            $button_margin = (isset($value->button_margin) && $value->button_margin) ? $value->button_margin : '';
            $button_margin_sm = ((isset($value->button_margin_sm)) && $value->button_margin_sm) ? $value->button_margin_sm : '';
            $button_margin_xs = ((isset($value->button_margin_xs)) && $value->button_margin_xs) ? $value->button_margin_xs : '';

            if ($button_margin) {
                $css .= '#btn-' . $this->addon->id.'-'.$key.' {';
                $css .= 'margin: ' . $button_margin . ';';
                $css .= '}';
            }
            $css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $options, 'id' => 'btn-' . $this->addon->id.'-'.$key));

            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if ($button_margin_sm) {
                $css .= '#btn-' . $this->addon->id.'-'.$key.' {';
                $css .= 'margin: ' . $button_margin_sm . ';';
                $css .= '}';
            }
            $css .= '}';

            $css .= '@media (max-width: 767px) {';
            if ($button_margin_xs) {
                $css .= '#btn-' . $this->addon->id.'-'.$key.' {';
                $css .= 'margin: ' . $button_margin_xs . ';';
                $css .= '}';
            }
            $css .= '}';

        }

        //Style for Tablet
        $height_sm = (isset($settings->height_sm)) ? $settings->height_sm : '530';
        $title_font_size_sm = (isset($settings->title_font_size_sm) && $settings->title_font_size_sm) ? 'font-size:' . $settings->title_font_size_sm . 'px;' : '';
        $title_line_height_sm = (isset($settings->title_line_height_sm) && $settings->title_line_height_sm) ? 'line-height:' . $settings->title_line_height_sm . 'px;' : '';
        $title_margin_top_sm = (isset($settings->title_margin_top_sm) && $settings->title_margin_top_sm) ? 'margin-top:' . $settings->title_margin_top_sm . 'px;' : '';
        $title_margin_bottom_sm = (isset($settings->title_margin_bottom_sm) && $settings->title_margin_bottom_sm) ? 'margin-bottom:' . $settings->title_margin_bottom_sm . 'px;' : '';
        $content_fontsize_sm = (isset($settings->content_fontsize_sm) && $settings->content_fontsize_sm) ? 'font-size:' . $settings->content_fontsize_sm . 'px;' : '';
        $content_lineheight_sm = (isset($settings->content_lineheight_sm) && $settings->content_lineheight_sm) ? 'line-height:' . $settings->content_lineheight_sm . 'px;' : '';
        $content_margin_sm = (isset($settings->content_margin_sm) && $settings->content_margin_sm) ? 'margin:' . $settings->content_margin_sm . ';' : '';
        $content_padding_sm = (isset($settings->content_padding_sm) && $settings->content_padding_sm) ? 'padding:' . $settings->content_padding_sm . ';' : '';

        if( $content_fontsize_sm || $content_margin_sm || $content_padding_sm || $title_font_size_sm || $title_line_height_sm || $content_lineheight_sm || $height_sm ){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if ($height_sm) $css .= $addon_id . ' .tiny-slider {height:'.$height_sm.'px;}';

            if ($content_fontsize_sm || $content_lineheight_sm) {
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-message {';
                $css .= $content_fontsize_sm;
                $css .= $content_lineheight_sm;
                $css .= '}';
            }

            if ($content_margin_sm || $content_padding_sm) {
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-item-inner {';
                $css .= $content_margin_sm;
                $css .= $content_padding_sm;
                $css .= '}';
            }

            if($title_font_size_sm || $title_line_height_sm || $title_margin_top_sm || $title_margin_bottom_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-title {';
                $css .= $title_font_size_sm;
                $css .= $title_line_height_sm;
                $css .= $title_margin_top_sm;
                $css .= $title_margin_bottom_sm;
                $css .= '}';
            }

            $css .= '}';
        }
        //Mobile
        $height_xs = (isset($settings->height_xs)) ? $settings->height_xs : '530';
        $title_font_size_xs = (isset($settings->title_font_size_xs) && $settings->title_font_size_xs) ? 'font-size:' . $settings->title_font_size_xs . 'px;' : '';
        $title_line_height_xs = (isset($settings->title_line_height_xs) && $settings->title_line_height_xs) ? 'line-height:' . $settings->title_line_height_xs . 'px;' : '';
        $title_margin_top_xs = (isset($settings->title_margin_top_xs) && $settings->title_margin_top_xs) ? 'margin-top:' . $settings->title_margin_top_xs . 'px;' : '';
        $title_margin_bottom_xs = (isset($settings->title_margin_bottom_xs) && $settings->title_margin_bottom_xs) ? 'margin-bottom:' . $settings->title_margin_bottom_xs . 'px;' : '';
        $content_fontsize_xs = (isset($settings->content_fontsize_xs) && $settings->content_fontsize_xs) ? 'font-size:' . $settings->content_fontsize_xs . 'px;' : '';
        $content_lineheight_xs = (isset($settings->content_lineheight_xs) && $settings->content_lineheight_xs) ? 'line-height:' . $settings->content_lineheight_xs . 'px;' : '';
        $content_margin_xs = (isset($settings->content_margin_xs) && $settings->content_margin_xs) ? 'margin:' . $settings->content_margin_xs . ';' : '';
        $content_padding_xs = (isset($settings->content_padding_xs) && $settings->content_padding_xs) ? 'padding:' . $settings->content_padding_xs . ';' : '';

        if($content_fontsize_xs || $content_margin_xs || $content_padding_xs || $title_font_size_xs || $title_line_height_xs || $content_lineheight_xs || $height_xs){
            $css .= '@media (max-width: 767px) {';
            if ($height_xs) $css .= $addon_id . ' .tiny-slider {height:'.$height_xs.'px;}';

            if ($content_fontsize_xs || $content_lineheight_xs) {
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-message {';
                $css .= $content_fontsize_xs;
                $css .= $content_lineheight_xs;
                $css .= '}';
            }

            if ($content_margin_xs || $content_padding_xs) {
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-item-inner {';
                $css .= $content_margin_xs;
                $css .= $content_padding_xs;
                $css .= '}';
            }

            if($title_font_size_xs || $title_line_height_xs || $title_margin_top_xs || $title_margin_bottom_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-title {';
                $css .= $title_font_size_xs;
                $css .= $title_line_height_xs;
                $css .= $title_margin_top_xs;
                $css .= $title_margin_bottom_xs;
                $css .= '}';
            }
            $css .= '}';
        }

        return $css;
    }
}