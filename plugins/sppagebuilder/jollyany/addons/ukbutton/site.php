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
class SppagebuilderAddonUKButton extends SppagebuilderAddons {

	public function render() {
		$settings                 = $this->addon->settings;

		$btn_fullwidth   = ( isset( $settings->grid_width ) && $settings->grid_width ) ? 1 : '';
		$grid_column_gap = ( isset( $settings->grid_column_gap ) && $settings->grid_column_gap ) ? $settings->grid_column_gap : '';
		$grid_row_gap    = ( isset( $settings->grid_row_gap ) && $settings->grid_row_gap ) ? $settings->grid_row_gap : '';

		$grid_cr = '';
		if ( $grid_column_gap == $grid_row_gap ) {
			$grid_cr .= ( ! empty( $grid_column_gap ) && ! empty( $grid_row_gap ) ) ? ' uk-grid-' . $grid_column_gap : '';
		} else {
			$grid_cr .= ! empty( $grid_column_gap ) ? ' uk-grid-column-' . $grid_column_gap : '';
			$grid_cr .= ! empty( $grid_row_gap ) ? ' uk-grid-row-' . $grid_row_gap : '';
		}

		$grid_cr .= ( $btn_fullwidth ) ? ' uk-child-width-1-1' : ' uk-child-width-auto';

		$buttons = ( isset( $settings->ui_list_buttons ) && $settings->ui_list_buttons ) ? $settings->ui_list_buttons : array();

		$button_size = ( isset( $settings->button_size ) && $settings->button_size ) ? ' uk-button-' . $settings->button_size : '';
		$icon_size   = ( isset( $settings->faw_icon_size ) && $settings->faw_icon_size ) ? '; width: ' . $settings->faw_icon_size . '' : '';
		$font_weight = ( isset( $settings->font_weight ) && $settings->font_weight ) ? ' uk-text-' . $settings->font_weight : '';

		$output = '';

        $button_alignment          = ( isset( $settings->alignment ) && $settings->alignment ) ? ' uk-flex-' . $settings->alignment : '';
        $button_breakpoint         = ( $button_alignment ) ? ( ( isset( $settings->text_breakpoint ) && $settings->text_breakpoint ) ? '@' . $settings->text_breakpoint : '' ) : '';
        $button_alignment_fallback = ( $button_alignment && $button_breakpoint ) ? ( ( isset( $settings->text_alignment_fallback ) && $settings->text_alignment_fallback ) ? ' uk-flex-' . $settings->text_alignment_fallback : '' ) : '';
        $button_alignment         .= $button_breakpoint . $button_alignment_fallback;

        $general    =   PageBuilder::general_styles($settings);

        $output .= '<div class="ukbutton'  . $general['container'] . ( is_array( $buttons ) && count( $buttons ) == 1 ? $general['class'] : '' ) . '"' . $general['animation'] . '>';

		if ( is_array( $buttons ) && count( $buttons ) > 1 ) {
			$output .= '<div class="uk-flex-middle' . $grid_cr . $general['class'] . '" data-uk-grid>';
		}

		if ( isset( $settings->ui_list_buttons ) && count( (array) $settings->ui_list_buttons ) ) {
			foreach ( $settings->ui_list_buttons as $key => $button ) {
				$target        = ( isset( $button->target ) && $button->target ) ? ' target="' . $button->target . '"' : '';
				$icon_type     = ( isset( $button->icon_type ) && $button->icon_type ) ? $button->icon_type : '';
				$icon_position = ( isset( $button->icon_position ) && $button->icon_position ) ? $button->icon_position : 'left';
				$link          = ( isset( $button->link ) && $button->link ) ? $button->link : '';
				$link_title    = ( isset( $button->link_title ) && $button->link_title ) ? ' title="' . $button->link_title . '"' : '';
				$title         = ( isset( $button->title ) && $button->title ) ? $button->title : '';
				$button_style  = ( isset( $button->button_style ) && $button->button_style ) ? $button->button_style : '';
                $button_shape  = (isset($button->button_shape) && $button->button_shape) ? ' uk-button-' . $button->button_shape : ' uk-button-square';

				$icon        = ( empty( $icon_type ) ) ? ( ( isset( $button->btn_icon ) && $button->btn_icon ) ? $button->btn_icon : '' ) : false;
				$uk_icon     = ( $icon_type === 'uikit' ) ? ( ( isset( $button->uikit_icon ) && $button->uikit_icon ) ? $button->uikit_icon : '' ) : false;
				$custom_icon = ( $icon_type === 'custom' ) ? ( ( isset( $button->custom_icon ) && $button->custom_icon ) ? '<span class="uk-icon ' . $button->custom_icon . '"></span>' : '' ) : false;

				$icon_arr = array_filter( explode( ' ', $icon ) );
				if ( count( $icon_arr ) === 1 ) {
					$icon = 'fa ' . $icon;
				}

				if ( $icon ) {
					$icon_render = '<i class="' . $icon . '" aria-hidden="true"></i>';
				} elseif ( $uk_icon ) {
					$icon_render = '<span class="uk-icon me-2" data-uk-icon="icon: ' . $uk_icon . $icon_size . '"></span>';
				} else {
					$icon_render = $custom_icon;
				}

				$button_width     = ( isset( $settings->grid_width ) && $settings->grid_width ) ? ' uk-width-1-1' : '';
				$button_style_cls = '';
				if ( empty( $button_style ) ) {
					$button_style_cls .= 'uk-button uk-button-default' . $button_width . $button_size. $button_shape;
				} elseif ( $button_style == 'link' || $button_style == 'link-muted' || $button_style == 'link-text' ) {
					$button_style_cls .= 'uk-' . $button_style;
				} else {
					$button_style_cls .= 'uk-button uk-button-' . $button_style . $button_width . $button_size. $button_shape;
				}

				$check_target      = ( isset( $button->target ) && $button->target ) ? $button->target : '';
				$render_linkscroll = ( empty( $check_target ) && strpos( $link, '#' ) === 0 ) ? ' uk-scroll' : '';
				$icon_left         = '';
				$icon_right        = '';

				if ( $icon_position == 'left' ) {
					$icon_left = ( $icon || $uk_icon || $custom_icon ) ? $icon_render . ' ' : '';
				} else {
					$icon_right = ( $icon || $uk_icon || $custom_icon ) ? ' ' . $icon_render : '';
				}

				if ( $title ) {
					if ( is_array( $buttons ) && count( $buttons ) > 1 ) {
						$output .= '<div class="uk-item-' . $key . '"><a class="' . $button_style_cls . $font_weight . '" href="' . $link . '"' . $target . $render_linkscroll . $link_title . '>' . $icon_left . ( ( $icon_type === 'uikit' && $uk_icon ) ? '<span class="uk-text-middle">' . $title . '</span>' : $title ) . $icon_right . '</a></div>';
					} else {
						$output .= '<a class="' . $button_style_cls . $font_weight . '" href="' . $link . '"' . $target . $render_linkscroll . $link_title . '>' . $icon_left . ( ( $icon_type === 'uikit' && $uk_icon ) ? '<span class="uk-text-middle">' . $title . '</span>' : $title ) . $icon_right . '</a>';
					}
				}
			}
		}
		if ( is_array( $buttons ) && count( $buttons ) > 1 ) {
			$output .= '</div>';
		}

		$output .= '</div>';

		return $output;
	}

