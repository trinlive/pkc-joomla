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
defined( '_JEXEC' ) or die( 'Restricted access' );
use Jollyany\Helper\PageBuilder;
class SppagebuilderAddonUKPricing extends SppagebuilderAddons {

	public function render() {

		$settings = $this->addon->settings;

		$title_addon              = ( isset( $settings->title_addon ) && $settings->title_addon ) ? $settings->title_addon : '';
		$title_style              = ( isset( $settings->title_heading_style ) && $settings->title_heading_style ) ? ' uk-' . $settings->title_heading_style : '';
		$title_style             .= ( isset( $settings->title_heading_color ) && $settings->title_heading_color ) ? ' uk-' . $settings->title_heading_color : '';
		$title_style             .= ( isset( $settings->title_heading_margin ) && $settings->title_heading_margin ) ? ' ' . $settings->title_heading_margin : '';
		$title_heading_decoration = ( isset( $settings->title_heading_decoration ) && $settings->title_heading_decoration ) ? ' ' . $settings->title_heading_decoration : '';
		$title_heading_selector   = ( isset( $settings->title_heading_selector ) && $settings->title_heading_selector ) ? $settings->title_heading_selector : 'h3';

		// Options.

		$price_title       = ( isset( $settings->price_title ) && $settings->price_title ) ? $settings->price_title : '';
		$price_meta        = ( isset( $settings->price_meta ) && $settings->price_meta ) ? $settings->price_meta : '';
		$price_description = ( isset( $settings->price_description ) && $settings->price_description ) ? $settings->price_description : '';

		$price        = ( isset( $settings->price ) && $settings->price ) ? $settings->price : '';
		$symbol       = ( isset( $settings->symbol ) && $settings->symbol ) ? $settings->symbol : '';
		$divider_type = ( isset( $settings->divider_type ) && $settings->divider_type ) ? '<hr class="uk-divider-' . $settings->divider_type . '">' : '';

		$card      = ( isset( $settings->card_style ) && $settings->card_style ) ? $settings->card_style : '';
		$card_size = ( isset( $settings->card_size ) && $settings->card_size ) ? $settings->card_size : '';

		$card_size_cls = ( $card_size && $card_size != 'custom' ) ? ' uk-card-' . $card_size : '';

		$box_shadow = ( isset( $settings->hover ) && $settings->hover ) ? ' uk-box-shadow-hover-' . $settings->hover : '';

		$label_text   = ( isset( $settings->label_text ) && $settings->label_text ) ? $settings->label_text : '';
		$label_styles = ( isset( $settings->label_styles ) && $settings->label_styles ) ? ' ' . $settings->label_styles : ' uk-label';

		$list_marker = ( isset( $settings->list_marker ) && $settings->list_marker ) ? $settings->list_marker : '';

		$list_styles  = ( isset( $settings->list_styles ) && $settings->list_styles ) ? ' uk-list-' . $settings->list_styles : '';
		$list_styles .= ( isset( $settings->list_marker ) && $settings->list_marker ) ? ' uk-list-' . $settings->list_marker : '';
		$list_styles .= ( $list_marker ) ? ( ( isset( $settings->list_marker_color ) && $settings->list_marker_color ) ? ' uk-list-' . $settings->list_marker_color : '' ) : '';

		$list_styles .= ( isset( $settings->title_text_color ) && $settings->title_text_color ) ? ' uk-text-' . $settings->title_text_color : '';

		$price_heading         = ( isset( $settings->price_heading ) && $settings->price_heading ) ? ' uk-' . $settings->price_heading : '';
		$price_heading        .= ( isset( $settings->price_color ) && $settings->price_color ) ? ' uk-text-' . $settings->price_color : '';
		$price_margin_top      = ( isset( $settings->price_margin_top ) && $settings->price_margin_top ) ? ' uk-margin-' . $settings->price_margin_top . '-top' : ' uk-margin-top';
		$feature_margin_top    = ( isset( $settings->feature_margin_top ) && $settings->feature_margin_top ) ? ' uk-margin-' . $settings->feature_margin_top . '-top' : ' uk-margin-top';
		$price_symbol_heading  = ( isset( $settings->price_symbol_heading ) && $settings->price_symbol_heading ) ? ' uk-' . $settings->price_symbol_heading : '';
		$price_symbol_heading .= ( isset( $settings->symbol_color ) && $settings->symbol_color ) ? ' uk-text-' . $settings->symbol_color : '';

		// New style options.

		$heading_selector = ( isset( $settings->heading_selector ) && $settings->heading_selector ) ? $settings->heading_selector : 'h3';
		$heading_style    = ( isset( $settings->heading_style ) && $settings->heading_style ) ? ' uk-' . $settings->heading_style : '';
		$heading_style   .= ( isset( $settings->title_color ) && $settings->title_color ) ? ' uk-text-' . $settings->title_color : '';
		$heading_style   .= ( isset( $settings->title_text_transform ) && $settings->title_text_transform ) ? ' uk-text-' . $settings->title_text_transform : '';
		$heading_style   .= ( isset( $settings->title_margin_top ) && $settings->title_margin_top ) ? ' uk-margin-' . $settings->title_margin_top . '-top' : ' uk-margin-top';
		$heading_style   .= ( isset( $settings->title_font_weight ) && $settings->title_font_weight ) ? ' uk-text-' . $settings->title_font_weight : '';
		$title_decoration = ( isset( $settings->title_decoration ) && $settings->title_decoration ) ? ' ' . $settings->title_decoration : '';

		$description_style  = ( isset( $settings->description_style ) && $settings->description_style ) ? ' uk-' . $settings->description_style : '';
		$description_style .= ( isset( $settings->description_color ) && $settings->description_color ) ? ' uk-text-' . $settings->description_color : '';
		$description_style .= ( isset( $settings->description_text_transform ) && $settings->description_text_transform ) ? ' uk-text-' . $settings->description_text_transform : '';
		$description_style .= ( isset( $settings->description_margin_top ) && $settings->description_margin_top ) ? ' uk-margin-' . $settings->description_margin_top . '-top' : ' uk-margin-top';

		$title_alignment = ( isset( $settings->title_alignment ) && $settings->title_alignment ) ? $settings->title_alignment : '';

		// Meta
		$meta_element   = ( isset( $settings->meta_element ) && $settings->meta_element ) ? $settings->meta_element : 'div';
		$meta_style_cls = ( isset( $settings->meta_style ) && $settings->meta_style ) ? $settings->meta_style : '';

		$meta_style  = ( isset( $settings->meta_style ) && $settings->meta_style ) ? ' uk-' . $settings->meta_style : '';
		$meta_style .= ( isset( $settings->meta_color ) && $settings->meta_color ) ? ' uk-text-' . $settings->meta_color : '';
		$meta_style .= ( isset( $settings->meta_text_transform ) && $settings->meta_text_transform ) ? ' uk-text-' . $settings->meta_text_transform : '';
		$meta_style .= ( isset( $settings->meta_margin_top ) && $settings->meta_margin_top ) ? ' uk-margin-' . $settings->meta_margin_top . '-top' : ' uk-margin-top';

		$meta_alignment = ( isset( $settings->meta_alignment ) && $settings->meta_alignment ) ? $settings->meta_alignment : '';

		// Remove margin for heading element
		if ( $meta_element != 'div' || ( $meta_style_cls && $meta_style_cls != 'text-meta' ) ) {
			$meta_style .= ' uk-margin-remove-bottom';
		}

		$link_title = ( $price_title ) ? ' title="' . $price_title . '"' : '';

		$button_title = ( isset( $settings->button_title ) && $settings->button_title ) ? $settings->button_title : '';
		$button_link  = ( isset( $settings->button_link ) && $settings->button_link ) ? $settings->button_link : '';
		$attribs      = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? ' target="' . $settings->link_new_tab . '"' : '';
		$btn_styles   = ( isset( $settings->button_style ) && $settings->button_style ) ? '' . $settings->button_style : '';
		$button_size  = ( isset( $settings->button_size ) && $settings->button_size ) ? ' ' . $settings->button_size : '';
        $button_shape = (isset($settings->button_shape) && $settings->button_shape) ? ' uk-button-' . $settings->button_shape : ' uk-button-square';
		$button_width = ( isset( $settings->button_width ) && $settings->button_width ) ? ' uk-width-1-1' : '';

		$button_style_cls = '';
		if ( empty( $btn_styles ) ) {
			$button_style_cls .= 'uk-button uk-button-default' . $button_size . $button_width. $button_shape;
		} elseif ( $btn_styles == 'link' || $btn_styles == 'link-muted' || $btn_styles == 'link-text' ) {
			$button_style_cls .= 'uk-' . $btn_styles;
		} else {
			$button_style_cls .= 'uk-button uk-button-' . $btn_styles . $button_size . $button_width. $button_shape;
		}

		$btn_margin_top = ( isset( $settings->button_margin_top ) && $settings->button_margin_top ) ? 'uk-margin-' . $settings->button_margin_top . '-top' : 'uk-margin-top';

		$check_target = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? $settings->link_new_tab : '';

		$render_linkscroll  = ( empty( $check_target ) && strpos( $button_link, '#' ) === 0 ) ? ' uk-scroll' : '';
		$symbol_font_weight = ( isset( $settings->symbol_font_weight ) && $settings->symbol_font_weight ) ? ' uk-text-' . $settings->symbol_font_weight : '';

		// Global Icon
		$icon_size     = ( isset( $settings->icon_size ) && $settings->icon_size ) ? '; width: ' . $settings->icon_size . '' : '';
		$all_icon_type = ( isset( $settings->all_icon_type ) && $settings->all_icon_type ) ? $settings->all_icon_type : '';
		$all_icon_name = ( isset( $settings->all_icon_name ) && $settings->all_icon_name ) ? $settings->all_icon_name : '';
		$all_uikit     = ( isset( $settings->all_uikit ) && $settings->all_uikit ) ? $settings->all_uikit : '';

		$all_icon_arr = array_filter( explode( ' ', $all_icon_name ) );
		if ( count( $all_icon_arr ) === 1 ) {
			$all_icon_name = 'fa ' . $all_icon_name;
		}
		$panel_link            = ( isset( $settings->panel_link ) && $settings->panel_link ) ? 1 : 0;
		$panel_content_padding = ( isset( $settings->card_content_padding ) && $settings->card_content_padding ) ? $settings->card_content_padding : '';
		$card_border_radius    = ( isset( $settings->card_border_radius ) && $settings->card_border_radius ) ? ' uk-border-'. $settings->card_border_radius : '';

		$card_content_padding = ( $panel_content_padding && empty( $card ) ) ? 'uk-padding' . ( ( $panel_content_padding == 'default' ) ? ' uk-margin-remove-first-child' : '-' . $panel_content_padding . ' uk-margin-remove-first-child' ) : '';

		$panel_cls  = ( $card ) ? 'uk-card uk-card-' . $card . $card_size_cls : 'uk-panel';
		$panel_cls .= ( $card && $card != 'hover' && $panel_link ) ? ' uk-card-hover' : '';
		$panel_cls .= ( $card ) ? ' uk-card-body uk-margin-remove-first-child' : '';

		$panel_cls .= ( empty( $card ) && empty( $panel_content_padding ) ) ? ' uk-margin-remove-first-child' : '';
        $panel_cls .= $card_border_radius;

        $general    =   PageBuilder::general_styles($settings);

		$output = '';

		// Output.

		$output .= '<div class="' . $panel_cls . $box_shadow . $general['container'] . $general['class'] . '"' . $general['animation'] . '>';

		if ( $title_addon ) {
			$output .= '<' . $title_heading_selector . ' class="tz-title' . $title_style . $title_heading_decoration . '">';

			$output .= ( $title_heading_decoration == ' uk-heading-line' ) ? '<span>' : '';

			$output .= nl2br( $title_addon );

			$output .= ( $title_heading_decoration == ' uk-heading-line' ) ? '</span>' : '';

			$output .= '</' . $title_heading_selector . '>';
		}

		$output .= ( $card_content_padding ) ? '<div class="' . $card_content_padding . '">' : '';

		if ( $title_alignment == 'top' && $price_title ) {
			$output .= '<' . $heading_selector . ' class="ui-title uk-margin-remove-bottom' . $heading_style . $title_decoration . '">';
			$output .= ( $title_decoration == ' uk-heading-line' ) ? '<span>' : '';
			$output .= $price_title;
			$output .= ( $title_decoration == ' uk-heading-line' ) ? '</span>' : '';
			$output .= '</' . $heading_selector . '>';
		}

		if ( $meta_alignment == 'top' ) {
			$output .= ( $price_meta ) ? '<span class="plan-period' . $meta_style . '">' . $price_meta . '</span>' : '';
		}

		$output .= '<div class="pricing-value' . $price_margin_top . '">';
		$output .= ( $symbol ) ? '<span class="pricing-symbol' . $price_symbol_heading . $symbol_font_weight . '">' . $symbol . '</span>' : '';
		$output .= ( $price ) ? '<span class="pricing-amount' . $price_heading . '">' . $price . '</span>' : '';

		$output .= ( $label_text ) ? '<div class="tz-price-table_featured f-2"><div class="tz-price-table_featured-inner' . $label_styles . '">' . $label_text . '</div></div>' : '';

		if ( $meta_alignment == 'inline' ) {
			$output .= ( $price_meta ) ? '<span class="plan-period' . $meta_style . '">' . $price_meta . '</span>' : '';
		}

		$output .= '</div>';
		if ( empty( $meta_alignment ) ) {
			$output .= ( $price_meta ) ? '<span class="plan-period' . $meta_style . '">' . $price_meta . '</span>' : '';
		}
		$output .= ( $price_description ) ? '<div class="plan-description' . $description_style . '">' . $price_description . '</div>' : '';

		if ( empty( $title_alignment ) && $price_title ) {
			$output .= '<' . $heading_selector . ' class="ui-title uk-margin-remove-bottom' . $heading_style . $title_decoration . '">';
			$output .= ( $title_decoration == ' uk-heading-line' ) ? '<span>' : '';
			$output .= $price_title;
			$output .= ( $title_decoration == ' uk-heading-line' ) ? '</span>' : '';
			$output .= '</' . $heading_selector . '>';
		}

		$output .= $divider_type;

		if ( isset( $settings->uk_pricing_items ) && count( (array) $settings->uk_pricing_items ) ) {
			$output .= '<div class="pricing-features' . $feature_margin_top . '">';

			$output .= '<ul class="uk-list' . $list_styles . '">';

			foreach ( $settings->uk_pricing_items as $key => $item ) {
				$title_link  = ( isset( $item->title_link ) && $item->title_link ) ? $item->title_link : '';
				$link_target = ( isset( $item->link_new_tab ) && $item->link_new_tab ) ? 'target="_blank"' : '';
				$title       = ( isset( $item->title ) && $item->title ) ? $item->title : '';
				$key++;
				$icon_id = $this->addon->id + $key;

				$icon_type = ( isset( $item->icon_type ) && $item->icon_type ) ? $item->icon_type : '';
				$icon      = ( isset( $item->icon_name ) && $item->icon_name ) ? $item->icon_name : '';
				$uk_icon   = ( isset( $item->uikit ) && $item->uikit ) ? $item->uikit : '';

				$icon_arr = array_filter( explode( ' ', $icon ) );
				if ( count( $icon_arr ) === 1 ) {
					$icon = 'fa ' . $icon;
				}

				if ( $icon_type === 'fontawesome_icon' ) {
					$icon_render = '<i id="icon-' . $icon_id . '" class="tz-icon ' . $icon . '" aria-hidden="true"></i>';
				} else {
					$icon_render = '<span id="icon-' . $icon_id . '" class="tz-icon uk-icon" uk-icon="icon: ' . $uk_icon . $icon_size . '"></span>';
				}

				if ( $all_icon_type === 'fontawesome_icon' ) {
					$all_icon_render = '<i id="icon-' . $icon_id . '" class="tz-icon ' . $all_icon_name . '" aria-hidden="true"></i>';
				} else {
					$all_icon_render = '<span id="icon-' . $icon_id . '" class="tz-icon uk-icon" uk-icon="icon: ' . $all_uikit . $icon_size . '"></span>';
				}

				$output .= '<li class="ui-item">';
				if ( $icon_type || $all_icon_type ) {
					$output .= '<div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-middle" uk-grid>';
					$output .= '<div class="uk-width-auto">';
					$output .= ( $icon_type ) ? $icon_render : $all_icon_render;
					$output .= '</div>';
					$output .= '<div>';
				}

				$output .= '<div class="el-content uk-panel">';
				$output .= ( $title_link ) ? '<a class="el-link uk-margin-remove-last-child" href="' . $title_link . '" ' . $link_target . '>' : '';
				$output .= $title;
				$output .= ( $title_link ) ? '</a>' : '';
				$output .= '</div>';

				if ( $icon_type || $all_icon_type ) {
					$output .= '</div>';
					$output .= '</div>';
				}

				$output .= '</li>';
			}
			$output .= '</ul>';

			$output .= '</div>';
		}

		if ( ! empty( $button_link ) ) {
			$output .= '<div class="' . $btn_margin_top . '"><a class="' . $button_style_cls . $button_width . '" href="' . $button_link . '"' . $attribs . $render_linkscroll . $link_title . '>' . $button_title . '</a></div>';
		}

		$output .= ( $card_content_padding ) ? '</div>' : '';

		$output .= '</div>';

		return $output;
	}

