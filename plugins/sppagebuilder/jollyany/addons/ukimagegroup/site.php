<?php
/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2022 Jollyany
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
// No direct access.
defined( '_JEXEC' ) or die( 'restricted aceess' );
use Jollyany\Helper\PageBuilder;
class SppagebuilderAddonUKImageGroup extends SppagebuilderAddons {

	public function render() {
		$settings                 = $this->addon->settings;
		$grid_column_gap = ( isset( $settings->grid_column_gap ) && $settings->grid_column_gap ) ? $settings->grid_column_gap : '';
		$grid_row_gap    = ( isset( $settings->grid_row_gap ) && $settings->grid_row_gap ) ? $settings->grid_row_gap : '';
		$use_slider      = ( isset( $settings->use_slider ) ) ? $settings->use_slider : 0;
		$enable_divider  = ( isset( $settings->enable_divider ) ) ? $settings->enable_divider : 0;

		$grid_cr = '';
		if ( $grid_column_gap == $grid_row_gap ) {
			$grid_cr .= ( ! empty( $grid_column_gap ) && ! empty( $grid_row_gap ) ) ? ' uk-grid-' . $grid_column_gap : '';
		} else {
			$grid_cr .= ! empty( $grid_column_gap ) ? ' uk-grid-column-' . $grid_column_gap : '';
			$grid_cr .= ! empty( $grid_row_gap ) ? ' uk-grid-row-' . $grid_row_gap : '';
		}

        $grid_cr    .=   (isset($settings->column_xl) && $settings->column_xl) ? ' uk-child-width-1-'.$settings->column_xl.'@xl' : ' uk-child-width-auto@xl';
        $grid_cr    .=  (isset($settings->column_l) && $settings->column_l) ? ' uk-child-width-1-'.$settings->column_l.'@l' : ' uk-child-width-auto@l';
        $grid_cr    .=  (isset($settings->column_m) && $settings->column_m) ? ' uk-child-width-1-'.$settings->column_m.'@m' : ' uk-child-width-auto@m';
        $grid_cr    .=  (isset($settings->column_s) && $settings->column_s) ? ' uk-child-width-1-'.$settings->column_s.'@s' : ' uk-child-width-auto@s';
        $grid_cr    .=  (isset($settings->column_xs) && $settings->column_xs) ? ' uk-child-width-1-'.$settings->column_xs : ' uk-child-width-auto';

		$uk_list_images = ( isset( $settings->uk_list_images ) && $settings->uk_list_images ) ? $settings->uk_list_images : array();
        $enable_navigation      = (isset($settings->enable_navigation)) ? $settings->enable_navigation : 1;
        $infinite_scrolling     = (isset($settings->infinite_scrolling)) ? $settings->infinite_scrolling : 1;
        $enable_slider_autoplay = (isset($settings->enable_slider_autoplay)) ? $settings->enable_slider_autoplay : 1;
        $slider_autoplay_interval = (isset($settings->slider_autoplay_interval) && $settings->slider_autoplay_interval) ? $settings->slider_autoplay_interval : '7000';
        $navigation_position    = (isset($settings->navigation_position)) ? $settings->navigation_position : '';
        $enable_dotnav          = (isset($settings->enable_dotnav)) ? $settings->enable_dotnav : 1;
        $dotnav_margin          = (isset($settings->dotnav_margin) && $settings->dotnav_margin) ? ' '.$settings->dotnav_margin : ' uk-margin-top';

		$output = '';

        $general    =   PageBuilder::general_styles($settings);

        $output .= '<div class="ukimagegroup'  . $general['container'] . '"' . $general['animation'] . '>';
        if ($use_slider) {
            $output .= '<div data-uk-slider="'.($enable_slider_autoplay ? 'autoplay: true;autoplay-interval: '.$slider_autoplay_interval.';' : '').($infinite_scrolling ? 'finite: false;' : '').'">';
            $output .= '<div class="uk-position-relative">';
            $output .= '<div class="uk-slider-container">';
        }
		if ( is_array( $uk_list_images ) && count( $uk_list_images ) > 1 ) {
			$output .= '<div class="uk-flex-middle' . $grid_cr . ($enable_divider ? ' uk-grid-divider' : '') . ($use_slider ? ' uk-slider-items': '') . $general['class'] . '" data-uk-grid>';
		}

		if ( is_array( $uk_list_images ) && count( $uk_list_images ) > 1 ) {
			foreach ( $uk_list_images as $key => $item ) {
				$target        = ( isset( $item->target ) && $item->target ) ? ' target="' . $item->target . '"' : '';
				$link          = ( isset( $item->link ) && $item->link ) ? $item->link : '';
				$link_title    = ( isset( $item->link_title ) && $item->link_title ) ? ' title="' . $item->link_title . '"' : '';
				$title         = ( isset( $item->title ) && $item->title ) ? $item->title : '';

                $image                  = ( isset( $item->image ) && $item->image ) ? $item->image : '';
                $image_src              = isset( $image->src ) ? $image->src : $image;
                $image_webp_enable      = ( isset( $item->image_webp_enable )) ? $item->image_webp_enable : 0;
                $image_webp             = ( isset( $item->image_webp ) && $item->image_webp ) ? $item->image_webp : '';
                $image_webp_src         = isset( $image_webp->src ) ? $image_webp->src : $image_webp;

                $image_properties   =   false;
                if ( strpos( $image_src, 'http://' ) !== false || strpos( $image_src, 'https://' ) !== false ) {
                    $image_properties   =   getimagesize($image_src);
                } elseif ( $image_src ) {
                    if (file_exists(JPATH_BASE . '/' . $image_src)) $image_properties   =   getimagesize(JPATH_BASE . '/' . $image_src);
                    $image_src = JURI::base( true ) . '/' . $image_src;
                }
                $data_image_src     =   $image_src;

                if ($image_webp_enable && $image_webp_src) {
                    if ( $image_webp_src && (!strpos( $image_webp_src, 'http://' ) !== false && !strpos( $image_webp_src, 'https://' ) !== false )) {
                        $image_webp_src = JURI::base( true ) . '/' . $image_webp_src;
                    }
                    $data_image_src     =   $image_webp_src;
                }

                if ($image_properties && is_array($image_properties) && count($image_properties) > 2) {
                    $data_image_src = 'data-src="' . $data_image_src . '" data-origin="'.$image_src.'" data-type="'.$image_properties['mime'].'" data-width="' . $image_properties[0] . '" data-height="' . $image_properties[1] . '" uk-img';
                } else {
                    $data_image_src = 'src="' . $data_image_src . '"';
                }
                $alt_text = ( isset( $item->alt_text ) && $item->alt_text ) ? $item->alt_text : $title;

				if ( $data_image_src ) {
                    $output .= '<div class="uk-item-' . $key . '">';
                    $output .= '<div>';
                    if ($link) {
                        $output .=  '<a href="' . $link . '"' . $link_title . $target . '>';
                    }
                    $output .= '<picture>';
                    $output .= '<img class="el-image" ' . $data_image_src . ' alt="' . str_replace( '"', '', $alt_text ) . '">';
                    $output .= '</picture>';
                    if ($link) {
                        $output .=  '</a>';
                    }
                    $output .= '</div>';
                    $output .= '</div>';
				}
			}
		}
        if ( is_array( $uk_list_images ) && count( $uk_list_images ) > 1 ) {
			$output .= '</div>';
		}
        if ($use_slider) {
            // End Slider Container
            $output  .= '</div>';
            if ($enable_navigation) {
                // Nav
                $output .= '<div class="'.($navigation_position == 'inside' ? '' : 'uk-hidden@l ').'uk-light"><a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a><a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a></div>';
                $output .= $navigation_position == 'inside' ? '' : '<div class="uk-visible@l"><a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a><a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a></div>';
            }
            $output  .= '</div>';
            if ($enable_dotnav) {
                // Dot nav
                $output .= '<ul class="uk-slider-nav uk-dotnav uk-flex-center'.$dotnav_margin.'"></ul>';
            }
            // End Slider
            $output  .= '</div>';
        }
		$output .= '</div>';

		return $output;
	}
}
