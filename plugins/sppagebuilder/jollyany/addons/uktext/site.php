<?php
/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2022 Jollyany
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
/**
 * @package Extra Addons SP Page Builder
 * @author WarpTheme https://warptheme.com
 * @copyright Copyright (c) 2015 - 2018 WarpTheme
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
// No direct access.
defined( '_JEXEC' ) or die( 'restricted aceess' );
use Jollyany\Helper\PageBuilder;
class SppagebuilderAddonUKtext extends SppagebuilderAddons {

	public function render() {
		$settings                 = $this->addon->settings;
		$content                  = ( isset( $settings->text ) && $settings->text ) ? $settings->text : '';
		$title_addon              = ( isset( $settings->title_addon ) && $settings->title_addon ) ? $settings->title_addon : '';
		$title_style              = ( isset( $settings->title_heading_style ) && $settings->title_heading_style ) ? ' uk-' . $settings->title_heading_style : '';
		$title_style             .= ( isset( $settings->title_heading_margin ) && $settings->title_heading_margin ) ? ' ' . $settings->title_heading_margin : '';
		$title_transform          = ( isset( $settings->title_transform ) && $settings->title_transform ) ? ' uk-text-' . $settings->title_transform : '';
		$title_heading_decoration = ( isset( $settings->title_heading_decoration ) && $settings->title_heading_decoration ) ? ' ' . $settings->title_heading_decoration : '';
		$title_heading_selector   = ( isset( $settings->title_heading_selector ) && $settings->title_heading_selector ) ? $settings->title_heading_selector : 'h3';

		$content_cls  = '';
		$dropcap      = ( isset( $settings->dropcap ) && $settings->dropcap ) ? 1 : 0;
		$columns      = ( isset( $settings->columns ) && $settings->columns ) ? $settings->columns : '';
		$text_style   = ( isset( $settings->text_style ) && $settings->text_style ) ? $settings->text_style : '';
		$text_size    = ( isset( $settings->text_size ) && $settings->text_size ) ? $settings->text_size : '';
		$columns_bp   = ( isset( $settings->columns_breakpoint ) && $settings->columns_breakpoint ) ? $settings->columns_breakpoint : '';
        $class        = ( isset( $settings->content_style ) && $settings->content_style ) ? ' uk-' . $settings->content_style : '';
		$content_cls .= ( $dropcap ) ? ' uk-dropcap' : '';
		$content_cls .= ( $columns ) ? ' uk-column-' . $columns : '';
		$content_cls .= ( $columns && $columns_bp ) ? '@' . $columns_bp : '';

		$divider      = ( isset( $settings->divider ) && $settings->divider ) ? $settings->divider : false;
		$content_cls .= ( $columns && $divider ) ? ' uk-column-divider' : '';
		$content_cls .= ( $text_style ) ? ' uk-text-' . $text_style : '';
		$content_cls .= ( empty( $text_style ) && $text_size ) ? ' uk-text-' . $text_size : '';
        $general    =   PageBuilder::general_styles($settings);
		$output = '<div class="uktext'.$general['container'].$general['class'].$class.'"'.$general['animation'].'>';

		if ( $title_addon ) {
			$output .= '<' . $title_heading_selector . ' class="uk-title' . $title_style . $title_heading_decoration . $title_transform . '">';
			$output .= ( $title_heading_decoration == ' uk-heading-line' ) ? '<span>' : '';
			$output .= nl2br( $title_addon );
			$output .= ( $title_heading_decoration == ' uk-heading-line' ) ? '</span>' : '';
			$output .= '</' . $title_heading_selector . '>';
		}

		$output .= '<div class="ukcontent' . $content_cls . '">';
		$output .= $content;
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
	public function css() {
		$settings      = $this->addon->settings;
		$css           = '';
		$dropcap       = ( isset( $settings->dropcap ) && $settings->dropcap ) ? 1 : 0;
		$dropcap_color = ( isset( $settings->dropcap_color ) && $settings->dropcap_color ) ? 'color: ' . $settings->dropcap_color . ';' : '';

		$text_color         = ( isset( $settings->text_color ) && $settings->text_color ) ? 'color: ' . $settings->text_color . ';' : '';
		$title_text_color   = ( isset( $settings->title_text_color ) && $settings->title_text_color ) ? 'color: ' . $settings->title_text_color . ';' : '';
		$text_style         = ( isset( $settings->text_style ) && $settings->text_style ) ? $settings->text_style : '';

		if ( $dropcap && $dropcap_color ) {
			$css .= '#sppb-addon-' . $this->addon->id . ' .uk-dropcap:first-letter{ ' . $dropcap_color . ' }';
		}

        if ( $title_text_color ) {
            $css .= '#sppb-addon-' . $this->addon->id . ' .uktext .uk-title{ ' . $title_text_color . ' }';
        }

		if ( $text_color ) {
			$css .= '#sppb-addon-' . $this->addon->id . ' .uktext .ukcontent{ ' . $text_color . ' }';
		}

        if ($text_style == 'custom') {
            $style = '';
            $style .= (isset($settings->text_text_color) && $settings->text_text_color) ? 'color:'.$settings->text_text_color . ';' : '';
            if (isset($settings->text_fontsize->md)) $settings->text_fontsize = $settings->text_fontsize->md;
            $style .= (isset($settings->text_fontsize) && $settings->text_fontsize) ? 'font-size:'.$settings->text_fontsize . 'px;' : '';
            if (isset($settings->text_lineheight->md)) $settings->text_lineheight = $settings->text_lineheight->md;
            $style .= (isset($settings->text_lineheight) && $settings->text_lineheight) ? 'line-height:'.$settings->text_lineheight . 'px;' : '';
            $style .= (isset($settings->text_letterspace) && $settings->text_letterspace) ? 'letter-spacing:'.$settings->text_letterspace . ';' : '';

            $text_font_style = (isset($settings->text_font_style) && $settings->text_font_style) ? $settings->text_font_style : '';
            if(isset($text_font_style->underline) && $text_font_style->underline){
                $style .= 'text-decoration:underline;';
            }
            if(isset($text_font_style->italic) && $text_font_style->italic){
                $style .= 'font-style:italic;';
            }
            if(isset($text_font_style->uppercase) && $text_font_style->uppercase){
                $style .= 'text-transform:uppercase;';
            }
            if(isset($text_font_style->weight) && $text_font_style->weight){
                $style .= 'font-weight:'.$text_font_style->weight.';';
            }
            if($style){
                $css .= '#sppb-addon-' . $this->addon->id . ' .uktext .ukcontent {';
                $css .= $style;
                $css .= '}';
            }

            $style_sm = (isset($settings->text_fontsize_sm) && $settings->text_fontsize_sm) ? "font-size: " . $settings->text_fontsize_sm . "px;" : "";
            $style_xs = (isset($settings->text_fontsize_xs) && $settings->text_fontsize_xs) ? "font-size: " . $settings->text_fontsize_xs . "px;" : "";

            $style_sm .= (isset($settings->text_lineheight_sm) && $settings->text_lineheight_sm) ? "line-height: " . $settings->text_lineheight_sm . "px;" : "";
            $style_xs .= (isset($settings->text_lineheight_xs) && $settings->text_lineheight_xs) ? "line-height: " . $settings->text_lineheight_xs . "px;" : "";

            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if($style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .uktext .ukcontent {';
                $css .= $style_sm;
                $css .= '}';
            }
            $css .='}';

            $css .= '@media (max-width: 767px) {';
            if($style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .uktext .ukcontent { ' . $style_xs . ' }';
            }
            $css .= '}';
        }

		return $css;
	}
}
