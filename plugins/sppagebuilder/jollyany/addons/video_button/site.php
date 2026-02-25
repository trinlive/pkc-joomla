<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2019 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

use Jollyany\Helper\PageBuilder;
class SppagebuilderAddonVideo_Button extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$alignment = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$align_breakpoint = (isset($settings->align_breakpoint) && $settings->align_breakpoint) ? $settings->align_breakpoint : '';
		$alignment_fallback = (isset($settings->alignment_fallback) && $settings->alignment_fallback) ? $settings->alignment_fallback : '';
        $alignment  .=      $align_breakpoint ? '@'.$align_breakpoint : '';
        $alignment  .=      $alignment_fallback ? ' uk-text-'.$alignment_fallback : '';
		$video_url        =     (isset($settings->video_url) && $settings->video_url) ? $settings->video_url : '';
		$heading_selector =     (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';
        $ripple_effect 	  =     (isset($settings->ripple_effect) && $settings->ripple_effect) ? $settings->ripple_effect : 0;
        $ripple_effect    =     $ripple_effect ? ' video-button-ripple' : '';
        $general          =     PageBuilder::general_styles($settings);

		$output  = '<div class="sppb-addon sppb-addon-video-button ' . $alignment . ' '.$general['container'].' '.$general['class'].'"' . $general['animation'] . '>';

		if($title) {
			$output .= '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>';
		}

		$output .= '<div class="sppb-addon-content" data-uk-lightbox><a class="video-button uk-inline uk-border-pill uk-height-small uk-width-small'.$ripple_effect.'" href="'.$video_url.'"><span class="uk-flex-inline uk-flex-middle uk-flex-center"><i class="fas fa-play"></i></span></a></div>';
		$output  .= '</div>';

		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;

		$video_fontsize = (isset($this->addon->settings->video_fontsize) && $this->addon->settings->video_fontsize) ? $this->addon->settings->video_fontsize : '';
		$border_color = (isset($this->addon->settings->border_color) && $this->addon->settings->use_border) ? $this->addon->settings->border_color : '';
		$border_width = (isset($this->addon->settings->border_width) && $this->addon->settings->border_width) ? $this->addon->settings->border_width : 1;
		$border_radius = (isset($this->addon->settings->border_radius) && $this->addon->settings->border_radius) ? $this->addon->settings->border_radius : 1;
		$width = (isset($this->addon->settings->width) && $this->addon->settings->width) ? $this->addon->settings->width : '';
		$height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : '';
		$background_color = (isset($this->addon->settings->background_color) && $this->addon->settings->background_color) ? $this->addon->settings->background_color : '';
		$color = (isset($this->addon->settings->color) && $this->addon->settings->color) ? $this->addon->settings->color : '';
        $background_color_hover = (isset($this->addon->settings->background_color_hover) && $this->addon->settings->background_color_hover) ? $this->addon->settings->background_color_hover : '';
        $color_hover = (isset($this->addon->settings->color_hover) && $this->addon->settings->color_hover) ? $this->addon->settings->color_hover : '';
		$use_border = (isset($this->addon->settings->use_border) && $this->addon->settings->use_border) ? $this->addon->settings->use_border : 0;
		$ripple_color = (isset($this->addon->settings->ripple_color) && $this->addon->settings->ripple_color) ? $this->addon->settings->ripple_color : 0;

		$css = '';
		if($video_fontsize){
			$css .= $addon_id .' .video-button {';
			$css .= 'font-size:'.$video_fontsize.'px;';
			$css .= 'display: inline-flex;';
			$css .= '}';
			$css .= $addon_id .' .video-button i {';
			$css .= 'width:'.$video_fontsize.'px;';
			$css .= 'height:'.$video_fontsize.'px;';
			$css .= '}';
		}
        if ($ripple_color) {
            $css .= $addon_id .' .video-button-ripple:before, '.$addon_id.' .video-button-ripple:after {';
            $css .= 'box-shadow: 0 0 0 0 '.$ripple_color.';';
            $css .= '}';
        }
		if ($color) {
            $css .= $addon_id .' .video-button {';
            $css .= 'color:'.$color.';';
            $css .= 'transition: all 0.3s linear 0s;';
            $css .= '-moz-transition: all 0.3s linear 0s;';
            $css .= '-webkit-transition: all 0.3s linear 0s;';
            $css .= '-o-transition: all 0.3s linear 0s;';
            $css .= '}';
        }
        if ($background_color) {
            $css .= $addon_id .' .video-button {';
            $css .= 'background-color:'.$background_color.';';
            $css .= '}';
        }
        if ($background_color_hover || $color_hover) {
            $css .= $addon_id .' .video-button:hover {';
            $css .= $background_color_hover ? 'background-color:'.$background_color_hover.';' : '';
            $css .= $color_hover ? 'color:'.$color_hover.';' : '';
            $css .= '}';
        }
        if ($width) {
            $css .= $addon_id .' .video-button, '.$addon_id.' .video-button:before, '.$addon_id.' .video-button:after {';
            $css .= 'width:'.$width.'px;';
            $css .= '}';
        }
        if ($height) {
            $css .= $addon_id .' .video-button, '.$addon_id.' .video-button:before, '.$addon_id.' .video-button:after {';
            $css .= 'height:'.$height.'px;';
            $css .= '}';
        }
		if ($use_border) {
			$css .= $addon_id .' .video-button {';
			$css .= 'border-style: solid;';
			if ($border_color) {
				$css .= 'border-color: '.$border_color.';';
			}
			if ($border_width) {
				$css .= 'border-width: '.$border_width.'px;';
			}
			if ($border_radius) {
				$css .= 'border-radius: '.$border_radius.'px;';
			}
			$css .= '}';
            $css .= $addon_id .' .video-button::before {';
            if ($border_radius) {
                $css .= 'border-radius: '.$border_radius.'px;';
            }
            $css .= '}';
		}
		return $css;
	}
}
