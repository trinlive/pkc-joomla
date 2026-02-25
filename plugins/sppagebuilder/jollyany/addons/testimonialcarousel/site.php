<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\HTML\HTMLHelper;

class SppagebuilderAddonTestimonialcarousel extends SppagebuilderAddons {

    public function render() {

        $settings = $this->addon->settings;
        $class = (isset($settings->class) && $settings->class) ? $settings->class : '';

        //Options
        $interval = (isset($settings->interval) && $settings->interval) ? ((int) $settings->interval * 1000) : 3000;
        $avatar_shape = (isset($settings->avatar_shape) && $settings->avatar_shape) ? $settings->avatar_shape : 'sppb-avatar-circle';
        $show_quote = (isset($settings->show_quote)) ? $settings->show_quote : true;
        $content_alignment = (isset($settings->content_alignment)) ? $settings->content_alignment : 'sppb-text-center';
        $testimonial_type = (isset($settings->testimonial_type)) ? $settings->testimonial_type : 'slides';

        if ($testimonial_type == 'owl-carousel') {
            \JFactory::getDocument()->addScript(JURI::base(true) . '/media/jollyany/assets/js/vendor/owl.carousel.min.js');
            \JFactory::getDocument()->addStyleSheet(JURI::base(true) . '/media/jollyany/assets/js/vendor/owl.carousel.min.css');
            \JFactory::getDocument()->addStyleSheet(JURI::base(true) . '/media/jollyany/assets/js/vendor/owl.theme.default.min.css');
        }

        $testimonial_type = (isset($settings->testimonial_type)) ? $settings->testimonial_type : 'slides';

        //Output
        $output = '<div id="jollyany-testimonial-slider-' . $this->addon->id . '" class="sppb-slider-wrap sppb-testimonial-carousel sppb-slide carousel slide carousel-fade '.$content_alignment.' ' . $class . '"' . ($testimonial_type == 'slides' ? ' data-bs-ride="carousel"' : '') . '>';
        $output .= '<ul class="'.($testimonial_type == 'slides' ? 'slides carousel-inner overflow-visible' : $testimonial_type).'">';

        foreach ($settings->sp_testimonialpro_item as $key => $value) {
            $name = (isset($value->title) && $value->title) ? $value->title : '';
            $output .= '<li class="sppb-slider-item'.($testimonial_type == 'slides' ? ' carousel-item'.($key == 0 ? ' active' : '') : '').'"'.($testimonial_type == 'slides' ? ' data-bs-interval="'.$interval.'"' : '').'>';
            if ($testimonial_type == 'slides') {
                $output .= '<div class="sppb-slider-item-image">';
                $output .= (isset($value->image) && $value->image) ? '<img src="' . $value->image . '" class="featured-image" alt="' . $name . '">' : '';
                $output .= '</div>';
            }
            $output .= '<div class="sppb-slider-item-inner">';
            if($show_quote){
                $output .= '<span class="fa fa-quote-left quote-icon" aria-hidden="true"></span>';
            }
            if(isset($value->message) && $value->message){
                $output .= '<div class="sppb-testimonial-message">';
                $output .= $value->message;
                $output .= '</div>';
            }
            $output .= '<div class="sppb-addon-testimonial-pro-footer">';
            $output .= (isset($value->avatar) && $value->avatar) ? '<img src="' . $value->avatar . '" class="' . $avatar_shape . '" alt="' . $name . '">' : '';
            $output .= '<div class="testimonial-pro-client-name-wrap">';
            $output .= $name ? '<span class="sppb-addon-testimonial-pro-client-name">' . $name . '</span>' : '';
            $output .= (isset($value->url) && $value->url) ? '&nbsp;-&nbsp;<span class="sppb-addon-testimonial-pro-client-url">' . $value->url . '</span>' : '';
            $output .= (isset($value->designation) && $value->designation) ? '<div class="sppb-addon-testimonial-pro-client-designation">' . $value->designation . '</div>' : '';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    public function js() {
        $settings = $this->addon->settings;
        $testimonial_type = (isset($settings->testimonial_type)) ? $settings->testimonial_type : 'slides';
        $addon_id = '#jollyany-testimonial-slider-' . $this->addon->id;
        $js = '';
        if ($testimonial_type== 'owl-carousel') {
            HTMLHelper::_('jquery.framework');
            $js ='
            jQuery(function($){
                $(document).ready(function(){
                  $("'.$addon_id.' .owl-carousel").owlCarousel({
                    margin:30,
                    responsive: {
                        0:{
                            items:1
                        },
                        768:{
                            items:2
                        },
                        992:{
                            items:3
                        }
                    }
                  });
                });
            })';
        }

        return $js;
    }

    public function css() {
        $addon_id = '#jollyany-testimonial-slider-' . $this->addon->id;
        $settings = $this->addon->settings;
        //Avatar Style
        if (isset($settings->avatar_width->md)) $settings->avatar_width = $settings->avatar_width->md;
        $avatar_size = (isset($settings->avatar_width) && $settings->avatar_width) ? $settings->avatar_width : '32';

        //Css output start
        $css = '';

        $css .= $addon_id . ' .sppb-addon-testimonial-pro-footer img{width:'.$avatar_size.'px; height:'.$avatar_size.'px;}';
        $css .= $addon_id . ' .sppb-item > img{width:'.$avatar_size.'px; height:'.$avatar_size.'px;}';

        //Background color
        $css .= (isset($settings->message_background) && $settings->message_background) ? $addon_id . " .sppb-slider-item-inner {background-color: " . $settings->message_background . ";}" : "";
        $css .= (isset($settings->boxshadow_background) && $settings->boxshadow_background) ? '@media (min-width: 992px) {'.$addon_id . ".sppb-testimonial-carousel .slides .sppb-slider-item-image img {box-shadow: -55px 55px 0 " . $settings->boxshadow_background . ";}}" : "";

        //Icon Style
        $icon_style = '';
        $icon_style_sm = '';
        $icon_style_xs = '';

        $icon_style .= (isset($settings->icon_color) && $settings->icon_color) ? "color: " . $settings->icon_color . ";" : "";
        if (isset($settings->icon_size->md)) $settings->icon_size = $settings->icon_size->md;
        $icon_style .= (isset($settings->icon_size) && $settings->icon_size) ? "font-size: " . $settings->icon_size . "px;" : "";
        $icon_style_sm .= (isset($settings->icon_size_sm) && $settings->icon_size_sm) ? "font-size: " . $settings->icon_size_sm . "px;" : "";
        $icon_style_xs .= (isset($settings->icon_size_xs) && $settings->icon_size_xs) ? "font-size: " . $settings->icon_size_xs . "px;" : "";
        //Arrow Style
        $arrow_style = '';
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "height: " . $settings->arrow_height . "px;" : "";
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "line-height: " . (($settings->arrow_height)-($settings->arrow_border_width)) . "px;" : "";
        $arrow_style .= (isset($settings->arrow_width) && $settings->arrow_width) ? "width: " . $settings->arrow_width . "px;" : "";
        $arrow_style .= (isset($settings->arrow_background) && $settings->arrow_background) ? "background-color: " . $settings->arrow_background . ";" : "";
        $arrow_style .= (isset($settings->arrow_color) && $settings->arrow_color) ? "color: " . $settings->arrow_color . ";" : "";
        $arrow_style .= (isset($settings->arrow_margin) && trim($settings->arrow_margin)) ? "margin: " . $settings->arrow_margin . ";" : "";
        $arrow_style .= (isset($settings->arrow_font_size) && $settings->arrow_font_size) ? "font-size: " . $settings->arrow_font_size . "px;" : "";
        $arrow_style .= (isset($settings->arrow_border_width) && $settings->arrow_border_width) ? "border-width: " . $settings->arrow_border_width . "px;" : "";
        $arrow_style .= (isset($settings->arrow_border_color) && $settings->arrow_border_color) ? "border-color: " . $settings->arrow_border_color . ";" : "";
        $arrow_style .= (isset($settings->arrow_border_radius) && $settings->arrow_border_radius) ? "border-radius: " . $settings->arrow_border_radius . "px;" : "";

        //Arrow hover style
        $arrow_hover_style = '';
        $arrow_hover_style .= (isset($settings->arrow_hover_background) && $settings->arrow_hover_background) ? "background-color: " . $settings->arrow_hover_background . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_color) && $settings->arrow_hover_color) ? "color: " . $settings->arrow_hover_color . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_border_color) && $settings->arrow_hover_border_color) ? "border-color: " . $settings->arrow_hover_border_color . ";" : "";

        if($arrow_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control{';
            $css .= $arrow_style;
            $css .= '}';
        }

        if($arrow_hover_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control:hover{';
            $css .= $arrow_hover_style;
            $css .= '}';
        }

        if($icon_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-slider-item-inner .quote-icon{ ' . $icon_style . ' }';
        }
        //Content style
        $content_style ='';
        $content_style .= (isset($settings->content_color) && $settings->content_color) ? 'color:' . $settings->content_color . ';' : '';
        if (isset($settings->content_lineheight->md)) $settings->content_lineheight = $settings->content_lineheight->md;
        $content_style .= (isset($settings->content_lineheight) && $settings->content_lineheight) ? 'line-height:' . $settings->content_lineheight . 'px;' : '';
        $content_style .= (isset($settings->content_fontweight) && $settings->content_fontweight) ? 'font-weight:' . $settings->content_fontweight . ';' : '';
        if (isset($settings->content_margin->md)) $settings->content_margin = $settings->content_margin->md;
        $content_style .= (isset($settings->content_margin) && $settings->content_margin) ? 'margin:' . $settings->content_margin . ';' : '';
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
            $content_style .= 'font-weight:700;';
        }
        if(isset($content_font_style->weight) && $content_font_style->weight){
            $content_style .= 'font-weight:'.$content_font_style->weight.';';
        }
        if($content_style || $content_fontsize){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-message {';
            $css .= $content_style;
            $css .= $content_fontsize;
            $css .= '}';
        }
        //Name style
        $name_style = '';
        $name_style .= (isset($settings->name_color) && $settings->name_color) ? 'color:'.$settings->name_color . ';' : '';
        if (isset($settings->name_font_size->md)) $settings->name_font_size = $settings->name_font_size->md;
        $name_style .= (isset($settings->name_font_size) && $settings->name_font_size) ? 'font-size:'.$settings->name_font_size . 'px;' : '';
        if (isset($settings->name_line_height->md)) $settings->name_line_height = $settings->name_line_height->md;
        $name_style .= (isset($settings->name_line_height) && $settings->name_line_height) ? 'line-height:'.$settings->name_line_height . 'px;' : '';
        $name_style .= (isset($settings->name_letterspace) && $settings->name_letterspace) ? 'letter-spacing:'.$settings->name_letterspace . ';' : '';
        $name_font_style = (isset($settings->name_font_style) && $settings->name_font_style) ? $settings->name_font_style : '';
        if(isset($name_font_style->underline) && $name_font_style->underline){
            $name_style .= 'text-decoration:underline;';
        }
        if(isset($name_font_style->italic) && $name_font_style->italic){
            $name_style .= 'font-style:italic;';
        }
        if(isset($name_font_style->uppercase) && $name_font_style->uppercase){
            $name_style .= 'text-transform:uppercase;';
        }
        if(!isset($name_font_style->weight)){
            $name_style .= 'font-weight:700;';
        }
        if(isset($name_font_style->weight) && $name_font_style->weight){
            $name_style .= 'font-weight:'.$name_font_style->weight.';';
        }
        if($name_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {';
            $css .= $name_style;
            $css .= '}';
        }

        //Designation style
        $designation_style = '';
        $designation_style .= (isset($settings->designation_color) && $settings->designation_color) ? 'color:'.$settings->designation_color . ';' : '';
        if (isset($settings->designation_font_size->md)) $settings->designation_font_size = $settings->designation_font_size->md;
        $designation_style .= (isset($settings->designation_font_size) && $settings->designation_font_size) ? 'font-size:'.$settings->designation_font_size . 'px;' : '';
        if (isset($settings->designation_margin->md)) $settings->designation_margin = $settings->designation_margin->md;
        $designation_style .= (isset($settings->designation_margin) && $settings->designation_margin) ? 'margin:'.$settings->designation_margin . ';' : '';
        $designation_style .= (isset($settings->designation_letterspace) && $settings->designation_letterspace) ? 'letter-spacing:'.$settings->designation_letterspace . ';' : '';
        if (isset($settings->designation_line_height->md)) $settings->designation_line_height = $settings->designation_line_height->md;
        $designation_style .= (isset($settings->designation_line_height) && $settings->designation_line_height) ? 'line-height:'.$settings->designation_line_height . 'px;' : '';
        $designation_font_style = (isset($settings->designation_font_style) && $settings->designation_font_style) ? $settings->designation_font_style : '';
        if(isset($designation_font_style->underline) && $designation_font_style->underline){
            $designation_style .= 'text-decoration:underline;';
        }
        if(isset($designation_font_style->italic) && $designation_font_style->italic){
            $designation_style .= 'font-style:italic;';
        }
        if(isset($designation_font_style->uppercase) && $designation_font_style->uppercase){
            $designation_style .= 'text-transform:uppercase;';
        }
        if(isset($designation_font_style->weight) && $designation_font_style->weight){
            $designation_style .= 'font-weight:'.$designation_font_style->weight.';';
        }
        $designation_block = (isset($settings->designation_block) && $settings->designation_block) ? 'display:block;' : '';
        if($designation_style || $designation_block){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {';
            $css .= $designation_style;
            $css .= $designation_block;
            $css .= '}';
        }
        //Bullet style
        $bullet_border_color = (isset($settings->bullet_border_color) && $settings->bullet_border_color) ? $settings->bullet_border_color . ';' : '';
        if($bullet_border_color){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-indicators li {';
            $css .= 'border-color:'.$bullet_border_color.';';
            $css .= '}';
        }
        //Active Bullet
        $bullet_active_bg_color = (isset($settings->bullet_active_bg_color) && $settings->bullet_active_bg_color) ? $settings->bullet_active_bg_color . ';' : '';
        if($bullet_active_bg_color){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-indicators li.active {';
            $css .= 'background:'.$bullet_active_bg_color.';';
            $css .= '}';
        }

        //Height of Slider
        if (isset($settings->height->md)) $settings->height = $settings->height->md;
        $height = (isset($settings->height)) ? $settings->height : '530';
        $css .= $addon_id . ' .sppb-carousel-list {height:'.$height.'px;}';

        //Style for Tablet
        $height_sm = (isset($settings->height_sm)) ? $settings->height_sm : '530';
        $name_font_size_sm = (isset($settings->name_font_size_sm) && $settings->name_font_size_sm) ? 'font-size:' . $settings->name_font_size_sm . 'px;' : '';
        $name_line_height_sm = (isset($settings->name_line_height_sm) && $settings->name_line_height_sm) ? 'line-height:' . $settings->name_line_height_sm . 'px;' : '';
        $content_fontsize_sm = (isset($settings->content_fontsize_sm) && $settings->content_fontsize_sm) ? 'font-size:' . $settings->content_fontsize_sm . 'px;' : '';
        $content_lineheight_sm = (isset($settings->content_lineheight_sm) && $settings->content_lineheight_sm) ? 'line-height:' . $settings->content_lineheight_sm . 'px;' : '';
        $content_margin_sm = (isset($settings->content_margin_sm) && $settings->content_margin_sm) ? 'margin:' . $settings->content_margin_sm . ';' : '';
        $arrow_margin_sm = (isset($settings->arrow_margin) && $settings->arrow_margin) ? "margin: " . $settings->arrow_margin_sm . ";" : "";
        //Avatar Tablet Style
        $avatar_width_sm = (isset($settings->avatar_width_sm) && $settings->avatar_width_sm) ? $settings->avatar_width_sm : '';
        //Designation tablet style
        $designation_style_sm = '';
        $designation_style_sm .= (isset($settings->designation_font_size_sm) && $settings->designation_font_size_sm) ? 'font-size:'.$settings->designation_font_size_sm . 'px;' : '';
        $designation_style_sm .= (isset($settings->designation_margin_sm) && trim($settings->designation_margin_sm)) ? 'margin:'.$settings->designation_margin_sm . ';' : '';
        $designation_style_sm .= (isset($settings->designation_line_height_sm) && $settings->designation_line_height_sm) ? 'line-height:'.$settings->designation_line_height_sm . 'px;' : '';

        if($icon_style_sm || $content_fontsize_sm || $arrow_margin_sm || $content_margin_sm || $name_font_size_sm || $name_line_height_sm || $content_lineheight_sm || $avatar_width_sm || $designation_style_sm ){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            $css .= $addon_id . ' .sppb-carousel-list {height:'.$height_sm.'px;}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .fa-quote-left{';
            $css .= $icon_style_sm;
            $css .= '}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-message {';
            $css .= $content_fontsize_sm;
            $css .= $content_margin_sm;
            $css .= $content_lineheight_sm;
            $css .= '}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control{';
            $css .= $arrow_margin_sm;
            $css .= '}';
            if($name_font_size_sm || $name_line_height_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {';
                $css .= $name_font_size_sm;
                $css .= $name_line_height_sm;
                $css .= '}';
            }
            if($avatar_width_sm){
                $css .= $addon_id . ' .sppb-item > img{width:'.$avatar_width_sm.'px; height:'.$avatar_width_sm.'px;}';
            }
            if($designation_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {';
                $css .= $designation_style_sm;
                $css .= '}';
            }
            $css .= '}';
        }
        //Mobile
        $height_xs = (isset($settings->height_xs)) ? $settings->height_xs : '530';
        $name_font_size_xs = (isset($settings->name_font_size_xs) && $settings->name_font_size_xs) ? 'font-size:' . $settings->name_font_size_xs . 'px;' : '';
        $name_line_height_xs = (isset($settings->name_line_height_xs) && $settings->name_line_height_xs) ? 'line-height:' . $settings->name_line_height_xs . 'px;' : '';
        $content_fontsize_xs = (isset($settings->content_fontsize_xs) && $settings->content_fontsize_xs) ? 'font-size:' . $settings->content_fontsize_xs . 'px;' : '';
        $content_lineheight_xs = (isset($settings->content_lineheight_xs) && $settings->content_lineheight_xs) ? 'line-height:' . $settings->content_lineheight_xs . 'px;' : '';
        $content_margin_xs = (isset($settings->content_margin_xs) && $settings->content_margin_xs) ? 'margin:' . $settings->content_margin_xs . ';' : '';
        $arrow_margin_xs = (isset($settings->arrow_margin) && $settings->arrow_margin) ? "margin: " . $settings->arrow_margin_xs . ";" : "";
        //Avatar mobile style
        $avatar_width_xs = (isset($settings->avatar_width_xs) && $settings->avatar_width_xs) ? $settings->avatar_width_xs : '';
        //Designation mobile style
        $designation_style_xs = '';
        $designation_style_xs .= (isset($settings->designation_font_size_xs) && $settings->designation_font_size_xs) ? 'font-size:'.$settings->designation_font_size_xs . 'px;' : '';
        $designation_style_xs .= (isset($settings->designation_margin_xs) && $settings->designation_margin_xs) ? 'margin:'.$settings->designation_margin_xs . ';' : '';
        $designation_style_xs .= (isset($settings->designation_line_height_xs) && $settings->designation_line_height_xs) ? 'line-height:'.$settings->designation_line_height_xs . 'px;' : '';

        if($icon_style_xs || $content_fontsize_xs || $arrow_margin_xs || $content_margin_xs || $name_font_size_xs || $name_line_height_xs || $content_lineheight_xs || $avatar_width_xs || $designation_style_xs){
            $css .= '@media (max-width: 767px) {';
            $css .= $addon_id . ' .sppb-carousel-list {height:'.$height_xs.'px;}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .fa-quote-left{';
            $css .= $icon_style_xs;
            $css .= '}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-message {';
            $css .= $content_fontsize_xs;
            $css .= $content_margin_xs;
            $css .= $content_lineheight_xs;
            $css .= '}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control{';
            $css .= $arrow_margin_xs;
            $css .= '}';
            if($name_font_size_xs || $name_line_height_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {';
                $css .= $name_font_size_xs;
                $css .= $name_line_height_xs;
                $css .= '}';
            }
            if($avatar_width_xs){
                $css .= $addon_id . ' .sppb-item > img{width:'.$avatar_width_xs.'px; height:'.$avatar_width_xs.'px;}';
            }
            if($designation_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {';
                $css .= $designation_style_xs;
                $css .= '}';
            }
            $css .= '}';
        }

        return $css;
    }
}