	public function css() {

		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;
		$buttons  = ( isset( $settings->ui_list_buttons ) && $settings->ui_list_buttons ) ? $settings->ui_list_buttons : array();
		$css      = '';

		// Buttons style.
		if ( isset( $settings->ui_list_buttons ) && count( (array) $settings->ui_list_buttons ) ) {
			foreach ( $settings->ui_list_buttons as $key => $button ) {
				$link_button_style = ( isset( $button->button_style ) && $button->button_style ) ? $button->button_style : '';
				$button_background = ( isset( $button->button_background ) && $button->button_background ) ? 'background-color: ' . $button->button_background . ';' : '';
				$button_color      = ( isset( $button->button_color ) && $button->button_color ) ? 'color: ' . $button->button_color . ';' : '';

				$button_background_hover = ( isset( $button->button_background_hover ) && $button->button_background_hover ) ? 'background-color: ' . $button->button_background_hover . ';' : '';
				$button_hover_color      = ( isset( $button->button_hover_color ) && $button->button_hover_color ) ? 'color: ' . $button->button_hover_color . ';' : '';

				if ( $link_button_style == 'custom' ) {
					if ( is_array( $buttons ) && count( $buttons ) > 1 ) {
						if ( $button_background || $button_color ) {
							$css .= $addon_id . ' .uk-item-' . $key . ' .uk-button-custom {' . $button_background . $button_color . '}';
						}
						if ( $button_background_hover || $button_hover_color ) {
							$css .= $addon_id . ' .uk-item-' . $key . ' .uk-button-custom:hover, ' . $addon_id . ' .uk-item-' . $key . ' .uk-button-custom:focus, ' . $addon_id . ' .uk-item-' . $key . ' .uk-button-custom:active {' . $button_background_hover . $button_hover_color . '}';
						}
					} else {
						if ( $button_background || $button_color ) {
							$css .= $addon_id . ' .uk-button-custom {' . $button_background . $button_color . '}';
						}
						if ( $button_background_hover || $button_hover_color ) {
							$css .= $addon_id . ' .uk-button-custom:hover, ' . $addon_id . ' .uk-button-custom:focus, ' . $addon_id . ' .uk-button-custom:active {' . $button_background_hover . $button_hover_color . '}';
						}
					}
				}
			}
		}

		return $css;
	}
}
