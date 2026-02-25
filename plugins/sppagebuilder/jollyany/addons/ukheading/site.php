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
class SppagebuilderAddonUKHeading extends SppagebuilderAddons {

	public function render() {
		$settings     = $this->addon->settings;
		$class        = ( isset( $settings->class ) && $settings->class ) ? ' ' . $settings->class : '';

		$title            = ( isset( $settings->title ) && $settings->title ) ? $settings->title : '';
		$highlight_title  = ( isset( $settings->highlight_title ) && $settings->highlight_title ) ? $settings->highlight_title : '';
		$title_after_highlight  = ( isset( $settings->title_after_highlight ) && $settings->title_after_highlight ) ? $settings->title_after_highlight : '';
        $use_highlight    = ( isset( $settings->use_highlight ) && $settings->use_highlight ) ? $settings->use_highlight : false;
        $highlight_style  = ( isset( $settings->highlight_style ) && $settings->highlight_style ) ? $settings->highlight_style : 'underline';
		$heading_selector = ( isset( $settings->heading_selector ) && $settings->heading_selector ) ? $settings->heading_selector : 'h3';
		$heading_style    = ( isset( $settings->heading_style ) && $settings->heading_style ) ? ' uk-' . $settings->heading_style : '';

		$heading_decoration = ( isset( $settings->decoration ) && $settings->decoration ) ? ' ' . $settings->decoration : '';

		$heading_style .= ( isset( $settings->text_transform ) && $settings->text_transform ) ? ' uk-text-' . $settings->text_transform : '';
		$heading_style .= ( isset( $settings->heading_color ) && $settings->heading_color ) ? ' uk-' . $settings->heading_color : '';
        $text_background = (isset($settings->text_background)) ? $settings->text_background : 0;
		$use_link    = ( isset( $settings->use_link ) && $settings->use_link ) ? $settings->use_link : false;
		$title_link  = ( $use_link ) ? ( ( isset( $settings->title_link ) && $settings->title_link ) ? $settings->title_link : '' ) : false;
		$link_target = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? 'target="_blank"' : '';

		$font_weight = ( isset( $settings->heading_font_weight ) && $settings->heading_font_weight ) ? ' uk-text-' . $settings->heading_font_weight : '';

        // Text Background Image Options.
        $text_background_image = ( isset( $settings->text_background_image ) && $settings->text_background_image ) ? $settings->text_background_image : '';
        $text_background_src   = isset( $text_background_image->src ) ? $text_background_image->src : $text_background_image;
        if ( strpos( $text_background_src, 'http://' ) !== false || strpos( $text_background_src, 'https://' ) !== false ) {
            $text_background_src = $text_background_src;
        } elseif ( $text_background_src ) {
            $text_background_src = JURI::base( true ) . '/' . $text_background_src;
        }

        $text_background_image_effect  = ( isset( $settings->text_background_image_effect ) && $settings->text_background_image_effect ) ? $settings->text_background_image_effect : '';
        $text_background_image_styles  = ( isset( $settings->text_background_image_size ) && $settings->text_background_image_size ) ? ' ' . $settings->text_background_image_size : '';

        $text_background_horizontal_start = ( isset( $settings->text_background_horizontal_start ) && $settings->text_background_horizontal_start ) ? $settings->text_background_horizontal_start : '0';
        $text_background_horizontal_end   = ( isset( $settings->text_background_horizontal_end ) && $settings->text_background_horizontal_end ) ? $settings->text_background_horizontal_end : '0';
        $text_background_horizontal       = ( ! empty( $text_background_horizontal_start ) || ! empty( $text_background_horizontal_end ) ) ? 'bgx: ' . $text_background_horizontal_start . ',' . $text_background_horizontal_end . ';' : '';

        $text_background_vertical_start = ( isset( $settings->text_background_vertical_start ) && $settings->text_background_vertical_start ) ? $settings->text_background_vertical_start : '0';
        $text_background_vertical_end   = ( isset( $settings->text_background_vertical_end ) && $settings->text_background_vertical_end ) ? $settings->text_background_vertical_end : '0';
        $text_background_vertical       = ( ! empty( $text_background_vertical_start ) || ! empty( $text_background_vertical_end ) ) ? 'bgy: ' . $text_background_vertical_start . ',' . $text_background_vertical_end . ';' : '';

        $text_background_easing     = ( isset( $settings->text_background_easing ) && $settings->text_background_easing ) ? ( (int) $settings->text_background_easing / 100 ) : '';
        $text_background_easing_cls = ( ! empty( $text_background_easing ) ) ? 'easing:' . $text_background_easing . ';' : '';

        $parallax_background_init = ( $text_background_image_effect == 'parallax' ) ? ' uk-parallax="' . $text_background_horizontal . $text_background_vertical . $text_background_easing_cls . '"' : '';
        $parallax_background_cls  = ( $text_background_image_effect == 'fixed' ) ? ' uk-background-fixed' : '';

        $general     =   PageBuilder::general_styles($settings);
		$output      = '';

		if ( $title ) {
            $output .= '<div class="ukheading-container'.$general['container'].'"' . $general['animation'] . '>';
			$output .= '<' . $heading_selector . ' class="uk-title ukheading uk-margin-remove-vertical' . $heading_style . $general['class'] . $font_weight . $heading_decoration . '">';

            $output .= ( $title_link ) ? '<a class="uk-link-heading" href="' . $title_link . '" ' . $link_target . '>' : '';
			if ( $heading_decoration == ' uk-heading-line' || $text_background ) {
				$output .= '<span'.($text_background ? ' class="uk-text-background'.$parallax_background_cls . $text_background_image_styles.'" style="background-image: url('.$text_background_src.');"'. $parallax_background_init : '').'>';
				$output .= nl2br( $title );
				$output .= '</span>';
			} else {
                if ($use_highlight) {
                    $output .=  '<span class="heading-highlighted-wrapper">';
                }
                if ($title) {
                    if ($use_highlight) {
                        $output .=  '<span>';
                    }
                    $output .= nl2br( $title );
                    if ($use_highlight) {
                        $output .=  '</span>';
                    }
                }
                if ($highlight_title) {
                    if ($use_highlight) {
                        $output .=  '<span class="heading-highlighted-text heading-highlighted-text-active">';
                    }
                    $output .= nl2br( $highlight_title );
                    if ($use_highlight) {
                        switch ($highlight_style) {
                            case 'circle':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M325,18C228.7-8.3,118.5,8.3,78,21C22.4,38.4,4.6,54.6,5.6,77.6c1.4,32.4,52.2,54,142.6,63.7 c66.2,7.1,212.2,7.5,273.5-8.3c64.4-16.6,104.3-57.6,33.8-98.2C386.7-4.9,179.4-1.4,126.3,20.7"></path></svg>';
                                break;
                            case 'curly-line':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M3,146.1c17.1-8.8,33.5-17.8,51.4-17.8c15.6,0,17.1,18.1,30.2,18.1c22.9,0,36-18.6,53.9-18.6 c17.1,0,21.3,18.5,37.5,18.5c21.3,0,31.8-18.6,49-18.6c22.1,0,18.8,18.8,36.8,18.8c18.8,0,37.5-18.6,49-18.6c20.4,0,17.1,19,36.8,19 c22.9,0,36.8-20.6,54.7-18.6c17.7,1.4,7.1,19.5,33.5,18.8c17.1,0,47.2-6.5,61.1-15.6"></path></svg>';
                                break;
                            case 'double':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M8.4,143.1c14.2-8,97.6-8.8,200.6-9.2c122.3-0.4,287.5,7.2,287.5,7.2"></path><path d="M8,19.4c72.3-5.3,162-7.8,216-7.8c54,0,136.2,0,267,7.8"></path></svg>';
                                break;
                            case 'double-line':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M5,125.4c30.5-3.8,137.9-7.6,177.3-7.6c117.2,0,252.2,4.7,312.7,7.6"></path><path d="M26.9,143.8c55.1-6.1,126-6.3,162.2-6.1c46.5,0.2,203.9,3.2,268.9,6.4"></path></svg>';
                                break;
                            case 'zigzag':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path></svg>';
                                break;
                            case 'diagonal':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M13.5,15.5c131,13.7,289.3,55.5,475,125.5"></path></svg>';
                                break;
                            case 'underline':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7"></path></svg>';
                                break;
                            case 'delete':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M497.4,23.9C301.6,40,155.9,80.6,4,144.4"></path><path d="M14.1,27.6c204.5,20.3,393.8,74,467.3,111.7"></path></svg>';
                                break;
                            case 'strike':
                                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M3,75h493.5"></path></svg>';
                                break;
                        }
                        $output .=  '</span>';
                    }
                }
                if ($title_after_highlight) {
                    if ($use_highlight) {
                        $output .=  '<span>';
                    }
                    $output .= nl2br( $title_after_highlight );
                    if ($use_highlight) {
                        $output .=  '</span>';
                    }
                }
                if ($use_highlight) {
                    $output .=  '</span>';
                }
			}
			$output .= ( $title_link ) ? '</a>' : '';

			$output .= '</' . $heading_selector . '>';
            $output .= '</div>';
		}

		return $output;
	}