	public function css() {
		$lang           = JFactory::getLanguage();
		$dir            = $lang->get( 'rtl' );
		$settings       = $this->addon->settings;
		$addon_id       = '#sppb-addon-' . $this->addon->id;
		$all_icon_color = ( isset( $settings->all_icon_color ) && $settings->all_icon_color ) ? $settings->all_icon_color : '';
		$icon_size      = ( isset( $settings->icon_size ) && $settings->icon_size ) ? 'font-size: ' . (int) $settings->icon_size . 'px;' : '';

		$styles = array();
		if ( isset( $settings->uk_pricing_items ) && count( (array) $settings->uk_pricing_items ) ) {
			foreach ( $settings->uk_pricing_items as $key => $item ) {
				$key++;
				$icon_id     = $this->addon->id + $key;
				$icon_style  = '';
				$icon_style .= ( isset( $item->icon_color ) && $item->icon_color ) ? 'color: ' . $item->icon_color . ';' : '';
				$css         = '';

				if ( $icon_style ) {
					$css .= $addon_id . ' .uk-list > li #icon-' . $icon_id . ' {';
					$css .= $icon_style;
					$css .= "\n" . '}' . "\n";
				}
				$styles[ $key ] = $css;
			}
		}
		$styles_explode = implode( "\n", $styles );

		// return $styles_explode;

		$label_styles           = ( isset( $settings->label_styles ) && $settings->label_styles ) ? $settings->label_styles : '';
		$label_background_color = ( isset( $settings->label_background_color ) && $settings->label_background_color ) ? 'background-color: ' . $settings->label_background_color . ';' : '';
		$label_color            = ( isset( $settings->label_color ) && $settings->label_color ) ? 'color: ' . $settings->label_color . ';' : '';

		$title_color        = ( isset( $settings->title_color ) && $settings->title_color ) ? $settings->title_color : '';
		$custom_title_color = ( isset( $settings->custom_title_color ) && $settings->custom_title_color ) ? 'color: ' . $settings->custom_title_color . ' !important;' : '';

		$title_text_color        = ( isset( $settings->title_text_color ) && $settings->title_text_color ) ? $settings->title_text_color : '';
		$custom_title_text_color = ( isset( $settings->custom_title_text_color ) && $settings->custom_title_text_color ) ? 'color: ' . $settings->custom_title_text_color . ';' : '';

		$meta_color        = ( isset( $settings->meta_color ) && $settings->meta_color ) ? $settings->meta_color : '';
		$custom_meta_color = ( isset( $settings->custom_meta_color ) && $settings->custom_meta_color ) ? 'color: ' . $settings->custom_meta_color . ';' : '';

		$description_color        = ( isset( $settings->description_color ) && $settings->description_color ) ? $settings->description_color : '';
		$custom_description_color = ( isset( $settings->custom_description_color ) && $settings->custom_description_color ) ? 'color: ' . $settings->custom_description_color . ';' : '';

		$price_color        = ( isset( $settings->price_color ) && $settings->price_color ) ? $settings->price_color : '';
		$custom_price_color = ( isset( $settings->custom_price_color ) && $settings->custom_price_color ) ? 'color: ' . $settings->custom_price_color . ';' : '';

		$currency_color        = ( isset( $settings->currency_color ) && $settings->currency_color ) ? $settings->currency_color : '';
		$custom_currency_color = ( isset( $settings->custom_currency_color ) && $settings->custom_currency_color ) ? 'color: ' . $settings->custom_currency_color . ';' : '';

		$content_color     = ( isset( $settings->content_color ) && $settings->content_color ) ? 'color: ' . $settings->content_color . ';' : '';
		$button_style      = ( isset( $settings->button_style ) && $settings->button_style ) ? $settings->button_style : '';
		$button_background = ( isset( $settings->button_background ) && $settings->button_background ) ? 'background-color: ' . $settings->button_background . ';' : '';
		$button_color      = ( isset( $settings->button_color ) && $settings->button_color ) ? 'color: ' . $settings->button_color . ';' : '';

		$button_background_hover = ( isset( $settings->button_background_hover ) && $settings->button_background_hover ) ? 'background-color: ' . $settings->button_background_hover . ';' : '';
		$button_hover_color      = ( isset( $settings->button_hover_color ) && $settings->button_hover_color ) ? 'color: ' . $settings->button_hover_color . ';' : '';

		$heading_fontsize  = ( isset( $settings->price_fontsize ) && $settings->price_fontsize ) ? 'font-size: ' . $settings->price_fontsize . 'px; ' : '';
		$currency_fontsize = ( isset( $settings->currency_fontsize ) && $settings->currency_fontsize ) ? 'font-size: ' . $settings->currency_fontsize . 'px; ' : '';
		$currency_margin   = ( isset( $settings->currency_margin ) && $settings->currency_margin ) ? $settings->currency_margin : '15';

		$price_padding_left = ( isset( $settings->price_padding_left ) && $settings->price_padding_left ) ? 'padding-left: ' . $settings->price_padding_left . 'px; ' : '';

		$card_style = ( isset( $settings->card_style ) && $settings->card_style ) ? $settings->card_style : '';
		$card_size  = ( isset( $settings->card_size ) && $settings->card_size ) ? $settings->card_size : '';

		$body_padding_top    = ( isset( $settings->body_padding_top ) && $settings->body_padding_top ) ? $settings->body_padding_top : 0;
		$body_padding_bottom = ( isset( $settings->body_padding_bottom ) && $settings->body_padding_bottom ) ? $settings->body_padding_bottom : 0;
		$body_padding_left   = ( isset( $settings->body_padding_left ) && $settings->body_padding_left ) ? $settings->body_padding_left : 0;
		$body_padding_right  = ( isset( $settings->body_padding_right ) && $settings->body_padding_right ) ? $settings->body_padding_right : 0;

		$body_background_color = ( isset( $settings->card_background ) && $settings->card_background ) ? 'background-color: ' . $settings->card_background . ';' : '';
		$card_color            = ( isset( $settings->card_color ) && $settings->card_color ) ? 'color: ' . $settings->card_color . ';' : '';
		$card_border           = ( isset( $settings->card_border ) && $settings->card_border ) ? 'border-width: ' . $settings->card_border . 'px;' : '';
		$card_border_color     = ( isset( $settings->card_border_color ) && $settings->card_border_color ) ? 'border-color: ' . $settings->card_border_color . ';' : '';

		$price_css = '';

		if ( empty( $title_color ) && $custom_title_color ) {
			$price_css .= $addon_id . ' .ui-title {' . $custom_title_color . '}';
		}

		if ( empty( $meta_color ) && $custom_meta_color ) {
			$price_css .= $addon_id . ' .plan-period {' . $custom_meta_color . '}';
		}

		if ( empty( $description_color ) && $custom_description_color ) {
			$price_css .= $addon_id . ' .plan-description {' . $custom_description_color . '}';
		}

		if ( empty( $title_text_color ) && $custom_title_text_color ) {
			$price_css .= $addon_id . ' .uk-list .ui-item {' . $custom_title_text_color . '}';
		}

		if ( empty( $price_color ) && $custom_price_color ) {
			$price_css .= $addon_id . ' .pricing-amount {' . $custom_price_color . '}';
		}

		if ( empty( $currency_color ) && $custom_currency_color ) {
			$price_css .= $addon_id . ' .pricing-symbol {' . $custom_currency_color . '}';
		}

		if ( $content_color ) {
			$price_css .= $addon_id . ' .ui-content {' . $content_color . '}';
		}

		if ( $label_styles == 'uk-label-custom' && $label_background_color ) {
			$price_css .= $addon_id . ' .uk-label-custom {' . $label_background_color . $label_color . '}';
		}

		if ( $button_style == 'custom' ) {
			if ( $button_background || $button_color ) {
				$price_css .= $addon_id . ' .uk-button-custom {' . $button_background . $button_color . '}';
			}
			if ( $button_background_hover || $button_hover_color ) {
				$price_css .= $addon_id . ' .uk-button-custom:hover, ' . $addon_id . ' .uk-button-custom:focus, ' . $addon_id . ' .uk-button-custom:active, ' . $addon_id . ' .uk-button-custom.uk-active {' . $button_background_hover . $button_hover_color . '}';
			}
		}

		if ( ! empty( $heading_fontsize ) && empty( $heading_styles ) ) {
			$price_css .= $addon_id . ' .pricing-amount {' . $heading_fontsize . '}';
		}

		if ( ! empty( $currency_fontsize ) ) {
			$price_css .= $addon_id . ' .pricing-symbol {' . $currency_fontsize . '}';
		}

		if ( $currency_margin ) {
			$price_css .= $addon_id . ' .pricing-symbol {margin-top:' . $currency_margin . 'px;}';
		}

		if ( ! empty( $price_padding_left ) ) {
			$price_css .= $addon_id . ' .price-wrapper {' . $price_padding_left . '}';
		}

		if ( ! empty( $card_style ) && 'custom' == $card_size ) {
			$price_css .= $addon_id . ' .uk-card-custom { padding-top: ' . $body_padding_top . 'px; padding-bottom: ' . $body_padding_bottom . 'px; padding-left: ' . $body_padding_left . 'px; padding-right: ' . $body_padding_right . 'px;}';
		}

		if ( $card_style == 'custom' && $body_background_color ) {
			$price_css .= $addon_id . ' .uk-card-custom {' . $body_background_color . '}';
		}

        if ( $card_style == 'custom' && $card_border ) {
            $price_css .= $addon_id . ' .uk-card-custom {' . $card_border . ($card_border_color ? $card_border_color : '') . 'border-style:solid;}';
        }

		if ( $card_style == 'custom' && $card_color ) {
			$price_css .= $addon_id . ' .uk-card-custom.uk-card-body, ' . $addon_id . ' .uk-card-custom>:not([class*=uk-card-media]) {' . $card_color . '}';
		}

		$price_css .= $addon_id . ' .pricing-symbol { display: inline-block; margin-right: 5px; vertical-align: top; }';
		$price_css .= ( $all_icon_color ) ? $addon_id . ' i {color:' . $all_icon_color . '}' : '';
		if ( $icon_size ) {
			$price_css .= $addon_id . ' .tz-icon {';
			$price_css .= $icon_size;
			$price_css .= "\n" . '}' . "\n";
		}
		return $price_css . $styles_explode;

	}
}
