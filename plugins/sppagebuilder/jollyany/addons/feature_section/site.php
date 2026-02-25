<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2020 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonFeature_Section extends SppagebuilderAddons{

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';

		//Options
		$image = (isset($settings->image) && $settings->image) ? $settings->image : '';
		$image_src = isset($image->src) ? $image->src : $image;
		$image_alignment = (isset($settings->image_alignment) && $settings->image_alignment) ? $settings->image_alignment : '';
		$image_size = (isset($settings->image_size) && $settings->image_size) ? $settings->image_size : 'cover';
		$image_width = (isset($settings->image_width) && $settings->image_width) ? $settings->image_width : '6';
		$text = (isset($settings->text) && $settings->text) ? $settings->text : '';
		$button_text = (isset($settings->button_text) && $settings->button_text) ? $settings->button_text : '';
		$button_url = (isset($settings->button_url) && $settings->button_url) ? $settings->button_url : '';
		$button_classes = (isset($settings->button_size) && $settings->button_size) ? ' sppb-btn-' . $settings->button_size : '';
		$button_classes .= (isset($settings->button_type) && $settings->button_type) ? ' sppb-btn-' . $settings->button_type : '';
		$button_classes .= (isset($settings->button_shape) && $settings->button_shape) ? ' sppb-btn-' . $settings->button_shape: ' sppb-btn-rounded';
		$button_classes .= (isset($settings->button_appearance) && $settings->button_appearance) ? ' sppb-btn-' . $settings->button_appearance : '';
		$button_classes .= (isset($settings->button_block) && $settings->button_block) ? ' ' . $settings->button_block : '';
		$button_icon = (isset($settings->button_icon) && $settings->button_icon) ? $settings->button_icon : '';
		$button_icon_position = (isset($settings->button_icon_position) && $settings->button_icon_position) ? $settings->button_icon_position: 'left';
		$button_position = (isset($settings->button_position) && $settings->button_position) ? $settings->button_position : '';
		$button_attribs = (isset($settings->button_target) && $settings->button_target) ? ' rel="noopener noreferrer" target="' . $settings->button_target . '"' : '';
		$button_attribs .= (isset($settings->button_url) && $settings->button_url) ? ' href="' . $settings->button_url . '"' : '';

		$icon_arr = array_filter(explode(' ', $button_icon));
		if (count($icon_arr) === 1) {
			$button_icon = 'fa ' . $button_icon;
		}

		if($button_icon_position == 'left') {
			$button_text = ($button_icon) ? '<i class="' . $button_icon . '" aria-hidden="true"></i> ' . $button_text : $button_text;
		} else {
			$button_text = ($button_icon) ? $button_text . ' <i class="' . $button_icon . '" aria-hidden="true"></i>' : $button_text;
		}

		$button_output = !empty($button_text) ? '<a' . $button_attribs . ' id="btn-'. $this->addon->id .'" class="sppb-btn' . $button_classes . '">' . $button_text . '</a>' : '';

		if($image_src && $text) {

			$output  = '';

			//Content
			$output .= '<div class="feature-section image-'.$image_alignment.'">';
			$output .= $image_size == 'cover' ? '<div class="row">' : '<div class="row align-items-center">';
			$image_content  =   '';
            $image_content .= '<div class="col-lg-'.$image_width.'">';
            //Image
            $image_src = (strpos($image_src, 'http://') !== false || strpos($image_src, 'https://') !== false) ? $image_src : JURI::base(true) . '/' . $image_src;
            if ($image_size == 'cover') {
                $image_content .= '<div class="sppb-image-holder" style="background-image: url(' . $image_src . ');" role="img" aria-label="'. strip_tags($title) .'"></div>';
            } else {
                $image_content .= '<div class="sppb-image-responsive"><img src="'.$image_src.'" /></div>';
            }
            $image_content .= '</div>';
            $content    =   '';
            $content .= '<div class="col-lg-'.(12-$image_width).'">';
            $content .= '<div class="sppb-content-holder">';
            $content .= ($title) ? '<'.$heading_selector.' class="sppb-image-content-title sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
            $content .= ($text) ? '<p class="sppb-image-content-text">' . $text . '</p>' : '';

            $content .= $button_output;

            $content .= '</div>';
            $content .= '</div>';
            if($image_alignment=='left') {
                $output .= $image_content.$content;
            } else {
                $output .= $content.$image_content;
            }
			$output .= '</div>';

			$output .= '</div>';
			return $output;
		}

		return;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css_path = new JLayoutFile('addon.css.button', $layout_path);
		$settings = $this->addon->settings;
		$css = '';
		$padding = (isset($settings->content_padding)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_padding, 'padding') : '';
		$padding_sm = (isset($settings->content_padding_sm)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_padding_sm, 'padding') : '';
		$padding_xs = (isset($settings->content_padding_xs)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_padding_xs, 'padding') : '';

		
		$css .= (!empty($padding)) ? $addon_id .' .feature-section .sppb-content-holder{'.$padding.'}' : '';
		$css .= (!empty($padding_sm)) ? '@media (min-width: 768px) and (max-width: 991px) {'.$addon_id.' .feature-section .sppb-content-holder{'.$padding_sm.'}}' : '';
		$css .= (!empty($padding_xs)) ? '@media (max-width: 767px) {'.$addon_id.' .feature-section .sppb-content-holder{'.$padding_xs.'}}' : '';

        $margin = (isset($settings->content_margin)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_margin, 'margin') : '';
        $margin_sm = (isset($settings->content_margin_sm)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_margin_sm, 'margin') : '';
        $margin_xs = (isset($settings->content_margin_xs)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_margin_xs, 'margin') : '';

        $css .= (!empty($margin)) ? $addon_id .' .feature-section .sppb-content-holder{'.$margin.'}' : '';
        $css .= (!empty($margin_sm)) ? '@media (min-width: 768px) and (max-width: 991px) {'.$addon_id.' .feature-section .sppb-content-holder{'.$margin_sm.'}}' : '';
        $css .= (!empty($margin_xs)) ? '@media (max-width: 767px) {'.$addon_id.' .feature-section .sppb-content-holder{'.$margin_xs.'}}' : '';

        $padding = (isset($settings->button_padding)) ? SppagebuilderHelperSite::getPaddingMargin($settings->button_padding, 'padding') : '';
        $padding_sm = (isset($settings->button_padding_sm)) ? SppagebuilderHelperSite::getPaddingMargin($settings->button_padding_sm, 'padding') : '';
        $padding_xs = (isset($settings->button_padding_xs)) ? SppagebuilderHelperSite::getPaddingMargin($settings->button_padding_xs, 'padding') : '';

        $css .= (!empty($padding)) ? '#btn-' . $this->addon->id .' {'.$padding.'}' : '';
        $css .= (!empty($padding_sm)) ? '@media (min-width: 768px) and (max-width: 991px) { #btn-' . $this->addon->id .' {'.$padding_sm.'}}' : '';
        $css .= (!empty($padding_xs)) ? '@media (max-width: 767px) { #btn-' . $this->addon->id .' {'.$padding_xs.'}}' : '';

        $margin = (isset($settings->button_margin)) ? SppagebuilderHelperSite::getPaddingMargin($settings->button_margin, 'margin') : '';
        $margin_sm = (isset($settings->button_margin_sm)) ? SppagebuilderHelperSite::getPaddingMargin($settings->button_margin_sm, 'margin') : '';
        $margin_xs = (isset($settings->button_margin_xs)) ? SppagebuilderHelperSite::getPaddingMargin($settings->button_margin_xs, 'margin') : '';

        $css .= (!empty($margin)) ? '#btn-' . $this->addon->id .' {'.$margin.'}' : '';
        $css .= (!empty($margin_sm)) ? '@media (min-width: 768px) and (max-width: 991px) { #btn-' . $this->addon->id .' {'.$margin_sm.'}}' : '';
        $css .= (!empty($margin_xs)) ? '@media (max-width: 767px) { #btn-' . $this->addon->id .' {'.$margin_xs.'}}' : '';

		$css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $settings, 'id' => 'btn-' . $this->addon->id));

		return $css;
	}
}