	public function css() {
		$settings          = $this->addon->settings;
		$decoration_color  = '';
		$decoration_color .= ( isset( $settings->decoration_color ) && $settings->decoration_color ) ? ' border-color: ' . $settings->decoration_color . ';' : '';
		$decoration_color .= ( isset( $settings->decoration_width ) && $settings->decoration_width ) ? ' border-width: ' . $settings->decoration_width . 'px;' : '';

		$heading_size  = ( isset( $settings->heading_style ) && $settings->heading_style ) ? $settings->heading_style : '';
		$heading_style = ( isset( $settings->heading_color ) && $settings->heading_color ) ? $settings->heading_color : '';
		$heading_color = ( isset( $settings->custom_heading_color ) && $settings->custom_heading_color ) ? 'color: ' . $settings->custom_heading_color . ';' : '';
		$heading_letterspace = ( isset( $settings->heading_letterspace ) && $settings->heading_letterspace ) ? 'letter-spacing: ' . $settings->heading_letterspace . ';' : '';
        $title_highlight_color = (isset($settings->title_highlight_color) && $settings->title_highlight_color) ? 'color:'.$settings->title_highlight_color . ';' : '';
		$css           = '';

		$addon_id = '#sppb-addon-' . $this->addon->id;

		if ( empty( $heading_style ) && $heading_color ) {
			$css .= $addon_id . ' .uk-title {' . $heading_color . '}';
		}

        if ($heading_letterspace) {
            $css .= $addon_id . ' .uk-title {' . $heading_letterspace . '}';
        }

		if ( $decoration_color ) {
			$css .= $addon_id . ' .uk-heading-bullet::before {' . $decoration_color . '}';
			$css .= $addon_id . ' .uk-heading-line>::after {' . $decoration_color . '}';
			$css .= $addon_id . ' .uk-heading-line>::before {' . $decoration_color . '}';
			$css .= $addon_id . ' .uk-heading-divider {' . $decoration_color . '}';
		}

        if ( $title_highlight_color ) {
            $css .= $addon_id . ' .heading-highlighted-text {' . $title_highlight_color . '}';
        }
        $svg =  ( isset( $settings->shapes_color ) && $settings->shapes_color ) ? ' stroke: ' . $settings->shapes_color . ';' : '';
        $svg .= ( isset( $settings->shapes_width ) && $settings->shapes_width ) ? ' stroke-width: ' . $settings->shapes_width . ';' : '';
        if ( $svg ) {
            $css .= $addon_id . ' .heading-highlighted-wrapper svg path {' . $svg . '}';
        }
        if ( $heading_size == 'custom' ) {
            if (isset($settings->heading_fontsize->md)) $settings->heading_fontsize = $settings->heading_fontsize->md;
            $heading_fontsize = (isset($settings->heading_fontsize) && $settings->heading_fontsize) ? 'font-size:'.$settings->heading_fontsize . 'px;' : '';
            if ($heading_fontsize ) {
                $css .= $addon_id . ' .uk-title {' . $heading_fontsize . '}';
            }

            $heading_fontsize_sm = (isset($settings->heading_fontsize_sm) && $settings->heading_fontsize_sm) ? 'font-size:'.$settings->heading_fontsize_sm . 'px;' : '';
            $heading_fontsize_xs = (isset($settings->heading_fontsize_xs) && $settings->heading_fontsize_xs) ? 'font-size:'.$settings->heading_fontsize_xs . 'px;' : '';

            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if($heading_fontsize_sm){
                $css .= $addon_id . ' .uk-title {' . $heading_fontsize_sm . '}';
            }
            $css .='}';

            $css .= '@media (max-width: 767px) {';
            if($heading_fontsize_xs){
                $css .= $addon_id . ' .uk-title {' . $heading_fontsize_xs . '}';
            }
            $css .= '}';
        }


		return $css;
	}
}
