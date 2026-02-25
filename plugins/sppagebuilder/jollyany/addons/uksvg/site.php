<?php
/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2021 Jollyany
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
/**
 * @package Extra Addons SP Page Builder
 * @author WarpTheme https://warptheme.com
 * @copyright Copyright (c) 2015 - 2018 WarpTheme
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
// No direct access.
defined( '_JEXEC' ) or die( 'Restricted access' );
use Jollyany\Helper\PageBuilder;
class SppagebuilderAddonUkSvg extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;

		$use_link    = ( isset( $settings->use_link ) && $settings->use_link ) ? $settings->use_link : false;
		$title_link  = ( $use_link ) ? ( ( isset( $settings->title_link ) && $settings->title_link ) ? $settings->title_link : '' ) : false;
		$link_target = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? 'target="_blank"' : '';

		// Options.
		$image     = ( isset( $settings->image ) && $settings->image ) ? $settings->image : '';
		$image_src = isset( $image->src ) ? $image->src : $image;
		if ( strpos( $image_src, 'http://' ) !== false || strpos( $image_src, 'https://' ) !== false ) {
			$image_src = $image_src;
		} elseif ( $image_src ) {
			$image_src = JURI::base( true ) . '/' . $image_src;
		}

		$alt_text = ( isset( $settings->alt_text ) && $settings->alt_text ) ? $settings->alt_text : '';
		$width    = ( isset( $settings->width ) && $settings->width ) ? $settings->width : '';
		$height   = ( isset( $settings->height ) && $settings->height ) ? $settings->height : '';

		$preserve = ( isset( $settings->preserve ) && $settings->preserve ) ? $settings->preserve : 0;
        $general    =   PageBuilder::general_styles($settings);
		$output = '';

		if ( $image_src ) {
			$output .= '<div class="uksvg' . $general['container']. $general['class'] . '"' . $general['animation'] . '>';
			$output .= '<div class="uksvg-content">';
			$output .= ( $title_link ) ? '<a class="uk-link" href="' . $title_link . '" ' . $link_target . '>' : '';

			if ( $preserve ) {
				$output .= '<img class="uk-preserve" src="' . $image_src . '" alt="' . $alt_text . '" width="' . $width . '" height="' . $height . '" uk-svg>';
			} else {
				$output .= '<img class="svg-img" src="' . $image_src . '" alt="' . $alt_text . '" width="' . $width . '" height="' . $height . '" uk-svg>';
			}

			$output .= '';

			$output .= ( $title_link ) ? '</a>' : '';

			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}

	public function css() {
		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$preserve = ( isset( $settings->preserve ) && $settings->preserve ) ? $settings->preserve : 0;
		$style    = ( isset( $settings->color ) && $settings->color ) ? 'fill: ' . $settings->color . ';' : '';

		$css = '';
		if ( $preserve ) {
			$css .= $addon_id . ' .uk-svg{' . $style . '}';
		}
		return $css;
	}
}
