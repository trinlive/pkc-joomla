<?php
/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2022 Jollyany
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined ('_JEXEC') or die ('Restricted access');
use Jollyany\Helper\PageBuilder;
class SppagebuilderAddonUKContent extends SppagebuilderAddons {

	public function render() {
        
        $settings = $this->addon->settings;
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';

        $column_gutter  = (isset($settings->column_gutter) && $settings->column_gutter) ? ' uk-grid-column-'.$settings->column_gutter : '';
        $row_gutter     = (isset($settings->row_gutter) && $settings->row_gutter) ? ' uk-grid-row-'.$settings->row_gutter : '';
        $column_divider = (isset($settings->column_divider)) ? $settings->column_divider : 0;
        $column_divider = $column_divider ? ' uk-grid-divider' : '';
        $column_width   = (isset($settings->column_width) && $settings->column_width) ? ' uk-child-width-'.$settings->column_width : ' uk-child-width-1-1';
        $column_width   .= (isset($settings->column_width_xl) && $settings->column_width_xl) ? ' uk-child-width-'.$settings->column_width_xl.'@xl' : ' uk-child-width-1-3@xl';
        $column_width   .= (isset($settings->column_width_l) && $settings->column_width_l) ? ' uk-child-width-'.$settings->column_width_l.'@l' : ' uk-child-width-1-3@l';
        $column_width   .= (isset($settings->column_width_m) && $settings->column_width_m) ? ' uk-child-width-'.$settings->column_width_m.'@m' : ' uk-child-width-1-2@m';
        $column_width   .= (isset($settings->column_width_s) && $settings->column_width_s) ? ' uk-child-width-'.$settings->column_width_s.'@s' : ' uk-child-width-1-2@s';

        //Card Style
        $card_style     = (isset($settings->card_style) && $settings->card_style) ? ' uk-card-'.$settings->card_style : '';
        $grid_match     = (isset($settings->grid_match)) ? $settings->grid_match : 0;
        $card_hover     = (isset($settings->card_hover)) ? $settings->card_hover : 0;
        $card_style     .= $card_hover ? ' uk-card-hover' : '';

        $card_size      = (isset($settings->card_size) && $settings->card_size) ? ' uk-card-body uk-card-'.$settings->card_size : ' uk-card-body';
        $card_border_radius      = (isset($settings->card_border_radius) && $settings->card_border_radius) ? ' uk-border-'.$settings->card_border_radius : '';
        $card_size      = (isset($settings->card_size) && $settings->card_size == 'none') ? '' : $card_size;

        $enable_image_cover = (isset($settings->enable_image_cover)) ? $settings->enable_image_cover : 0;
        $enable_image_svg   = (isset($settings->enable_image_svg)) ? $settings->enable_image_svg : 0;
        $min_height     = (isset($settings->min_height) && $settings->min_height) ? $settings->min_height : 400;
        $preserve       = ( isset( $settings->preserve ) && $settings->preserve ) ? $settings->preserve : 0;

        $svg_size     = '';
        $svg_size     .= ( isset( $settings->svg_width ) && $settings->svg_width ) ? ' width="' . $settings->svg_width . '"' : '';
        $svg_size     .= ( isset( $settings->svg_height ) && $settings->svg_height ) ? ' height="' . $settings->svg_height . '"' : '';

        //Media Option
        $media_position = (isset($settings->media_position) && $settings->media_position) ? $settings->media_position : 'top';
        $icon_size      = (isset($settings->icon_size) && $settings->icon_size) ? $settings->icon_size : 60;
        $media_vertical_align    = (isset($settings->media_vertical_align) && $settings->media_vertical_align) ? ' uk-flex-'.$settings->media_vertical_align : ' uk-flex-middle';
        $image_width    = (isset($settings->media_width) && $settings->media_width) ? ' uk-width-'.$settings->media_width : ' uk-width-1-2';
        $image_width_xl = (isset($settings->media_width_xl) && $settings->media_width_xl) ? ' uk-width-'.$settings->media_width_xl.'@xl' : ' uk-width-1-2@xl';
        $image_width_l  = (isset($settings->media_width_l) && $settings->media_width_l) ? ' uk-width-'.$settings->media_width_l.'@l' : ' uk-width-1-2@l';
        $image_width_m  = (isset($settings->media_width_m) && $settings->media_width_m) ? ' uk-width-'.$settings->media_width_m.'@m' : ' uk-width-1-2@m';
        $image_width_s  = (isset($settings->media_width_s) && $settings->media_width_s) ? ' uk-width-'.$settings->media_width_s.'@s' : ' uk-width-1-2@s';
        $expand_width   = $image_width_xl == ' uk-width-1-1@xl' ? ' uk-width-1-1@xl' : ' uk-width-expand@xl';
        $expand_width   .=$image_width_l == ' uk-width-1-1@l' ? ' uk-width-1-1@l' : ' uk-width-expand@l';
        $expand_width   .=$image_width_m == ' uk-width-1-1@m' ? ' uk-width-1-1@m' : ' uk-width-expand@m';
        $expand_width   .=$image_width_s == ' uk-width-1-1@s' ? ' uk-width-1-1@s' : ' uk-width-expand@s';
        $expand_width   .=$image_width == ' uk-width-1-1' ? ' uk-width-1-1' : ' uk-width-expand';

        // Text Options
        $text_color     = (isset($settings->text_color) && $settings->text_color) ? ' uk-text-'. $settings->text_color : '';
        $title_heading_selector = (isset($settings->title_heading_selector) && $settings->title_heading_selector) ? $settings->title_heading_selector : 'h3';
        $meta_heading_selector = (isset($settings->meta_heading_selector) && $settings->meta_heading_selector) ? $settings->meta_heading_selector : 'div';
        $link_title     = (isset($settings->link_title)) ? $settings->link_title : 0;
        $meta_position  = (isset($settings->meta_position)) ? $settings->meta_position : 'before';
        $enable_button  = (isset($settings->enable_button)) ? $settings->enable_button : 0;

        // Button
        $button_text    = (isset($settings->button_text) && $settings->button_text) ? $settings->button_text : 'Read more';
        $button_margin  = (isset($settings->button_margin) && $settings->button_margin) ? ' uk-margin-'. $settings->button_margin : 'uk-margin';
        $button_type    = (isset($settings->button_type) && $settings->button_type) ? ' uk-button-'. $settings->button_type : ' uk-button-default';
        $button_border_radius    = (isset($settings->button_border_radius) && $settings->button_border_radius) ? ' uk-border-'. $settings->button_border_radius : '';
        $button_full_width     = (isset($settings->button_full_width)) ? $settings->button_full_width : 0;
        $button_type    .= $button_full_width ? ' uk-width-1-1' : '';

        $general        =   PageBuilder::general_styles($settings);
		//Output
		$output  = '<div class="ukcontent ' . $general['container'] . '"' . $general['animation'] . '>';
		$output .= '<div class="' . $general['class'] . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="ukcontent-container">';

		//Tab Title
		$output .='<div class="ukcontent-items'.$column_width.$column_gutter.$row_gutter.$column_divider.($grid_match ? ' uk-grid-match' : '').'" data-uk-grid>';
		foreach ($settings->ukcontent_items as $key => $item) {
            $media_type = ( isset( $item->media_type ) && $item->media_type ) ? $item->media_type : 'icon';
            $icon_type  = ( isset( $item->icon_type ) && $item->icon_type ) ? $item->icon_type : 'uikit';
            $uikit_icon = ( isset( $item->uikit_icon ) && $item->uikit_icon ) ? $item->uikit_icon : '';
            $fa_icon    = ( isset( $item->fontawesome_icon ) && $item->fontawesome_icon ) ? $item->fontawesome_icon : '';
            $linearicon = ( isset( $item->linearicon ) && $item->linearicon ) ? 'lnr '. $item->linearicon : '';
            $custom_icon    = ( isset( $item->custom_icon ) && $item->custom_icon ) ? $item->custom_icon : '';
            $image      = ( isset( $item->image ) && $item->image ) ? $item->image : '';
            $title      = ( isset( $item->title ) && $item->title ) ? $item->title : '';
            $meta       = ( isset( $item->meta ) && $item->meta ) ? $item->meta : '';
            $content    = ( isset( $item->content ) && $item->content ) ? $item->content : '';
            $link       = ( isset( $item->link ) && $item->link ) ? $item->link : '';
            $link_text  = ( isset( $item->link_text ) && $item->link_text ) ? $item->link_text : $button_text;
            $image_src  = isset( $image->src ) ? $image->src : $image;

            $media_content = '';
            if ($media_type == 'icon') {
                if ($icon_type == 'uikit' && $uikit_icon) {
                    $media_content  .=  '<span data-uk-icon="icon: '.$uikit_icon.'; width: '.$icon_size.'"></span>';
                } elseif ($icon_type == 'fontawesome' && $fa_icon) {
                    $media_content  .= '<span class="sppb-icon-inner">';
                    $icon_arr = array_filter(explode(' ', $fa_icon));
                    if (count($icon_arr) === 1) {
                        $fa_icon = 'fa ' . $fa_icon;
                    }
                    $media_content  .= '<i class="' . $fa_icon . '" aria-hidden="true"></i>';
                    $media_content  .= '</span>';
                } elseif ($icon_type == 'linearicon' && $linearicon) {
                    $media_content  .= '<span class="sppb-icon-inner">';
                    $media_content  .= '<i class="' . $linearicon . '" aria-hidden="true"></i>';
                    $media_content  .= '</span>';
                } elseif ($custom_icon) {
                    $media_content  .= '<span class="sppb-icon-inner">';
                    $media_content  .= '<i class="' . $custom_icon . '" aria-hidden="true"></i>';
                    $media_content  .= '</span>';
                }
            } elseif ($media_type == 'image') {
                if ( strpos( $image_src, 'http://' ) !== false || strpos( $image_src, 'https://' ) !== false ) {
                    $image_src = $image_src;
                } elseif ( $image_src ) {
                    $image_src = JURI::base( true ) . '/' . $image_src;
                }
                $media_content  .=  '<img class="ui-image'.($preserve ? ' uk-preserve' : '').'" src="' . $image_src . '" alt="'.$title.'"'.$svg_size.($enable_image_cover ? ' data-uk-cover' : '').($enable_image_svg ? ' data-uk-svg' : '').'>';
            }

            // Grid Begin
            $output .= '<div>';

            // Card Begin
            $output .= '<div class="uk-card'.$card_style.$card_border_radius.'">';
            if ($media_position == 'left' || $media_position == 'right') {
                $output .=  '<div class="uk-grid-small'.$media_vertical_align.'" data-uk-grid>';
            }
			if ($media_position != 'inside') {
				// Media Begin
				$output .=  '<div class="ukcontent-media uk-card-media-'.$media_position.($enable_image_cover && $media_type == 'image' ? ' uk-cover-container' : '').($media_position == 'left' || $media_position == 'right' ? ' uk-cover-container'.$image_width_xl.$image_width_l.$image_width_m.$image_width_s.$image_width : '').($media_position == 'right' || $media_position == 'bottom' ? ' uk-flex-last' : '').'"'.($enable_image_cover && $media_type == 'image' ? ' style="min-height: '.$min_height.'px;"' : '').'>';
                if ($link) {
                    $output .=  '<a href="'.$link.'" class="uk-link-reset">';
                }
				$output .= $media_content;
				if (($media_position == 'left' || $media_position == 'right') && $media_type == 'image' && $enable_image_cover) {
					$output .=  '<canvas width="600" height="400"></canvas>';
				}
                if ($link) {
                    $output .=  '</a>';
                }
				$output .=  '</div>';
				// End Media
			}

            // Content
            $output .= '<div class="ukcontent-detail'.(($media_position == 'left' || $media_position == 'right') ? $expand_width : '') . ($enable_image_cover && ($media_position != 'left' && $media_position != 'right') ? ' uk-position-medium uk-position-center uk-text-center' : '').'">';
            $output .= '<div class="'.$card_size.'">';
			if ($media_position == 'inside') {
				// Media Inside
				$output .=  '<div class="ukcontent-media uk-card-media-'.$media_position.'">';
                if ($link) {
                    $output .=  '<a href="'.$link.'" class="uk-link-reset">';
                }
				$output .= $media_content;
                if ($link) {
                    $output .=  '</a>';
                }
				$output .=  '</div>';
			}
            if ($meta_position == 'before' && $meta) {
                $output .= '<'.$meta_heading_selector.' class="uk-meta">'. $meta .'</'.$meta_heading_selector.'>';
            }
            if ($title) {
                if ($link_title) {
                    $title  =   '<a href="'.$link.'" class="uk-link-reset">'.$title.'</a>';
                }
                $output .= '<'.$title_heading_selector.' class="uk-title uk-card-title">'.$title.'</'.$title_heading_selector.'>';
            }
            if ($meta_position == 'after' && $meta) {
                $output .= '<'.$meta_heading_selector.' class="uk-meta">'. $meta .'</'.$meta_heading_selector.'>';
            }
            if ($content) {
                $output .= '<div class="uk-desc uk-margin-remove'.$text_color.'">'.$content.'</div>';
            }
            if (!empty($link) && $enable_button) {
                $output .= '<div class="'.$button_margin.'-top"><a class="uk-button'.$button_type.$button_border_radius.'" href="'.$link.'">'.$link_text.'</a></div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            // End Content

            if ($media_position == 'left' || $media_position == 'right') {
                $output .=  '</div>';
            }
            $output .= '</div>';
            // Card End

            $output .= '</div>';
            // Grid End
		}
		$output .='</div>';

		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}

	public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $settings               = $this->addon->settings;
        $card_style             = ( isset( $settings->card_style ) && $settings->card_style ) ? $settings->card_style : '';

        // Custom Card
        $card_custom_background = ( isset( $settings->card_custom_background ) && $settings->card_custom_background ) ? ' background-color: '. $settings->card_custom_background .';' : '';
        $card_custom_color      = ( isset( $settings->card_custom_color ) && $settings->card_custom_color ) ? ' color: '. $settings->card_custom_color .';' : '';
        $card_custom_border_color      = ( isset( $settings->card_custom_border_color ) && $settings->card_custom_border_color ) ? ' border-color: '. $settings->card_custom_border_color .';' : '';
        $card_custom_border_width      = ( isset( $settings->card_custom_border_width ) && $settings->card_custom_border_width ) ? ' border-width: '. $settings->card_custom_border_width .'px;' : '';
        $card_custom_border_style      = ( isset( $settings->card_custom_border_style ) && $settings->card_custom_border_style ) ? ' border-style: '. $settings->card_custom_border_style .';' : '';

        // Custom Card Hover
        $card_custom_background_hover = ( isset( $settings->card_custom_background_hover ) && $settings->card_custom_background_hover ) ? ' background-color: '. $settings->card_custom_background_hover .';' : '';
        $card_custom_color_hover      = ( isset( $settings->card_custom_color_hover ) && $settings->card_custom_color_hover ) ? ' color: '. $settings->card_custom_color_hover .';' : '';
        $card_custom_border_color_hover      = ( isset( $settings->card_custom_border_color_hover ) && $settings->card_custom_border_color_hover ) ? ' border-color: '. $settings->card_custom_border_color_hover .';' : '';
        $card_custom_border_width_hover      = ( isset( $settings->card_custom_border_width_hover ) && $settings->card_custom_border_width_hover ) ? ' border-width: '. $settings->card_custom_border_width_hover .'px;' : '';
        $card_custom_border_style_hover      = ( isset( $settings->card_custom_border_style_hover ) && $settings->card_custom_border_style_hover ) ? ' border-style: '. $settings->card_custom_border_style_hover .';' : '';

        $icon_color             = ( isset( $settings->icon_color ) && $settings->icon_color ) ? ' color: '. $settings->icon_color .';' : '';
        $icon_color_hover       = ( isset( $settings->icon_color_hover ) && $settings->icon_color_hover ) ? ' color: '. $settings->icon_color_hover .';' : '';
        $icon_size              = (isset($settings->icon_size) && $settings->icon_size) ? $settings->icon_size : 60;
        $enable_stroke_text     = (isset($settings->enable_stroke_text)) ? $settings->enable_stroke_text : 0;
        $image_overlay_color    = ( isset( $settings->image_overlay_color ) && $settings->image_overlay_color ) ? ' background-color: '. $settings->image_overlay_color .';' : '';
        $preserve               = ( isset( $settings->preserve ) && $settings->preserve ) ? $settings->preserve : 0;
        $fill_color             = ( isset( $settings->color ) && $settings->color ) ? 'fill: ' . $settings->color . ';' : '';

        $css    =   '';

        if ($card_style == 'custom') {
            $css .= $addon_id . ' .uk-card {';
            $css .= 'transition: all 0.1s ease-in-out;';
            $css .= $card_custom_background.$card_custom_color;
            if ($card_custom_border_width || $card_custom_border_style || $card_custom_border_color) {
                $css .= $card_custom_border_width . $card_custom_border_style . $card_custom_border_color;
            }
            $css .= '}';

            $css .= $addon_id . ' .uk-card:hover {';
            $css .= $card_custom_background_hover.$card_custom_color_hover;
            if ($card_custom_border_width_hover || $card_custom_border_style_hover || $card_custom_border_color_hover) {
                $css .= $card_custom_border_width_hover . $card_custom_border_style_hover . $card_custom_border_color_hover;
            }
            $css .= '}';
        }

        if($icon_color){
            $css .= $addon_id . ' .ukcontent-media {';
            $css .= $icon_color;
            $css .= '}';
        }

        if($icon_color_hover){
            $css .= $addon_id . ' .ukcontent-detail:hover .ukcontent-media {';
            $css .= $icon_color_hover;
            $css .= '}';
        }

        if ($icon_size) {
            $css .= $addon_id . ' .ukcontent-media .sppb-icon-inner > i{';
            $css .= 'font-size: ' . $icon_size . 'px;';
            $css .= '}';
        }

        if ($image_overlay_color) {
            $css .= $addon_id . ' .ukcontent-media::after {';
            $css .= 'content:""; position: absolute; top: 0; left: 0; right: 0; bottom: 0;';
            $css .= $image_overlay_color;
            $css .= '}';
        }

        if ( $preserve && $fill_color ) {
            $css .= $addon_id . ' .uk-svg *{' . $fill_color . '}';
        }

        //Title style
        $title_style = '';
        $title_style .= (isset($settings->title_text_color) && $settings->title_text_color) ? 'color:'.$settings->title_text_color . ';' : '';
        if ($enable_stroke_text) {
            $title_style .= 'transition: all 0.3s ease;';
            $title_style .= (isset($settings->title_text_color) && $settings->title_text_color) ? '-webkit-text-fill-color: transparent;-webkit-text-stroke-color:'.$settings->title_text_color . ';' : '';
            $title_style .= (isset($settings->title_stroke_width) && $settings->title_stroke_width) ? '-webkit-text-stroke-width:'.$settings->title_stroke_width . 'px;' : '';
        }
        if (isset($settings->title_fontsize->md)) $settings->title_fontsize = $settings->title_fontsize->md;
        $title_style .= (isset($settings->title_fontsize) && $settings->title_fontsize) ? 'font-size:'.$settings->title_fontsize . 'px;' : '';
        if (isset($settings->title_lineheight->md)) $settings->title_lineheight = $settings->title_lineheight->md;
        $title_style .= (isset($settings->title_lineheight) && $settings->title_lineheight) ? 'line-height:'.$settings->title_lineheight . 'px;' : '';
        $title_style .= (isset($settings->title_letterspace) && $settings->title_letterspace) ? 'letter-spacing:'.$settings->title_letterspace . ';' : '';
        if (isset($settings->title_margin_top->md)) $settings->title_margin_top = $settings->title_margin_top->md;
        $title_style .= (isset($settings->title_margin_top)) ? 'margin-top:'.$settings->title_margin_top . 'px;' : '';
        if (isset($settings->title_margin_bottom->md)) $settings->title_margin_bottom = $settings->title_margin_bottom->md;
        $title_style .= (isset($settings->title_margin_bottom)) ? 'margin-bottom:'.$settings->title_margin_bottom . 'px;' : '';
        $title_font_style = (isset($settings->title_font_style) && $settings->title_font_style) ? $settings->title_font_style : '';
        if(isset($title_font_style->underline) && $title_font_style->underline){
            $title_style .= 'text-decoration:underline;';
        }
        if(isset($title_font_style->italic) && $title_font_style->italic){
            $title_style .= 'font-style:italic;';
        }
        if(isset($title_font_style->uppercase) && $title_font_style->uppercase){
            $title_style .= 'text-transform:uppercase;';
        }
        if(isset($title_font_style->weight) && $title_font_style->weight){
            $title_style .= 'font-weight:'.$title_font_style->weight.';';
        }
        if($title_style){
            $css .= $addon_id . ' .uk-title {';
            $css .= $title_style;
            $css .= '}';
        }

        if ($enable_stroke_text) {
            $css .= $addon_id . ' .uk-title:hover {';
            $css .= (isset($settings->title_text_color) && $settings->title_text_color) ? 'color:'.$settings->title_text_color . ';-webkit-text-fill-color: '.$settings->title_text_color . ';' : '';
            $css .= '}';
        }

        //Meta style
        $meta_style = '';
        $meta_style .= (isset($settings->meta_text_color) && $settings->meta_text_color) ? 'color:'.$settings->meta_text_color . ';' : '';
        if (isset($settings->meta_fontsize->md)) $settings->meta_fontsize = $settings->meta_fontsize->md;
        $meta_style .= (isset($settings->meta_fontsize) && $settings->meta_fontsize) ? 'font-size:'.$settings->meta_fontsize . 'px;' : '';
        if (isset($settings->meta_lineheight->md)) $settings->meta_lineheight = $settings->meta_lineheight->md;
        $meta_style .= (isset($settings->meta_lineheight) && $settings->meta_lineheight) ? 'line-height:'.$settings->meta_lineheight . 'px;' : '';
        $meta_style .= (isset($settings->meta_letterspace) && $settings->meta_letterspace) ? 'letter-spacing:'.$settings->meta_letterspace . ';' : '';
        if (isset($settings->meta_margin_top->md)) $settings->meta_margin_top = $settings->meta_margin_top->md;
        $meta_style .= (isset($settings->meta_margin_top)) ? 'margin-top:'.$settings->meta_margin_top . 'px;' : '';
        if (isset($settings->meta_margin_bottom->md)) $settings->meta_margin_bottom = $settings->meta_margin_bottom->md;
        $meta_style .= (isset($settings->meta_margin_bottom)) ? 'margin-bottom:'.$settings->meta_margin_bottom . 'px;' : '';
        $meta_font_style = (isset($settings->meta_font_style) && $settings->meta_font_style) ? $settings->meta_font_style : '';
        if(isset($meta_font_style->underline) && $meta_font_style->underline){
            $meta_style .= 'text-decoration:underline;';
        }
        if(isset($meta_font_style->italic) && $meta_font_style->italic){
            $meta_style .= 'font-style:italic;';
        }
        if(isset($meta_font_style->uppercase) && $meta_font_style->uppercase){
            $meta_style .= 'text-transform:uppercase;';
        }
        if(isset($meta_font_style->weight) && $meta_font_style->weight){
            $meta_style .= 'font-weight:'.$meta_font_style->weight.';';
        }
        if($meta_style){
            $css .= $addon_id . ' .uk-meta {';
            $css .= $meta_style;
            $css .= '}';
        }

        $style = (isset($settings->custom_text_color) && $settings->custom_text_color) ? "color: " . $settings->custom_text_color . ";" : "";
        $style .= (isset($settings->text_fontweight) && $settings->text_fontweight) ? "font-weight: " . $settings->text_fontweight . ";" : "";

        $style .= (isset($settings->text_fontsize) && $settings->text_fontsize) ? "font-size: " . $settings->text_fontsize . "px;" : "";
        $style_sm = (isset($settings->text_fontsize_sm) && $settings->text_fontsize_sm) ? "font-size: " . $settings->text_fontsize_sm . "px;" : "";
        $style_xs = (isset($settings->text_fontsize_xs) && $settings->text_fontsize_xs) ? "font-size: " . $settings->text_fontsize_xs . "px;" : "";

        $style .= (isset($settings->text_lineheight) && $settings->text_lineheight) ? "line-height: " . $settings->text_lineheight . "px;" : "";
        $style_sm .= (isset($settings->text_lineheight_sm) && $settings->text_lineheight_sm) ? "line-height: " . $settings->text_lineheight_sm . "px;" : "";
        $style_xs .= (isset($settings->text_lineheight_xs) && $settings->text_lineheight_xs) ? "line-height: " . $settings->text_lineheight_xs . "px;" : "";

        $title_style_sm     = (isset($settings->title_fontsize_sm) && $settings->title_fontsize_sm) ? 'font-size:'.$settings->title_fontsize_sm . 'px;' : '';
        $title_style_sm     .= (isset($settings->title_lineheight_sm) && $settings->title_lineheight_sm) ? 'line-height:'.$settings->title_lineheight_sm . 'px;' : '';
        $title_style_sm     .= (isset($settings->title_margin_top_sm)) ? 'margin-top:'.$settings->title_margin_top_sm . 'px;' : '';
        $title_style_sm     .= (isset($settings->title_margin_bottom_sm)) ? 'margin-bottom:'.$settings->title_margin_bottom_sm . 'px;' : '';

        if($style){
            $css .= $addon_id . ' .uk-desc { ' . $style . ' }';
        }

        $css .= '@media (min-width: 768px) and (max-width: 991px) {';
        if ($title_style_sm) {
            $css .= $addon_id . ' .uk-title {';
            $css .= $title_style_sm;
            $css .= '}';
        }
        if($style_sm){
            $css .= $addon_id . ' .uk-desc {';
            $css .= $style_sm;
            $css .= '}';
        }
        $css .='}';

        $title_style_xs     = (isset($settings->title_fontsize_xs) && $settings->title_fontsize_xs) ? 'font-size:'.$settings->title_fontsize_xs . 'px;' : '';
        $title_style_xs     .= (isset($settings->title_lineheight_xs) && $settings->title_lineheight_xs) ? 'line-height:'.$settings->title_lineheight_xs . 'px;' : '';
        $title_style_xs     .= (isset($settings->title_margin_top_xs)) ? 'margin-top:'.$settings->title_margin_top_xs . 'px;' : '';
        $title_style_xs     .= (isset($settings->title_margin_bottom_xs)) ? 'margin-bottom:'.$settings->title_margin_bottom_xs . 'px;' : '';

        $css .= '@media (max-width: 767px) {';
        if ($title_style_xs) {
            $css .= $addon_id . ' .uk-title {';
            $css .= $title_style_xs;
            $css .= '}';
        }
        if($style_xs){
            $css .= $addon_id . ' .uk-desc { ' . $style_xs . ' }';
        }
        $css .= '}';

		return $css;
	}
}