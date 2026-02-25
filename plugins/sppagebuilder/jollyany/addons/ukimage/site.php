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
class SppagebuilderAddonUKImage extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;

		// Options.
		$image     = ( isset( $settings->image ) && $settings->image ) ? $settings->image : '';
		$image_src = isset( $image->src ) ? $image->src : $image;
        $image_webp_enable      = ( isset( $settings->image_webp_enable )) ? $settings->image_webp_enable : 0;
        $image_webp             = ( isset( $settings->image_webp ) && $settings->image_webp ) ? $settings->image_webp : '';
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
		$alt_text = ( isset( $settings->alt_text ) && $settings->alt_text ) ? $settings->alt_text : '';

		$link_type = ( isset( $settings->link_type ) && $settings->link_type ) ? $settings->link_type : '';

		$link_type_cls = $link_type == 'use_modal' ? ' uk-lightbox="toggle: a[data-type]"' : '';

		$title_link  = ( isset( $settings->title_link ) && $settings->title_link ) ? $settings->title_link : '';
		$link_target = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? 'target="_blank"' : '';

		$image_styles  = ( isset( $settings->image_border ) && $settings->image_border ) ? ' ' . $settings->image_border : '';
		$image_styles .= ( isset( $settings->box_shadow ) && $settings->box_shadow ) ? ' ' . $settings->box_shadow : '';
		$image_styles .= ( isset( $settings->hover_box_shadow ) && $settings->hover_box_shadow ) ? ' ' . $settings->hover_box_shadow : '';

        $image_panel      = ( isset( $settings->image_panel ) && $settings->image_panel ) ? 1 : 0;
        $media_background = ( $image_panel ) ? ( ( isset( $settings->blend_bg_color ) && $settings->blend_bg_color ) ? ' style="background-color: ' . $settings->blend_bg_color . ';"' : '' ) : '';
        $media_blend_mode = ( $image_panel && $media_background ) ? ( ( isset( $settings->image_blend_modes ) && $settings->image_blend_modes ) ? ' ' . $settings->image_blend_modes : '' ) : false;
        $media_overlay    = ( $image_panel ) ? ( ( isset( $settings->media_overlay ) && $settings->media_overlay ) ? '<div class="uk-position-cover" style="background-color: ' . $settings->media_overlay . '"></div>' : '' ) : '';

        $image_transition = ( isset( $settings->image_transition ) && $settings->image_transition ) ? ' uk-transition-' . $settings->image_transition . ' uk-transition-opaque' : '';
        $hover_effect     = ( isset( $settings->hover_effect ) && $settings->hover_effect ) ? ' uk-effect-' . $settings->hover_effect : '';

		$image_svg_inline     = ( isset( $settings->image_svg_inline ) && $settings->image_svg_inline ) ? $settings->image_svg_inline : false;
		$image_svg_inline_cls = ( $image_svg_inline ) ? ' uk-svg' : '';
		$image_svg_color      = ( $image_svg_inline ) ? ( ( isset( $settings->image_svg_color ) && $settings->image_svg_color ) ? ' uk-text-' . $settings->image_svg_color : '' ) : false;

		$lightbox_init = ( ! empty( $title_link ) ) ? ' data-type="iframe"' : ' data-type="image"';

		if ( $link_type == 'use_modal' && empty( $title_link ) ) {
			$title_link .= $image_src;
		}

        $general    =   PageBuilder::general_styles($settings);

		$output = '';
		if ( $image_src ) {

			$output .= '<div class="ukimage' . $general['container'] . $general['class'] . '"' . $general['animation'] . $link_type_cls . '>';

			$output .= ( $link_type == 'use_modal' && $title_link ) ? '<a href="' . $title_link . '" ' . $lightbox_init . ' data-caption="<h4 class=\'uk-margin-remove\'>' . str_replace( '"', '', $alt_text ) . '</h4>">' : '';

			$output .= ( $link_type == 'use_link' && $title_link ) ? '<a ' . $link_target . ' href="' . $title_link . '">' : '';

			$output .= ( $image_transition ) ? '<div class="uk-inline uk-transition-toggle'.$hover_effect.'" tabindex="0"' . $media_background . '>' : '<div class="uk-inline'.$hover_effect.'"' . $media_background . '>';
            $output .= '<picture>';
			$output .= '<img class="el-image' . $image_svg_color . $image_transition  . $image_styles . $media_blend_mode . '" ' . $data_image_src . ' alt="' . str_replace( '"', '', $alt_text ) . '"' . $image_svg_inline_cls . '>';
			$output .= '</picture>';
			$output .= $media_overlay;
			$output .= ( $image_transition ) ? '</div>' : '</div>';

			$output .= ( $link_type == 'use_link' && $title_link ) ? '</a>' : '';

			$output .= ( $link_type == 'use_modal' && $title_link ) ? '</a>' : '';
			$output .= '</div>';
		}

		return $output;
	}
}
