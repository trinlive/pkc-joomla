<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2020 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonPieChart extends SppagebuilderAddons {

    public function render() {
        $class              = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $unit              = (isset($this->addon->settings->unit) && $this->addon->settings->unit) ? $this->addon->settings->unit : '';

        $addon_id = '#sppb-addon-' . $this->addon->id;

        $output = '<figure class="sppb-addon sppb-addon-pie-chart ' . $class . '">';
        $output .= '<figcaption>';
        foreach ($this->addon->settings->sp_pie_items as $key => $pie_item) {
            $output     .=  $pie_item->title.' '.$pie_item->value.$unit.'<span style="color:'.$pie_item->color.'"></span><br>';
        } // foreach timelines
        $output .= '</figcaption>';
        $output .= '</figure>';
        return $output;
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $settings = $this->addon->settings;

        $total  =   0;
        foreach ($this->addon->settings->sp_pie_items as $key => $pie_item) {
            $total  +=  $pie_item->value;
        } // foreach timelines
        $current_value  =   0;
        $css        =   $addon_id . ' .sppb-addon-pie-chart {';
        $css        .=  'background: radial-gradient(circle closest-side, transparent 66%, transparent 0),conic-gradient(';
        $css_pie    =   array();
        foreach ($this->addon->settings->sp_pie_items as $key => $pie_item) {
            $percent        =   ($pie_item->value/$total)*100+$current_value;
            $css_pie[]      =   $pie_item->color.' 0,'. $pie_item->color.' '.$percent.'%';
            $current_value  +=  ($pie_item->value/$total)*100;
        }
        $css        .=  implode(',', $css_pie).');';
        $css .= '}';

        //Title style
        $title_style = '';
        $title_style .= (isset($settings->title_color) && $settings->title_color) ? 'color:'.$settings->title_color . ';' : '';
        if (isset($settings->title_font_size->md)) $settings->title_font_size = $settings->title_font_size->md;
        $title_style .= (isset($settings->title_font_size) && $settings->title_font_size) ? 'font-size:'.$settings->title_font_size . 'px;' : '';
        if (isset($settings->title_line_height->md)) $settings->title_line_height = $settings->title_line_height->md;
        $title_style .= (isset($settings->title_line_height) && $settings->title_line_height) ? 'line-height:'.$settings->title_line_height . 'px;' : '';
        $title_style .= (isset($settings->title_letterspace) && $settings->title_letterspace) ? 'letter-spacing:'.$settings->title_letterspace . ';' : '';
        $title_style .= (isset($settings->title_margin_top) && $settings->title_margin_top) ? 'margin-top:'.$settings->title_margin_top . 'px;' : '';
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
        if(isset($title_font_style->weight) && $title_font_style->weight){
            $title_style .= 'font-weight:'.$title_font_style->weight.';';
        }
        if($title_style){
            $css .= $addon_id . ' .sppb-addon-pie-chart figcaption {';
            $css .= $title_style;
            $css .= '}';
        }

        //Tablet style
        $title_font_size_sm = (isset($settings->title_font_size_sm) && $settings->title_font_size_sm) ? 'font-size:' . $settings->title_font_size_sm . 'px;' : '';
        $title_line_height_sm = (isset($settings->title_line_height_sm) && $settings->title_line_height_sm) ? 'line-height:' . $settings->title_line_height_sm . 'px;' : '';
        $title_margin_top_sm = (isset($settings->title_margin_top_sm) && $settings->title_margin_top_sm) ? 'margin-top:' . $settings->title_margin_top_sm . 'px;' : '';
        $title_margin_bottom_sm = (isset($settings->title_margin_bottom_sm) && $settings->title_margin_bottom_sm) ? 'margin-bottom:' . $settings->title_margin_bottom_sm . 'px;' : '';

        if( $title_font_size_sm || $title_line_height_sm || $title_margin_top_sm || $title_margin_bottom_sm){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if($title_font_size_sm || $title_line_height_sm || $title_margin_top_sm || $title_margin_bottom_sm){
                $css .= $addon_id . ' .sppb-addon-pie-chart figcaption {';
                $css .= $title_font_size_sm;
                $css .= $title_line_height_sm;
                $css .= $title_margin_top_sm;
                $css .= $title_margin_bottom_sm;
                $css .= '}';
            }
            $css .= '}';
        }

        //Phone style
        $title_font_size_xs = (isset($settings->title_font_size_xs) && $settings->title_font_size_xs) ? 'font-size:' . $settings->title_font_size_xs . 'px;' : '';
        $title_line_height_xs = (isset($settings->title_line_height_xs) && $settings->title_line_height_xs) ? 'line-height:' . $settings->title_line_height_xs . 'px;' : '';
        $title_margin_top_xs = (isset($settings->title_margin_top_xs) && $settings->title_margin_top_xs) ? 'margin-top:' . $settings->title_margin_top_xs . 'px;' : '';
        $title_margin_bottom_xs = (isset($settings->title_margin_bottom_xs) && $settings->title_margin_bottom_xs) ? 'margin-bottom:' . $settings->title_margin_bottom_xs . 'px;' : '';

        if($title_font_size_xs || $title_line_height_xs || $title_margin_top_xs || $title_margin_bottom_xs){
            $css .= '@media (max-width: 767px) {';

            if($title_font_size_xs || $title_line_height_xs || $title_margin_top_xs || $title_margin_bottom_xs){
                $css .= $addon_id . ' .sppb-addon-pie-chart figcaption {';
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
