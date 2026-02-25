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
class SppagebuilderAddonUkAccordion extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;


		$multiple     = ( isset( $settings->multiple ) && $settings->multiple ) ? 1 : 0;
		$multiple_cls = ( $multiple ) ? ' multiple: true' : '';
		$closed       = ( isset( $settings->closed ) && $settings->closed ) ? 1 : 0;
		$closed_cls   = ( $closed ) ? 'collapsible: true;' : 'collapsible: false;';

		$card      = ( isset( $settings->accordion_style ) && $settings->accordion_style ) ? ' uk-card-' . $settings->accordion_style : '';
		$card_size = ( isset( $settings->card_size ) && $settings->card_size ) ? ' ' . $settings->card_size : '';

		$heading_style  = ( isset( $settings->title_color ) && $settings->title_color ) ? ' uk-text-' . $settings->title_color : '';
		$heading_style .= ( isset( $settings->title_text_transform ) && $settings->title_text_transform ) ? ' uk-text-' . $settings->title_text_transform : '';

		$content_style             = ( isset( $settings->content_style ) && $settings->content_style ) ? ' uk-' . $settings->content_style : '';
		$content_dropcap           = ( isset( $settings->content_dropcap ) && $settings->content_dropcap ) ? 1 : 0;
		$content_style            .= ( $content_dropcap ) ? ' uk-dropcap' : '';
		$content_style            .= ( isset( $settings->content_text_transform ) && $settings->content_text_transform ) ? ' uk-text-' . $settings->content_text_transform : '';
		$content_column            = ( isset( $settings->content_column ) && $settings->content_column ) ? ' uk-column-' . $settings->content_column : '';
		$content_column_breakpoint = ( $content_column ) ? ( ( isset( $settings->content_column_breakpoint ) && $settings->content_column_breakpoint ) ? '@' . $settings->content_column_breakpoint : '' ) : '';
		$content_column_divider    = ( $content_column ) ? ( ( isset( $settings->content_column_divider ) && $settings->content_column_divider ) ? ' uk-column-divider' : false ) : '';

		$content_style .= $content_column . $content_column_breakpoint . $content_column_divider;
		$content_style .= ( isset( $settings->content_margin_top ) && $settings->content_margin_top ) ? ' uk-margin-' . $settings->content_margin_top . '-top' : ' uk-margin-top';

		$attribs     = ( isset( $settings->target ) && $settings->target ) ? ' target="' . $settings->target . '"' : '';
		$btn_styles  = ( isset( $settings->button_style ) && $settings->button_style ) ? $settings->button_style : '';
		$button_size = ( isset( $settings->button_size ) && $settings->button_size ) ? ' ' . $settings->button_size : '';

		$button_style_cls = '';
		if ( empty( $btn_styles ) ) {
			$button_style_cls .= 'uk-button uk-button-default' . $button_size;
		} elseif ( $btn_styles == 'link' || $btn_styles == 'link-muted' || $btn_styles == 'link-text' ) {
			$button_style_cls .= 'uk-' . $btn_styles;
		} else {
			$button_style_cls .= 'uk-button uk-button-' . $btn_styles . $button_size;
		}

		$btn_margin_top   = ( isset( $settings->button_margin_top ) && $settings->button_margin_top ) ? 'uk-margin-' . $settings->button_margin_top . '-top' : 'uk-margin-top';
		$all_button_title = ( isset( $settings->all_button_title ) && $settings->all_button_title ) ? $settings->all_button_title : 'Learn more';

        $general    =   PageBuilder::general_styles($settings);

		$output      = '';

		$output .= '<div class="ukaccordion' . $general['container'] . $general['class'] . '"' . $general['animation'] . '>';

		$output .= '<div data-uk-accordion="' . $closed_cls . $multiple_cls . '">';

		if ( isset( $settings->uk_accordion_item ) && count( (array) $settings->uk_accordion_item ) ) {
			foreach ( $settings->uk_accordion_item as $key => $item ) {
				$title     = ( isset( $item->title ) && $item->title ) ? $item->title : '';
				$content   = ( isset( $item->content ) && $item->content ) ? $item->content : '';

				$title_link        = ( isset( $item->link ) && $item->link ) ? $item->link : '';
				$check_target      = ( isset( $settings->target ) && $settings->target ) ? $settings->target : '';
				$render_linkscroll = ( empty( $check_target ) && strpos( $title_link, '#' ) === 0 ) ? ' uk-scroll' : '';

				$button_title = ( isset( $item->button_title ) && $item->button_title ) ? $item->button_title : '';
				if ( empty( $button_title ) ) {
					$button_title .= $all_button_title;
				}
				if ( ! empty( $card ) ) {
					$output .= '<div class="uk-item uk-card uk-card-body' . $card . $card_size . '">';
					$output .= '<a class="uk-title uk-accordion-title' . $heading_style . '" href="#">';
				} else {
					$output .= '<div class="uk-panel">';
					$output .= '<a class="uk-title uk-accordion-title' . $heading_style . '" href="#">';
				}

				$output .= $title;
				$output .= '</a>';

				$output .= '<div class="uk-accordion-content uk-margin-remove-first-child">';

				if ( $content ) {
					$output .= '<div class="ukcontent uk-panel' . $content_style . '">';
					$output .= $content;
					$output .= '</div>';
				}

                $output .= ( $title_link ) ? '<div class="' . $btn_margin_top . '"><a class="' . $button_style_cls . '" href="' . $title_link . '"' . $attribs . $render_linkscroll . '>' . $button_title . '</a></div>' : '';


				$output .= '</div>'; // end acc content div

				$output .= '</div>';
			}
		}

		$output .= '</div>';

		$output .= '</div>';

		return $output;
	}

	public function css() {
		$settings           = $this->addon->settings;
		$addon_id           = '#sppb-addon-' . $this->addon->id;
		$icon_align     	= ( isset( $settings->icon_align ) && $settings->icon_align ) ? 1 : 0;
		$styles             = ( isset( $settings->accordion_style ) && $settings->accordion_style ) ? $settings->accordion_style : '';
		$title_color        = ( isset( $settings->title_color ) && $settings->title_color ) ? $settings->title_color : '';
		$custom_title_color = ( isset( $settings->custom_title_color ) && $settings->custom_title_color ) ? 'color: ' . $settings->custom_title_color . ';' : '';
		$content_color      = ( isset( $settings->content_color ) && $settings->content_color ) ? 'color: ' . $settings->content_color . ';' : '';
		$link_button_style  = ( isset( $settings->button_style ) && $settings->button_style ) ? $settings->button_style : '';
		$button_background  = ( isset( $settings->button_background ) && $settings->button_background ) ? 'background-color: ' . $settings->button_background . ';' : '';
		$button_color       = ( isset( $settings->button_color ) && $settings->button_color ) ? 'color: ' . $settings->button_color . ';' : '';

		$button_background_hover = ( isset( $settings->button_background_hover ) && $settings->button_background_hover ) ? 'background-color: ' . $settings->button_background_hover . ';' : '';
		$button_hover_color      = ( isset( $settings->button_hover_color ) && $settings->button_hover_color ) ? 'color: ' . $settings->button_hover_color . ';' : '';

		$css = '';

		if ( empty( $title_color ) && $custom_title_color ) {
			$css .= $addon_id . ' .uk-title {' . $custom_title_color . '}';
		}

		if ($icon_align) {
			$css .= $addon_id . ' .uk-accordion-title::before { margin-right: 8px; margin-left: -8px; float: left; }';
		}
		if ( $content_color ) {
			$css .= $addon_id . ' .ukcontent {' . $content_color . '}';
		}

		if ( $link_button_style == 'custom' ) {
			if ( $button_background || $button_color ) {
				$css .= $addon_id . ' .uk-button-custom {' . $button_background . $button_color . '}';
			}
			if ( $button_background_hover || $button_hover_color ) {
				$css .= $addon_id . ' .uk-button-custom:hover, ' . $addon_id . ' .uk-button-custom:focus, ' . $addon_id . ' .uk-button-custom:active {' . $button_background_hover . $button_hover_color . '}';
			}
		}

		if ( !empty( $styles ) ) {
            $css .= $addon_id . ' .ukaccordion .uk-card-small .uk-card-body, .ukaccordion .uk-card-small.uk-card-body {';
            $css .= 'padding: 12px 20px;';
            $css .= '}';
		}
		return $css;
	}
}
