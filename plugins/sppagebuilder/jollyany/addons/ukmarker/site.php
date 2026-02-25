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
class SppagebuilderAddonUKMarker extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;

		// Options.
		$image_marker     = ( isset( $settings->image ) && $settings->image ) ? $settings->image : '';
		$image_marker_src = isset( $image_marker->src ) ? $image_marker->src : $image_marker;
        $image_properties   =   false;
		if ( strpos( $image_marker_src, 'http://' ) !== false || strpos( $image_marker_src, 'https://' ) !== false ) {
            $image_properties   =   getimagesize($image_marker_src);
		} elseif ( $image_marker_src ) {
            $image_properties   =   getimagesize(JPATH_BASE . '/' . $image_marker_src);
			$image_marker_src   =   JURI::base( true ) . '/' . $image_marker_src;
		}
        if (is_array($image_properties) && count($image_properties) > 2) {
            $data_marker_src = 'data-src="' . $image_marker_src . '" data-width="' . $image_properties[0] . '" data-height="' . $image_properties[1] . '" uk-img';
        } else {
            $data_marker_src = 'src="' . $image_marker_src . '"';
        }
		$alt_text      = ( isset( $settings->alt_text ) && $settings->alt_text ) ? $settings->alt_text : '';
		$alt_text_init = ( ! empty( $alt_text ) ) ? 'alt="' . $alt_text . '"' : '';

		$popover_mode  = ( isset( $settings->popover_mode ) && $settings->popover_mode ) ? ' mode: ' . $settings->popover_mode . ';' : '';
		$popover_width = ( isset( $settings->popover_width ) && $settings->popover_width ) ? 'style="width: ' . $settings->popover_width . 'px;"' : '';

		$popover_animation = ( isset( $settings->popover_animation ) && $settings->popover_animation ) ? 'animation: uk-animation-' . $settings->popover_animation . ';' : '';

		// New style options.

		$heading_selector = ( isset( $settings->heading_selector ) && $settings->heading_selector ) ? $settings->heading_selector : 'h3';
		$heading_style    = ( isset( $settings->heading_style ) && $settings->heading_style ) ? ' uk-' . $settings->heading_style : '';
		$heading_style   .= ( isset( $settings->title_color ) && $settings->title_color ) ? ' uk-text-' . $settings->title_color : '';
		$heading_style   .= ( isset( $settings->title_text_transform ) && $settings->title_text_transform ) ? ' uk-text-' . $settings->title_text_transform : '';
		$heading_style   .= ( isset( $settings->title_margin_top ) && $settings->title_margin_top ) ? ' uk-margin-' . $settings->title_margin_top . '-top' : ' uk-margin-top';
		$title_decoration = ( isset( $settings->title_decoration ) && $settings->title_decoration ) ? ' ' . $settings->title_decoration : '';

		$heading_style_cls      = ( isset( $settings->heading_style ) && $settings->heading_style ) ? ' uk-' . $settings->heading_style : '';
		$heading_style_cls_init = ( empty( $heading_style_cls ) ) ? ' uk-card-title' : '';

		// Meta.
		$meta_element   = ( isset( $settings->meta_element ) && $settings->meta_element ) ? $settings->meta_element : 'div';
		$meta_style_cls = ( isset( $settings->meta_style ) && $settings->meta_style ) ? $settings->meta_style : '';

		$meta_style  = ( isset( $settings->meta_style ) && $settings->meta_style ) ? ' uk-' . $settings->meta_style : '';
		$meta_style .= ( isset( $settings->meta_color ) && $settings->meta_color ) ? ' uk-text-' . $settings->meta_color : '';
		$meta_style .= ( isset( $settings->meta_text_transform ) && $settings->meta_text_transform ) ? ' uk-text-' . $settings->meta_text_transform : '';
		$meta_style .= ( isset( $settings->meta_margin_top ) && $settings->meta_margin_top ) ? ' uk-margin-' . $settings->meta_margin_top . '-top' : ' uk-margin-top';

		// Remove margin for heading element
		if ( $meta_element != 'div' || ( $meta_style_cls && $meta_style_cls != 'text-meta' ) ) {
			$meta_style .= ' uk-margin-remove-bottom';
		}

		$meta_alignment = ( isset( $settings->meta_alignment ) && $settings->meta_alignment ) ? $settings->meta_alignment : '';

		$content_style  = ( isset( $settings->content_style ) && $settings->content_style ) ? ' uk-' . $settings->content_style : '';
		$content_style .= ( isset( $settings->content_text_transform ) && $settings->content_text_transform ) ? ' uk-text-' . $settings->content_text_transform : '';
		$content_style .= ( isset( $settings->content_margin_top ) && $settings->content_margin_top ) ? ' uk-margin-' . $settings->content_margin_top . '-top' : ' uk-margin-top';

		$card      = ( isset( $settings->card_styles ) && $settings->card_styles ) ? ' uk-card-' . $settings->card_styles : ' uk-card-default';
		$card_size = ( isset( $settings->card_size ) && $settings->card_size ) ? ' ' . $settings->card_size : '';

		// Remove attribs if not needed.

		$link_target = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? ' target="' . $settings->link_new_tab . '"' : '';

		$button_style = ( isset( $settings->link_button_style ) && $settings->link_button_style ) ? $settings->link_button_style : '';
		$button_size  = ( isset( $settings->link_button_size ) && $settings->link_button_size ) ? ' ' . $settings->link_button_size : '';

		$button_style_cls = '';
		if ( empty( $button_style ) ) {
			$button_style_cls .= 'uk-button uk-button-default' . $button_size;
		} elseif ( $button_style == 'link' || $button_style == 'link-muted' || $button_style == 'link-text' ) {
			$button_style_cls .= 'uk-' . $button_style;
		} else {
			$button_style_cls .= 'uk-button uk-button-' . $button_style . $button_size;
		}

		$btn_margin_top = ( isset( $settings->button_margin_top ) && $settings->button_margin_top ) ? 'uk-margin-' . $settings->button_margin_top . '-top' : 'uk-margin-top';

		$all_button_title = ( isset( $settings->all_button_title ) && $settings->all_button_title ) ? $settings->all_button_title : 'Learn more';

		$image_padding = ( isset( $settings->image_padding ) && $settings->image_padding ) ? 1 : 0;

		$image_styles     = ( isset( $settings->image_border ) && $settings->image_border ) ? ' uk-border-' . $settings->image_border : '';
		$image_styles_cls = ( empty( $image_padding ) ) ? $image_styles : '';

		$popover_position = ( isset( $settings->popover_position ) && $settings->popover_position ) ? 'pos: ' . $settings->popover_position . ';' : '';

		// New options.
		$mobile_switcher  = ( isset( $settings->mobile_switcher ) && $settings->mobile_switcher ) ? 1 : 0;
		$link_title       = ( isset( $settings->link_title ) && $settings->link_title ) ? 1 : 0;
		$link_title_hover = ( isset( $settings->title_hover_style ) && $settings->title_hover_style ) ? ' class="uk-link-' . $settings->title_hover_style . '"' : '';
		$panel_link       = ( isset( $settings->panel_link ) && $settings->panel_link ) ? 1 : 0;

		$image_link           = ( isset( $settings->image_link ) && $settings->image_link ) ? 1 : 0;
		$image_width          = ( isset( $settings->image_width ) && $settings->image_width ) ? ' width="' . $settings->image_width . '"' : '';
		$image_height         = ( isset( $settings->image_height ) && $settings->image_height ) ? ' height="' . $settings->image_height . '"' : '';
		$image_svg_inline     = ( isset( $settings->image_svg_inline ) && $settings->image_svg_inline ) ? $settings->image_svg_inline : false;
		$image_svg_inline_cls = ( $image_svg_inline ) ? ' uk-svg' : '';
		$image_svg_color      = ( $image_svg_inline ) ? ( ( isset( $settings->image_svg_color ) && $settings->image_svg_color ) ? ' uk-text-' . $settings->image_svg_color : '' ) : false;

		$image_panel      = ( isset( $settings->image_panel ) && $settings->image_panel ) ? 1 : 0;
		$media_background = ( $image_panel ) ? ( ( isset( $settings->media_background ) && $settings->media_background ) ? ' style="background-color: ' . $settings->media_background . ';"' : '' ) : '';
		$media_blend_mode = ( $image_panel && $media_background ) ? ( ( isset( $settings->media_blend_mode ) && $settings->media_blend_mode ) ? ' uk-blend-' . $settings->media_blend_mode : '' ) : false;
		$media_overlay    = ( $image_panel ) ? ( ( isset( $settings->media_overlay ) && $settings->media_overlay ) ? '<div class="uk-position-cover" style="background-color: ' . $settings->media_overlay . '"></div>' : '' ) : '';

		$general    =   PageBuilder::general_styles($settings);

		$output = '';

		$output .= '<div class="ukmarker' . $general['container']. $general['class'] . '"' . $general['animation'] . '>';

		$output .= '<div class="uk-inline"' . $media_background . '>';

		if ( $image_marker_src ) {
			$output .= '<img class="ui-image' . $media_blend_mode . '" ' . $data_marker_src . ' ' . $alt_text_init . '>';
			$output .= $media_overlay;
		}

		$output .= '<div class="tz-popover-items' . ( $mobile_switcher ? ' uk-visible@s' : '' ) . '">';
		if ( isset( $settings->ui_list_marker_item ) && count( (array) $settings->ui_list_marker_item ) ) {
			foreach ( $settings->ui_list_marker_item as $key => $item ) {
				$marker_title   = ( isset( $item->title ) && $item->title ) ? $item->title : '';
				$marker_meta    = ( isset( $item->marker_meta ) && $item->marker_meta ) ? $item->marker_meta : '';
				$marker_content = ( isset( $item->marker_content ) && $item->marker_content ) ? $item->marker_content : '';
				$marker_type    = ( isset( $item->marker_type ) && $item->marker_type ) ? $item->marker_type : '';

				$button_title = ( isset( $item->button_title ) && $item->button_title ) ? $item->button_title : '';
				if ( empty( $button_title ) ) {
					$button_title .= $all_button_title;
				}

				$title_link = ( isset( $item->link ) && $item->link ) ? $item->link : '';

				$check_target      = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? $settings->link_new_tab : '';
				$render_linkscroll = ( empty( $check_target ) && strpos( $title_link, '#' ) === 0 ) ? ' uk-scroll' : '';

				$image     = ( isset( $item->marker_image ) && $item->marker_image ) ? $item->marker_image : '';
				$image_src = isset( $image->src ) ? $image->src : $image;
                $image_properties   =   false;
				if ( strpos( $image_src, 'http://' ) !== false || strpos( $image_src, 'https://' ) !== false ) {
                    $image_properties   =   getimagesize($image_src);
					$image_src = $image_src;
				} elseif ( $image_src ) {
                    $image_properties   =   getimagesize(JURI::base() . '/' . $image_src);
					$image_src = JURI::base( true ) . '/' . $image_src;
				}
                if (is_array($image_properties) && count($image_properties) > 2) {
                    $data_image_src = 'data-src="' . $image_src . '" data-width="' . $image_properties[0] . '" data-height="' . $image_properties[1] . '" data-uk-img';
                } else {
                    $data_image_src = 'src="' . $image_src . '"';
                }
				$image_alt      = ( isset( $item->marker_image_alt_text ) && $item->marker_image_alt_text ) ? $item->marker_image_alt_text : '';
				$title_alt_text = ( isset( $item->title ) && $item->title ) ? $item->title : '';

				$image_alt_init = ( empty( $image_alt ) ) ? 'alt="' . str_replace( '"', '', $title_alt_text ) . '"' : 'alt="' . str_replace( '"', '', $image_alt ) . '"';

				$left_space = ( isset( $item->left_space ) && $item->left_space ) ? $item->left_space : '50';
				$top_space  = ( isset( $item->top_space ) && $item->top_space ) ? $item->top_space : '50';

				$marker_position = ( isset( $item->marker_position ) && $item->marker_position ) ? 'pos: ' . $item->marker_position . ';' : '';

				// Marker Point Image
				$marker_point_image         = ( isset( $item->marker_point_image ) && $item->marker_point_image ) ? $item->marker_point_image : '';
				$marker_point_image_width   = ( isset( $item->marker_point_image_width ) && $item->marker_point_image_width ) ? $item->marker_point_image_width : '';
				$marker_point_image         = isset( $marker_point_image->src ) ? $marker_point_image->src : $marker_point_image;
				$marker_point_image_properties   =   false;
				if ( strpos( $marker_point_image, 'http://' ) !== false || strpos( $marker_point_image, 'https://' ) !== false ) {
					$marker_point_image_properties  =   getimagesize($marker_point_image);
				} elseif ( $marker_point_image ) {
					$marker_point_image_properties  =   getimagesize(JURI::base() . '/' . $marker_point_image);
					$marker_point_image             = JURI::base( true ) . '/' . $marker_point_image;
				}
				if (is_array($marker_point_image_properties) && count($marker_point_image_properties) > 2) {
					$data_marker_point_image_src = 'data-src="' . $marker_point_image . '" data-width="' . $marker_point_image_properties[0] . '" data-height="' . $marker_point_image_properties[1] . '" data-uk-img';
				} else {
					$data_marker_point_image_src = 'src="' . $marker_point_image . '"';
				}
				$data_marker_point_image_src    .=  ' style="width:'.$marker_point_image_width.'px;"';

				if ($marker_type == 'image' && $marker_point_image) {
					$output .= '<a class="ukmarker-item uk-marker-image uk-position-absolute uk-transform-center uk-overflow-hidden uk-border-circle" style="left: ' . $left_space . '%; top: ' . $top_space . '%;" href="#"><img class="ukmarker-image" ' . $data_marker_point_image_src .'></a>';
				} else {
					$output .= '<a class="ukmarker-item uk-position-absolute uk-transform-center" data-uk-marker style="left: ' . $left_space . '%; top: ' . $top_space . '%;" href="#"></a>';
				}

				$output .= $mobile_switcher ? '<div uk-drop="' . $popover_animation . ( $marker_position ? $marker_position : $popover_position ) . $popover_mode . '" ' . $popover_width . '>' : '<div uk-drop="' . $popover_animation . ( $marker_position ? $marker_position : $popover_position ) . $popover_mode . '" ' . $popover_width . '>';

				if ( $panel_link && $title_link ) {
					$output .= ( $image_padding ) ? '<a class="uk-card' . $card . $card_size . ' uk-display-block uk-link-toggle" href="' . $title_link . '"' . $link_target . $render_linkscroll . '>' : '<a class="uk-card' . $card . ' uk-card-body uk-margin-remove-first-child' . $card_size . ' uk-display-block uk-link-toggle" href="' . $title_link . '"' . $link_target . $render_linkscroll . '>';
				} else {
					$output .= ( $image_padding ) ? '<div class="uk-card' . $card . $card_size . '">' : '<div class="uk-card' . $card . ' uk-card-body uk-margin-remove-first-child' . $card_size . '">';
				}

				$output .= ( $image_padding ) ? '<div class="uk-card-media-top">' : '';

				if ( $image_src ) {
					if ( $image_link && $title_link && $panel_link == false ) {
						$output .= ( $title_link ) ? '<a href="' . $title_link . '"' . $link_target . $render_linkscroll . '>' : '';
					}
					$output .= '<img' . $image_width . $image_height . ' class="ui-image uk-margin-auto uk-display-block' . $image_styles_cls . $image_svg_color . '" ' . $data_image_src . ' ' . $image_alt_init . $image_svg_inline_cls . '>';
					if ( $image_link && $title_link && $panel_link == false ) {
						$output .= ( $title_link ) ? '</a>' : '';
					}
				}

				$output .= ( $image_padding ) ? '</div>' : '';

				$output .= ( $image_padding ) ? '<div class="uk-card-body uk-margin-remove-first-child">' : '';

				if ( $meta_alignment == 'top' && $marker_meta ) {
					$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
					$output .= $marker_meta;
					$output .= '</' . $meta_element . '>';
				}

				if ( $marker_title ) {
					$output .= '<' . $heading_selector . ' class="uk-title uk-margin-remove-bottom' . $heading_style . $heading_style_cls_init . $title_decoration . '">';
					$output .= ( $title_decoration == ' uk-heading-line' ) ? '<span>' : '';
					if ( $link_title && $title_link && $panel_link == false ) {
						$output .= '<a' . $link_title_hover . ' href="' . $title_link . '"' . $link_target . $render_linkscroll . '>';
					}
					$output .= $marker_title;
					if ( $link_title && $title_link && $panel_link == false ) {
						$output .= '</a>';
					}
					$output .= ( $title_decoration == ' uk-heading-line' ) ? '</span>' : '';
					$output .= '</' . $heading_selector . '>';
				}

				if ( empty( $meta_alignment ) && $marker_meta ) {
					$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
					$output .= $marker_meta;
					$output .= '</' . $meta_element . '>';
				}

				if ( $meta_alignment == 'above' && $marker_meta ) {
					$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
					$output .= $marker_meta;
					$output .= '</' . $meta_element . '>';
				}

				if ( $marker_content ) {
					$output .= '<div class="ukcontent uk-panel' . $content_style . '">';
					$output .= $marker_content;
					$output .= '</div>';
				}

				if ( $meta_alignment == 'content' && $marker_meta ) {
					$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
					$output .= $marker_meta;
					$output .= '</' . $meta_element . '>';
				}

				if ( $button_title && $title_link ) {
					$output .= '<div class="' . $btn_margin_top . '">';
					if ( $panel_link ) {
						$output .= '<div class="' . $button_style_cls . '">' . $button_title . '</div>';
					} else {
						$output .= '<a class="' . $button_style_cls . '" href="' . $title_link . '"' . $link_target . $render_linkscroll . '>' . $button_title . '</a>';
					}
					$output .= '</div>';
				}

				$output .= ( $image_padding ) ? '</div>' : '';

				if ( $panel_link && $title_link ) {
					$output .= '</a>';
				} else {
					$output .= '</div>';
				}

				$output .= '</div>'; // End Drop.

			}
		}

		$output .= '</div>';

		$output .= '</div>';

		if ( $mobile_switcher ) {

			$output .= '<div class="tz-popover-items uk-margin uk-hidden@s">';
			$output .= '<ul id="js-' . $this->addon->id . '" class="uk-switcher">';

			if ( isset( $settings->ui_list_marker_item ) && count( (array) $settings->ui_list_marker_item ) ) {
				foreach ( $settings->ui_list_marker_item as $key => $item ) {
					$output        .= '<li>';
					$marker_title   = ( isset( $item->title ) && $item->title ) ? $item->title : '';
					$marker_meta    = ( isset( $item->marker_meta ) && $item->marker_meta ) ? $item->marker_meta : '';
					$marker_content = ( isset( $item->marker_content ) && $item->marker_content ) ? $item->marker_content : '';

					$button_title = ( isset( $item->button_title ) && $item->button_title ) ? $item->button_title : '';
					if ( empty( $button_title ) ) {
						$button_title .= $all_button_title;
					}

					$title_link = ( isset( $item->link ) && $item->link ) ? $item->link : '';

					$check_target      = ( isset( $settings->link_new_tab ) && $settings->link_new_tab ) ? $settings->link_new_tab : '';
					$render_linkscroll = ( empty( $check_target ) && strpos( $title_link, '#' ) === 0 ) ? ' uk-scroll' : '';

					$image     = ( isset( $item->marker_image ) && $item->marker_image ) ? $item->marker_image : '';
					$image_src = isset( $image->src ) ? $image->src : $image;
                    $image_properties   =   false;
                    if ( strpos( $image_src, 'http://' ) !== false || strpos( $image_src, 'https://' ) !== false ) {
                        $image_properties   =   getimagesize($image_src);
                        $image_src = $image_src;
                    } elseif ( $image_src ) {
                        $image_properties   =   getimagesize(JURI::base() . '/' . $image_src);
                        $image_src = JURI::base( true ) . '/' . $image_src;
                    }
                    if (is_array($image_properties) && count($image_properties) > 2) {
                        $data_image_src = 'data-src="' . $image_src . '" data-width="' . $image_properties[0] . '" data-height="' . $image_properties[1] . '" uk-img';
                    } else {
                        $data_image_src = 'src="' . $image_src . '"';
                    }

					$image_alt      = ( isset( $item->marker_image_alt_text ) && $item->marker_image_alt_text ) ? $item->marker_image_alt_text : '';
					$title_alt_text = ( isset( $item->title ) && $item->title ) ? $item->title : '';

					$image_alt_init = ( empty( $image_alt ) ) ? 'alt="' . str_replace( '"', '', $title_alt_text ) . '"' : 'alt="' . str_replace( '"', '', $image_alt ) . '"';

					$left_space = ( isset( $item->left_space ) && $item->left_space ) ? $item->left_space : '50';
					$top_space  = ( isset( $item->top_space ) && $item->top_space ) ? $item->top_space : '50';

					$marker_position = ( isset( $item->marker_position ) && $item->marker_position ) ? 'pos: ' . $item->marker_position . ';' : '';

					if ( $panel_link && $title_link ) {
						$output .= ( $image_padding ) ? '<a class="uk-card' . $card . $card_size . ' uk-display-block uk-link-toggle" href="' . $title_link . '"' . $link_target . $render_linkscroll . '>' : '<a class="uk-card' . $card . ' uk-card-body uk-margin-remove-first-child' . $card_size . ' uk-display-block uk-link-toggle" href="' . $title_link . '"' . $link_target . $render_linkscroll . '>';
					} else {
						$output .= ( $image_padding ) ? '<div class="uk-card' . $card . $card_size . '">' : '<div class="uk-card' . $card . ' uk-card-body uk-margin-remove-first-child' . $card_size . '">';
					}

					$output .= ( $image_padding ) ? '<div class="uk-card-media-top">' : '';

					if ( $image_src ) {
						if ( $image_link && $title_link && $panel_link == false ) {
							$output .= ( $title_link ) ? '<a href="' . $title_link . '"' . $link_target . $render_linkscroll . '>' : '';
						}
						$output .= '<img' . $image_width . $image_height . ' class="ui-image uk-margin-auto uk-display-block' . $image_styles_cls . $image_svg_color . '" ' . $data_image_src . ' ' . $image_alt_init . $image_svg_inline_cls . '>';
						if ( $image_link && $title_link && $panel_link == false ) {
							$output .= ( $title_link ) ? '</a>' : '';
						}
					}

					$output .= ( $image_padding ) ? '</div>' : '';

					$output .= ( $image_padding ) ? '<div class="uk-card-body uk-margin-remove-first-child">' : '';

					if ( $meta_alignment == 'top' && $marker_meta ) {
						$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
						$output .= $marker_meta;
						$output .= '</' . $meta_element . '>';
					}

					if ( $marker_title ) {
						$output .= '<' . $heading_selector . ' class="uk-title uk-margin-remove-bottom' . $heading_style . $heading_style_cls_init . $title_decoration . '">';
						$output .= ( $title_decoration == ' uk-heading-line' ) ? '<span>' : '';
						if ( $link_title && $title_link && $panel_link == false ) {
							$output .= '<a' . $link_title_hover . ' href="' . $title_link . '"' . $link_target . $render_linkscroll . '>';
						}
						$output .= $marker_title;
						if ( $link_title && $title_link && $panel_link == false ) {
							$output .= '</a>';
						}
						$output .= ( $title_decoration == ' uk-heading-line' ) ? '</span>' : '';
						$output .= '</' . $heading_selector . '>';
					}

					if ( empty( $meta_alignment ) && $marker_meta ) {
						$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
						$output .= $marker_meta;
						$output .= '</' . $meta_element . '>';
					}

					if ( $meta_alignment == 'above' && $marker_meta ) {
						$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
						$output .= $marker_meta;
						$output .= '</' . $meta_element . '>';
					}

					if ( $marker_content ) {
						$output .= '<div class="ukcontent uk-panel' . $content_style . '">';
						$output .= $marker_content;
						$output .= '</div>';
					}

					if ( $meta_alignment == 'content' && $marker_meta ) {
						$output .= '<' . $meta_element . ' class="ui-meta' . $meta_style . '">';
						$output .= $marker_meta;
						$output .= '</' . $meta_element . '>';
					}

					if ( $button_title && $title_link ) {
						$output .= '<div class="' . $btn_margin_top . '">';
						if ( $panel_link ) {
							$output .= '<div class="' . $button_style_cls . '">' . $button_title . '</div>';
						} else {
							$output .= '<a class="' . $button_style_cls . '" href="' . $title_link . '"' . $link_target . $render_linkscroll . '>' . $button_title . '</a>';
						}
						$output .= '</div>';
					}

					$output .= ( $image_padding ) ? '</div>' : '';

					if ( $panel_link && $title_link ) {
						$output .= '</a>';
					} else {
						$output .= '</div>';
					}

					$output .= '</li>';
				}
			}

			$output .= '</ul>';

			$output .= '<ul uk-switcher="connect: #js-' . $this->addon->id . ';' . $popover_animation . '" class="uk-dotnav uk-flex-center uk-margin">';
			if ( isset( $settings->ui_list_marker_item ) && count( (array) $settings->ui_list_marker_item ) ) {
				foreach ( $settings->ui_list_marker_item as $key => $item ) {
					$output .= '<li><a href="#"></a></li>';
				}
			}

			$output .= '</ul>';

			$output .= '</div>';

		}

		$output .= '</div>';

		return $output;
	}
	public function css() {
		$settings           = $this->addon->settings;
		$addon_id           = '#sppb-addon-' . $this->addon->id;
		$title_color        = ( isset( $settings->title_color ) && $settings->title_color ) ? $settings->title_color : '';
		$custom_title_color = ( isset( $settings->custom_title_color ) && $settings->custom_title_color ) ? 'color: ' . $settings->custom_title_color . ';' : '';
		$meta_color         = ( isset( $settings->meta_color ) && $settings->meta_color ) ? $settings->meta_color : '';
		$custom_meta_color  = ( isset( $settings->custom_meta_color ) && $settings->custom_meta_color ) ? 'color: ' . $settings->custom_meta_color . ';' : '';
		$content_color      = ( isset( $settings->content_color ) && $settings->content_color ) ? 'color: ' . $settings->content_color . ';' : '';
		$button_style       = ( isset( $settings->link_button_style ) && $settings->link_button_style ) ? $settings->link_button_style : '';
		$button_background  = ( isset( $settings->button_background ) && $settings->button_background ) ? 'background-color: ' . $settings->button_background . ';' : '';
		$button_color       = ( isset( $settings->button_color ) && $settings->button_color ) ? 'color: ' . $settings->button_color . ';' : '';

		$button_background_hover = ( isset( $settings->button_background_hover ) && $settings->button_background_hover ) ? 'background-color: ' . $settings->button_background_hover . ';' : '';
		$button_hover_color      = ( isset( $settings->button_hover_color ) && $settings->button_hover_color ) ? 'color: ' . $settings->button_hover_color . ';' : '';

		$marker_background = ( isset( $settings->marker_background ) && $settings->marker_background ) ? 'background-color: ' . $settings->marker_background . ';' : '';
		$marker_color      = ( isset( $settings->marker_color ) && $settings->marker_color ) ? 'color: ' . $settings->marker_color . ';' : '';

		$css = '';
		if ( empty( $title_color ) && $custom_title_color ) {
			$css .= $addon_id . ' .uk-title {' . $custom_title_color . '}';
		}
		if ( empty( $meta_color ) && $custom_meta_color ) {
			$css .= $addon_id . ' .ui-meta {' . $custom_meta_color . '}';
		}
		if ( $content_color ) {
			$css .= $addon_id . ' .ukcontent {' . $content_color . '}';
		}
		if ( $marker_background || $marker_color ) {
			$css .= $addon_id . ' .uk-marker {' . $marker_background . $marker_color . '}';
		}
		if ( $button_style == 'custom' ) {
			if ( $button_background || $button_color ) {
				$css .= $addon_id . ' .uk-button-custom {' . $button_background . $button_color . '}';
			}
			if ( $button_background_hover || $button_hover_color ) {
				$css .= $addon_id . ' .uk-button-custom:hover, ' . $addon_id . ' .uk-button-custom:focus, ' . $addon_id . ' .uk-button-custom:active, ' . $addon_id . ' .uk-button-custom.uk-active {' . $button_background_hover . $button_hover_color . '}';
			}
		}

		return $css;
	}
}
