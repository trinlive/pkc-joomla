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
class SppagebuilderAddonUKIcon extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;

		// Options.
        if (isset($settings->icon_size->md)) $settings->icon_size = $settings->icon_size->md;
        $icon_size      = (isset($settings->icon_size) && $settings->icon_size) ? $settings->icon_size : 60;
        $icon_gutter    = (isset($settings->icon_gutter) && $settings->icon_gutter) ? ' uk-grid-'.$settings->icon_gutter : '';
        $icon_button    = (isset($settings->icon_button)) ? $settings->icon_button : 0;
        $icon_button    = $icon_button ? ' uk-icon-button' : '';
        $icon_divider   = (isset($settings->icon_divider)) ? $settings->icon_divider : 0;
        $icon_divider   = $icon_divider ? ' uk-grid-divider' : '';

		$icon_animation = ( isset( $settings->icon_animation ) && $settings->icon_animation ) ? ' uk-animation-' . $settings->icon_animation . '' : '';

		$general    =   PageBuilder::general_styles($settings);

		$output = '';

		$output .= '<div class="ukicon' . $general['container'] . '"' . $general['animation'] . '>';
		$output .= '<div class="ukicon-items'.$icon_gutter.$icon_divider.$general['class'].'" data-uk-grid>';

		if ( isset( $settings->ukicon_items ) && count( (array) $settings->ukicon_items ) ) {
			foreach ( $settings->ukicon_items as $key => $item ) {
				$title      = ( isset( $item->title ) && $item->title ) ? $item->title : '';
                $icon_type  = ( isset( $item->icon_type ) && $item->icon_type ) ? $item->icon_type : 'uikit';
                $uikit_icon = ( isset( $item->uikit_icon ) && $item->uikit_icon ) ? $item->uikit_icon : '';
                $fa_icon    = ( isset( $item->fontawesome_icon ) && $item->fontawesome_icon ) ? $item->fontawesome_icon : '';
                $link       = ( isset( $item->link ) && $item->link ) ? $item->link : '';
                $media_content  =   '';

                if ($icon_type == 'uikit') {
                    if ($uikit_icon) {
                        $media_content  .=  '<span class="'.$icon_button.'" data-uk-icon="icon: '.$uikit_icon.'; width: '.$icon_size.'"></span>';
                    }
                } elseif ($fa_icon) {
                    $media_content  .= '<span class="sppb-icon-inner'.$icon_button.'">';
                    $icon_arr = array_filter(explode(' ', $fa_icon));
                    if (count($icon_arr) === 1) {
                        $fa_icon = 'fa ' . $fa_icon;
                    }
                    $media_content  .= '<i class="' . $fa_icon . '" aria-hidden="true"></i>';
                    $media_content  .= '</span>';
                }
                $output     .=  '<div'.($icon_animation ? ' class="uk-animation-toggle"' : '').'>';
                if ($link) {
                    $output .=  '<a class="ukicon-item uk-flex uk-flex-middle'.$icon_animation.'" href="'.$link.'" title="'.$title.'">';
                }
                $output     .=  $media_content;
                if ($link) {
                    $output .=  '</a>';
                }
                $output     .=  '</div>';
			}
		}

		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
	public function css() {
		$settings           = $this->addon->settings;
		$addon_id           = '#sppb-addon-' . $this->addon->id;

		$background_color   = ( isset( $settings->background_color ) && $settings->background_color ) ? 'background-color: ' . $settings->background_color . ';' : '';
		$color              = ( isset( $settings->color ) && $settings->color ) ? 'color: ' . $settings->color . ';' : '';

		$background_color_hover     = ( isset( $settings->background_color_hover ) && $settings->background_color_hover ) ? 'background-color: ' . $settings->background_color_hover . ';' : '';
		$color_hover                = ( isset( $settings->color_hover ) && $settings->color_hover ) ? 'color: ' . $settings->color_hover . ';' : '';

        if (isset($settings->icon_size->md)) $settings->icon_size = $settings->icon_size->md;
        $icon_background_size       = (isset($settings->icon_background_size) && $settings->icon_background_size) ? $settings->icon_background_size : 36;

		$css = '';
        if ( $icon_background_size ) {
            $css .= $addon_id . ' .ukicon-item > .uk-icon-button {width:' . $icon_background_size . 'px;height:'.$icon_background_size.'px;}';
        }
        if ( $background_color || $color ) {
            $css .= $addon_id . ' .ukicon-item > .uk-icon {' . $background_color . $color . '}';
        }
        if ( $background_color_hover || $color_hover ) {
            $css .= $addon_id . ' .ukicon-item > .uk-icon:hover, ' . $addon_id . ' .ukicon-item > .uk-icon:focus, ' . $addon_id . ' .ukicon-item > .uk-icon:active, ' . $addon_id . ' .ukicon-item > .uk-icon.uk-active {' . $background_color_hover . $color_hover . '}';
        }

		return $css;
	}
}
