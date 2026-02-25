<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonEvents extends SppagebuilderAddons {
    public function render() {
        $class              = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $heading_selector   = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
        $title              = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';

        $settings = $this->addon->settings;
        $btnclass = '';
        $btnclass .= (isset($settings->button_type) && $settings->button_type) ? ' sppb-btn-' . $settings->button_type : '';
        $btnclass .= (isset($settings->button_size) && $settings->button_size) ? ' sppb-btn-' . $settings->button_size : '';
        $btnclass .= (isset($settings->button_block) && $settings->button_block) ? ' ' . $settings->button_block : '';
        $btnclass .= (isset($settings->button_shape) && $settings->button_shape) ? ' sppb-btn-' . $settings->button_shape : ' sppb-btn-rounded';
        $btnclass .= (isset($settings->button_appearance) && $settings->button_appearance) ? ' sppb-btn-' . $settings->button_appearance : '';
        $icon = (isset($settings->icon) && $settings->icon) ? $settings->icon : '';
        $icon_position = (isset($settings->icon_position) && $settings->icon_position) ? $settings->icon_position : 'left';

        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-tzevents ' . $class . '">';
        $output .= '<div class="sppb-addon-tzevent-text-wrap">';
        $output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';
        $output .= '</div>'; //.sppb-addon-instagram-text-wrap

        $output .= '<div class="sppb-addon-tzevents-wrapper">';
        $output .= "<div class='sppb-countdown-timer sppb-row'></div>";

        foreach ($this->addon->settings->tz_event_items as $key => $event) {
            $text = (isset($event->text) && $event->text) ? $event->text : '';
            $output .= '<div class="sppb-row tzevents-movement">';
            $output .= '<div class="sppb-col-sm-12 event-header">';
            $output .= '<div class="sppb-row">';
            $output .= '<div class="sppb-col-sm-12 sppb-col-md-8 event-title-info">';
            if (isset($event->title) && $event->title) {
                $output .= '<h3 class="event-title"><a href="#">' . $event->title . '</a></h3>';
            }
            if ((isset($event->date) && $event->date) || (isset($event->time) && $event->time) || (isset($event->location) && $event->location)) {
                $output .= '<div class="metainfo" data-datetime="'.JHtml::_('date', $event->date. ' ' . $event->time, 'Y/m/d H:i').'">';
                if(isset($event->location) && $event->location){
                    $output .= '<span class="location">' . $event->location . '</span>';
                }
                if(isset($event->date) && $event->date){
                    $output .= ' - <span class="date">' . JHtml::_('date', $event->date , 'DATE_FORMAT_LC1') . '</span>';
                }
                if(isset($event->time) && $event->time){
                    $output .= ' - <span class="time">' . $event->time . '</span>';
                }
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '<div class="sppb-col-sm-12 sppb-col-md-4 event-calltoaction uk-text-right">';
            if(isset($event->button_url) && $event->button_url){
                $icon_arr = array_filter(explode(' ', $icon));
                if (count($icon_arr) === 1) {
                    $icon = 'fa ' . $icon;
                }

                if ($icon_position == 'left') {
                    $text = ($icon) ? '<i class="' . $icon . '" aria-hidden="true"></i> ' . $text : $text;
                } else {
                    $text = ($icon) ? $text . ' <i class="' . $icon . '" aria-hidden="true"></i>' : $text;
                }
                $attribs = (isset($event->target) && $event->target) ? ' rel="noopener noreferrer" target="' . $event->target . '"' : '';
                $output .= '<div class="calltoaction">';
                $output .= '<a href="' . $event->button_url . '" ' . $attribs . ' class="sppb-btn ' . $btnclass . '">' . $event->button_text . '</a>';
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            if(isset($event->content) && $event->content) {
                $output .= '<div class="sppb-col-sm-12 sppb-col-md-12 event-description">'. $event->content .'</div>';
            }
            $output .= '</div>'; //.timeline-movement
        } // foreach timelines

        $output .= '</div>'; //.Timeline

        $output .= '</div>'; //.sppb-addon-instagram-gallery

        return $output;
    }

    public function scripts() {
        return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.countdown.min.js');
    }

    public function js() {
        $datetime       =   '';
        foreach ($this->addon->settings->tz_event_items as $key => $event) {
            if ($datetime == '' || $datetime > JHtml::_('date', $event->date. ' ' . $event->time, 'Y/m/d H:i')) {
                $datetime   =   JHtml::_('date', $event->date. ' ' . $event->time, 'Y/m/d H:i');
            }
        }
        $finish_text 			= addslashes($this->addon->settings->finish_text);

        $js ="jQuery(function($){
			var addon_id = '#sppb-addon-'+'".$this->addon->id."';
			var allPanels = $('#sppb-addon-'+'".$this->addon->id." .tzevents-movement');
			allPanels.find('.event-description').hide();
			allPanels.find('.event-description').first().slideDown();
			//console.log(addon_id +' .sppb-addon-tzevents .sppb-countdown-timer');
			$( addon_id +' .sppb-addon-tzevents .sppb-countdown-timer').each(function () {
					var cdDateFormate = allPanels.find('.metainfo').first().data('datetime');
//					console.log(cdDateFormate);
					$(this).countdown(cdDateFormate, function (event) {
							$(this).html(event.strftime('<div class=\"sppb-countdown-days sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%-D</span><span class=\"sppb-countdown-text\">%!D: ' + '".JTEXT::_('COM_SPPAGEBUILDER_DAY')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_DAYS')."' + ';</span></div><div class=\"sppb-countdown-hours sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%H</span><span class=\"sppb-countdown-text\">%!H: ' + '".JTEXT::_('COM_SPPAGEBUILDER_HOUR')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_HOURS')."' + ';</span></div><div class=\"sppb-countdown-minutes sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%M</span><span class=\"sppb-countdown-text\">%!M:' + '".JTEXT::_('COM_SPPAGEBUILDER_MINUTE')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_MINUTES')."' + ';</span></div><div class=\"sppb-countdown-seconds sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%S</span><span class=\"sppb-countdown-text\">%!S:' + '".JTEXT::_('COM_SPPAGEBUILDER_SECOND')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_SECONDS')."' + ';</span></div>'))
							.on('finish.countdown', function () {
									$(this).html('<div class=\"sppb-countdown-finishedtext-wrap sppb-col-xs-12 sppb-col-sm-12 sppb-text-center\"><h3 class=\"sppb-countdown-finishedtext\">' + '".$finish_text."' + '</h3></div>');
							});
					});
			});
    
              $('#sppb-addon-'+'".$this->addon->id." .tzevents-movement .event-title > a').click(function() {
                allPanels.find('.event-description').slideUp();
                var cdDateFormate = $(this).parent().parent().find('.metainfo').data('datetime');
                $( addon_id +' .sppb-addon-tzevents .sppb-countdown-timer').countdown(cdDateFormate, function (event) {
							$(this).html(event.strftime('<div class=\"sppb-countdown-days sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%-D</span><span class=\"sppb-countdown-text\">%!D: ' + '".JTEXT::_('COM_SPPAGEBUILDER_DAY')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_DAYS')."' + ';</span></div><div class=\"sppb-countdown-hours sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%H</span><span class=\"sppb-countdown-text\">%!H: ' + '".JTEXT::_('COM_SPPAGEBUILDER_HOUR')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_HOURS')."' + ';</span></div><div class=\"sppb-countdown-minutes sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%M</span><span class=\"sppb-countdown-text\">%!M:' + '".JTEXT::_('COM_SPPAGEBUILDER_MINUTE')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_MINUTES')."' + ';</span></div><div class=\"sppb-countdown-seconds sppb-col-xs-6 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%S</span><span class=\"sppb-countdown-text\">%!S:' + '".JTEXT::_('COM_SPPAGEBUILDER_SECOND')."' + ',' + '".JTEXT::_('COM_SPPAGEBUILDER_SECONDS')."' + ';</span></div>'))
							.on('finish.countdown', function () {
									$(this).html('<div class=\"sppb-countdown-finishedtext-wrap sppb-col-xs-12 sppb-col-sm-12 sppb-text-center\"><h3 class=\"sppb-countdown-finishedtext\">' + '".$finish_text."' + '</h3></div>');
							});
					});
                $(this).parent().parent().parent().parent().next().slideDown();
                return false;
              });
		})";
        return $js;
    }

    public function css() {
        $settings = $this->addon->settings;
        $addon_id = '#sppb-addon-' . $this->addon->id;

        // Counter
        $counter_style = '';
        $counter_style_sm = '';
        $counter_style_xs = '';

        $counter_style   .= (isset($settings->counter_height) && $settings->counter_height) ? "height: " . (int) $settings->counter_height  . "px; line-height: " . (int) $settings->counter_height  . "px;" : '';
        $counter_style_sm   .= (isset($settings->counter_height_sm) && $settings->counter_height_sm) ? "height: " . (int) $settings->counter_height_sm  . "px; line-height: " . (int) $settings->counter_height_sm  . "px;" : '';
        $counter_style_xs   .= (isset($settings->counter_height_xs) && $settings->counter_height_xs) ? "height: " . (int) $settings->counter_height_xs  . "px; line-height: " . (int) $settings->counter_height_xs  . "px;" : '';

        $counter_style  .= (isset($settings->counter_width) && $settings->counter_width) ? "width: " . (int) $settings->counter_width  . "px;" : '';
        $counter_style_sm  .= (isset($settings->counter_width_sm) && $settings->counter_width_sm) ? "width: " . (int) $settings->counter_width_sm  . "px;" : '';
        $counter_style_xs  .= (isset($settings->counter_width_xs) && $settings->counter_width_xs) ? "width: " . (int) $settings->counter_width_xs  . "px;" : '';

        $counter_style  .= (isset($settings->counter_font_size) && $settings->counter_font_size) ? "font-size: " . (int) $settings->counter_font_size  . "px;" : '';
        $counter_style  .= (isset($settings->counter_text_font_family) && $settings->counter_text_font_family) ? "font-family: " . $settings->counter_text_font_family  . ";" : '';
        $counter_style  .= (isset($settings->counter_text_font_weight) && $settings->counter_text_font_weight) ? "font-weight: " . $settings->counter_text_font_weight  . ";" : '';
        $counter_style_sm  .= (isset($settings->counter_font_size_sm) && $settings->counter_font_size_sm) ? "font-size: " . (int) $settings->counter_font_size_sm  . "px;" : '';
        $counter_style_xs  .= (isset($settings->counter_font_size_xs) && $settings->counter_font_size_xs) ? "font-size: " . (int) $settings->counter_font_size_xs . "px;" : '';

        $counter_style  .= (isset($settings->counter_text_color) && $settings->counter_text_color) ? "color: " . $settings->counter_text_color  . ";" : '';
        $counter_style  .= (isset($settings->counter_background_color) && $settings->counter_background_color) ? "background-color: " . $settings->counter_background_color  . ";" : '';

        if (isset($settings->counter_border_radius->md)) $settings->counter_border_radius = $settings->counter_border_radius->md;
        $counter_style  .= (isset($settings->counter_border_radius) && $settings->counter_border_radius) ? "border-radius: " . $settings->counter_border_radius . "px;" : '';
        $counter_style_sm  .= (isset($settings->counter_border_radius_sm) && $settings->counter_border_radius_sm) ? "border-radius: " . $settings->counter_border_radius_sm . "px;" : '';
        $counter_style_xs  .= (isset($settings->counter_border_radius_xs) && $settings->counter_border_radius_xs) ? "border-radius: " . $settings->counter_border_radius_xs . "px;" : '';

        $use_border = (isset($settings->counter_user_border) && $settings->counter_user_border) ? 1 : 0;
        if($use_border) {
            $counter_style  .= (isset($settings->counter_border_width) && $settings->counter_border_width) ? "border-width: " . $settings->counter_border_width . "px;" : '';
            $counter_style  .= (isset($settings->counter_border_style) && $settings->counter_border_style) ? "border-style: " . $settings->counter_border_style  . ";" : '';
            $counter_style  .= (isset($settings->counter_border_color) && $settings->counter_border_color) ? "border-color: " . $settings->counter_border_color  . ";" : '';
            $counter_style_sm  .= (isset($settings->counter_border_width_sm) && $settings->counter_border_width_sm) ? "border-width: " . $settings->counter_border_width_sm  . "px;" : '';
            $counter_style_xs .= (isset($settings->counter_border_width_xs) && $settings->counter_border_width_xs) ? "border-width: " . $settings->counter_border_width_xs . "px;" : '';
        }

        // Label
        $label_style = '';
        $label_style_sm = '';
        $label_style_xs = '';
        $label_style .= (isset($settings->label_font_size) && $settings->label_font_size) ? "font-size: " . (int) $settings->label_font_size  . "px;" : '';
        $label_style .= (isset($settings->label_color) && $settings->label_color) ? "color: " . $settings->label_color  . ";" : '';
        $label_style .= (isset($settings->label_margin) && trim($settings->label_margin)) ? "margin: " . $settings->label_margin  . ";" : '';

        $label_font_style = (isset($settings->label_font_style) && $settings->label_font_style) ? $settings->label_font_style : '';
        if(isset($label_font_style->underline) && $label_font_style->underline){
            $label_style .= 'text-decoration:underline;';
        }
        if(isset($label_font_style->italic) && $label_font_style->italic){
            $label_style .= 'font-style:italic;';
        }
        if(isset($label_font_style->uppercase) && $label_font_style->uppercase){
            $label_style .= 'text-transform:uppercase;';
        }
        if(isset($label_font_style->weight) && $label_font_style->weight){
            $label_style .= 'font-weight:'.$label_font_style->weight.';';
        }

        $label_style_sm .= (isset($settings->label_font_size_sm) && $settings->label_font_size_sm) ? "font-size: " . (int) $settings->label_font_size_sm  . "px;" : '';
        $label_style_sm .= (isset($settings->label_margin_sm) && trim($settings->label_margin_sm)) ? "margin: " . $settings->label_margin_sm  . ";" : '';

        $label_style_xs .= (isset($settings->label_font_size_xs) && $settings->label_font_size_xs) ? "font-size: " . (int) $settings->label_font_size_xs  . "px;" : '';
        $label_style_xs .= (isset($settings->label_margin_xs) && trim($settings->label_margin_xs)) ? "margin: " . $settings->label_margin_xs  . ";" : '';

        // Event title
        $event_style = '';
        $event_style_sm = '';
        $event_style_xs = '';
        $event_style .= (isset($settings->title_event_fontsize) && $settings->title_event_fontsize) ? "font-size: " . (int) $settings->title_event_fontsize  . "px;" : '';
        $event_style .= (isset($settings->title_event_lineheight) && $settings->title_event_lineheight) ? "line-height: " . (int) $settings->title_event_lineheight  . "px;" : '';
        $event_style .= (isset($settings->title_event_letterspace) && $settings->title_event_letterspace) ? "letter-spacing: " . (int) $settings->title_event_letterspace  . "px;" : '';
        $event_style .= (isset($settings->title_color) && $settings->title_color) ? "color: " . $settings->title_color  . ";" : '';

        $title_event_font_style = (isset($settings->title_event_font_style) && $settings->title_event_font_style) ? $settings->title_event_font_style : '';
        if(isset($title_event_font_style->underline) && $title_event_font_style->underline){
            $event_style .= 'text-decoration:underline;';
        }
        if(isset($title_event_font_style->italic) && $title_event_font_style->italic){
            $event_style .= 'font-style:italic;';
        }
        if(isset($title_event_font_style->uppercase) && $title_event_font_style->uppercase){
            $event_style .= 'text-transform:uppercase;';
        }
        if(isset($title_event_font_style->weight) && $title_event_font_style->weight){
            $event_style .= 'font-weight:'.$title_event_font_style->weight.';';
        }

        $event_style_sm .= (isset($settings->title_event_fontsize_sm) && $settings->title_event_fontsize_sm) ? "font-size: " . (int) $settings->title_event_fontsize_sm  . "px;" : '';
        $event_style_sm .= (isset($settings->title_event_lineheight_sm) && trim($settings->title_event_lineheight_sm)) ? "line-height: " .(int) $settings->title_event_lineheight_sm  . "px;" : '';

        $event_style_xs .= (isset($settings->title_event_fontsize_xs) && $settings->title_event_fontsize_xs) ? "font-size: " . (int) $settings->title_event_fontsize_xs  . "px;" : '';
        $event_style_xs .= (isset($settings->title_event_lineheight_xs) && trim($settings->title_event_lineheight_xs)) ? "line-height: " .(int) $settings->title_event_lineheight_xs  . "px;" : '';

        // Event content
        $content_style = '';
        $content_style_sm = '';
        $content_style_xs = '';
        $content_style .= (isset($settings->content_event_fontsize) && $settings->content_event_fontsize) ? "font-size: " . (int) $settings->content_event_fontsize  . "px;" : '';
        $content_style .= (isset($settings->content_event_lineheight) && $settings->content_event_lineheight) ? "line-height: " . (int) $settings->content_event_lineheight  . "px;" : '';

        $content_event_font_style = (isset($settings->content_event_font_style) && $settings->content_event_font_style) ? $settings->content_event_font_style : '';
        if(isset($content_event_font_style->underline) && $content_event_font_style->underline){
            $content_style .= 'text-decoration:underline;';
        }
        if(isset($content_event_font_style->italic) && $content_event_font_style->italic){
            $content_style .= 'font-style:italic;';
        }
        if(isset($content_event_font_style->uppercase) && $content_event_font_style->uppercase){
            $content_style .= 'text-transform:uppercase;';
        }
        if(isset($content_event_font_style->weight) && $content_event_font_style->weight){
            $content_style .= 'font-weight:'.$content_event_font_style->weight.';';
        }

        $content_style_sm .= (isset($settings->content_event_fontsize_sm) && $settings->content_event_fontsize_sm) ? "font-size: " . (int) $settings->content_event_fontsize_sm  . "px;" : '';
        $content_style_sm .= (isset($settings->content_event_lineheight_sm) && trim($settings->content_event_lineheight_sm)) ? "line-height: " .(int) $settings->content_event_lineheight_sm  . "px;" : '';

        $content_style_xs .= (isset($settings->content_event_fontsize_xs) && $settings->content_event_fontsize_xs) ? "font-size: " . (int) $settings->content_event_fontsize_xs  . "px;" : '';
        $content_style_xs .= (isset($settings->content_event_lineheight_xs) && trim($settings->content_event_lineheight_sm)) ? "line-height: " .(int) $settings->content_event_lineheight_sm  . "px;" : '';

        // Event Meta
        $meta_style = '';
        $meta_style_sm = '';
        $meta_style_xs = '';
        $meta_style .= (isset($settings->meta_event_fontsize) && $settings->meta_event_fontsize) ? "font-size: " . (int) $settings->meta_event_fontsize  . "px;" : '';
        $meta_style .= (isset($settings->meta_event_lineheight) && $settings->meta_event_lineheight) ? "line-height: " . (int) $settings->meta_event_lineheight  . "px;" : '';

        $meta_event_font_style = (isset($settings->meta_event_font_style) && $settings->meta_event_font_style) ? $settings->meta_event_font_style : '';
        if(isset($meta_event_font_style->underline) && $meta_event_font_style->underline){
            $meta_style .= 'text-decoration:underline;';
        }
        if(isset($meta_event_font_style->italic) && $meta_event_font_style->italic){
            $meta_style .= 'font-style:italic;';
        }
        if(isset($meta_event_font_style->uppercase) && $meta_event_font_style->uppercase){
            $meta_style .= 'text-transform:uppercase;';
        }
        if(isset($meta_event_font_style->weight) && $meta_event_font_style->weight){
            $meta_style .= 'font-weight:'.$meta_event_font_style->weight.';';
        }

        $meta_style_sm .= (isset($settings->meta_event_fontsize_sm) && $settings->meta_event_fontsize_sm) ? "font-size: " . (int) $settings->meta_event_fontsize_sm  . "px;" : '';
        $meta_style_sm .= (isset($settings->meta_event_lineheight_sm) && trim($settings->meta_event_lineheight_sm)) ? "line-height: " .(int) $settings->meta_event_lineheight_sm  . "px;" : '';

        $meta_style_xs .= (isset($settings->meta_event_fontsize_xs) && $settings->meta_event_fontsize_xs) ? "font-size: " . (int) $settings->meta_event_fontsize_xs  . "px;" : '';
        $meta_style_xs .= (isset($settings->meta_event_lineheight_xs) && trim($settings->meta_event_lineheight_xs)) ? "line-height: " .(int) $settings->meta_event_lineheight_xs  . "px;" : '';

        //CSS out start
        $css = '';
        if($counter_style) {
            $css .= $addon_id . ' .sppb-countdown-number, '. $addon_id .' .sppb-countdown-finishedtext {';
            $css .= $counter_style;
            $css .= '}';
        }

        if($label_style) {
            $css .= $addon_id . ' .sppb-countdown-text {';
            $css .= $label_style;
            $css .= '}';
        }

        if ($event_style) {
            $css .= $addon_id . ' .event-title a {';
            $css .= $event_style;
            $css .= '}';
        }

        if ($content_style) {
            $css .= $addon_id . ' .event-description {';
            $css .= $content_style;
            $css .= '}';
        }

        if ($meta_style) {
            $css .= $addon_id . ' .metainfo {';
            $css .= $meta_style;
            $css .= '}';
        }

        // Events
        $css    .=  (isset($settings->border_color) && $settings->border_color) ? $addon_id . ' .tzevents-movement {'. "border-color: " . $settings->border_color  . ";}" : '';
        $css    .=  (isset($settings->location_color) && $settings->location_color) ? $addon_id . ' .location {'. "color: " . $settings->location_color  . ";}" : '';
        $css    .=  (isset($settings->datetime_color) && $settings->datetime_color) ? $addon_id . ' .date, .time {'."color: " . $settings->datetime_color  . ";}" : '';
        $css    .=  (isset($settings->description_color) && $settings->description_color) ? $addon_id . ' .event-description {'."color: " . $settings->description_color  . ";}" : '';

        if(!empty($counter_style_sm) || !empty($label_style_sm) || !empty($event_style_sm) || !empty($content_style_sm)){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if($counter_style_sm) {
                $css .= $addon_id . ' .sppb-countdown-number, '. $addon_id .' .sppb-countdown-finishedtext {';
                $css .= $counter_style_sm;
                $css .= '}';
            }

            if($label_style_sm) {
                $css .= $addon_id . ' .sppb-countdown-text {';
                $css .= $label_style_sm;
                $css .= '}';
            }

            if ($event_style_sm) {
                $css .= $addon_id . ' .event-title a {';
                $css .= $event_style_sm;
                $css .= '}';
            }

            if ($content_style_sm) {
                $css .= $addon_id . ' .event-description {';
                $css .= $content_style_sm;
                $css .= '}';
            }
            if ($meta_style_sm) {
                $css .= $addon_id . ' .metainfo {';
                $css .= $meta_style_sm;
                $css .= '}';
            }
            $css .= '}';
        }

        if(!empty($counter_style_xs) || !empty($label_style_xs) || !empty($event_style_xs) || !empty($content_style_xs)){
            $css .= '@media (max-width: 767px) {';
            if($counter_style_xs) {
                $css .= $addon_id . ' .sppb-countdown-number, '. $addon_id .' .sppb-countdown-finishedtext {';
                $css .= $counter_style_xs;
                $css .= '}';
            }

            if($label_style_xs) {
                $css .= $addon_id . ' .sppb-countdown-text {';
                $css .= $label_style_xs;
                $css .= '}';
            }

            if ($event_style_xs) {
                $css .= $addon_id . ' .event-title a {';
                $css .= $event_style_xs;
                $css .= '}';
            }

            if ($content_style_xs) {
                $css .= $addon_id . ' .event-description {';
                $css .= $content_style_xs;
                $css .= '}';
            }

            if ($meta_style_xs) {
                $css .= $addon_id . ' .metainfo {';
                $css .= $meta_style_xs;
                $css .= '}';
            }
            $css .= '}';
        }

        // Button
        $options = new stdClass;
        $options->button_type = (isset($settings->button_type) && $settings->button_type) ? $settings->button_type : '';
        $options->button_appearance = (isset($settings->button_appearance) && $settings->button_appearance) ? $settings->button_appearance : '';
        $options->button_color = (isset($settings->button_color) && $settings->button_color) ? $settings->button_color : '';
        $options->button_border_width = (isset($settings->button_border_width) && $settings->button_border_width) ? $settings->button_border_width : '';
        $options->button_color_hover = (isset($settings->button_color_hover) && $settings->button_color_hover) ? $settings->button_color_hover : '';
        $options->button_background_color = (isset($settings->button_background_color) && $settings->button_background_color) ? $settings->button_background_color : '';
        $options->button_background_color_hover = (isset($settings->button_background_color_hover) && $settings->button_background_color_hover) ? $settings->button_background_color_hover : '';
        $options->button_font_style = (isset($settings->button_font_style) && $settings->button_font_style) ? $settings->button_font_style : '';
        $options->button_padding = (isset($settings->button_padding) && $settings->button_padding) ? $settings->button_padding : '';
        $options->button_padding_sm = (isset($settings->button_padding_sm) && $settings->button_padding_sm) ? $settings->button_padding_sm : '';
        $options->button_padding_xs = (isset($settings->button_padding_xs) && $settings->button_padding_xs) ? $settings->button_padding_xs : '';
        $options->button_fontsize = (isset($settings->button_fontsize) && $settings->button_fontsize) ? $settings->button_fontsize : '';
        //Button Type Link
        $options->link_button_color = (isset($settings->link_button_color) && $settings->link_button_color) ? $settings->link_button_color : '';
        $options->link_border_color = (isset($settings->link_border_color) && $settings->link_border_color) ? $settings->link_border_color : '';
        $options->link_button_border_width = (isset($settings->link_button_border_width) && $settings->link_button_border_width) ? $settings->link_button_border_width : '';
        $options->link_button_padding_bottom = (isset($settings->link_button_padding_bottom) && gettype($settings->link_button_padding_bottom)=='string') ? $settings->link_button_padding_bottom : '';
        //Link Hover
        $options->link_button_hover_color = (isset($settings->link_button_hover_color) && $settings->link_button_hover_color) ? $settings->link_button_hover_color : '';
        $options->link_button_border_hover_color = (isset($settings->link_button_border_hover_color) && $settings->link_button_border_hover_color) ? $settings->link_button_border_hover_color : '';

        $options->button_fontsize_sm = (isset($settings->button_fontsize_sm) && $settings->button_fontsize_sm) ? $settings->button_fontsize_sm : '';
        $options->button_fontsize_xs = (isset($settings->button_fontsize_xs) && $settings->button_fontsize_xs) ? $settings->button_fontsize_xs : '';
        $options->button_letterspace = (isset($settings->button_letterspace) && $settings->button_letterspace) ? $settings->button_letterspace : '';
        $options->button_background_gradient = (isset($settings->button_background_gradient) && $settings->button_background_gradient) ? $settings->button_background_gradient : new stdClass();
        $options->button_background_gradient_hover = (isset($settings->button_background_gradient_hover) && $settings->button_background_gradient_hover) ? $settings->button_background_gradient_hover : new stdClass();
        $btn_style = (isset($options->button_type) && $options->button_type) ? $options->button_type : '';
        $appearance = (isset($options->button_appearance) && $options->button_appearance) ? $options->button_appearance : '';

        $custom_style = '';
        $custom_style_sm = '';
        $custom_style_xs = '';
        if ($appearance == 'outline') {
            $custom_style .= (isset($options->button_background_color) && $options->button_background_color) ? ' border-color: ' . $options->button_background_color . ';' : '';
            $custom_style .= (isset($options->button_border_width) && $options->button_border_width) ? ' border-width: ' . $options->button_border_width . ';' : '';
            $custom_style .= 'background-color: transparent;';
        } else if ($appearance == '3d') {
            $custom_style .= (isset($options->button_background_color_hover) && $options->button_background_color_hover) ? ' border-bottom-color: ' . $options->button_background_color_hover . ';' : '';
            $custom_style .= (isset($options->button_background_color) && $options->button_background_color) ? ' background-color: ' . $options->button_background_color . ';' : '';
        } else if ($appearance == 'gradient') {
            $radialPos = (isset($options->button_background_gradient->radialPos) && !empty($options->button_background_gradient->radialPos)) ? $options->button_background_gradient->radialPos : 'center center';

            $gradientColor = (isset($options->button_background_gradient->color) && !empty($options->button_background_gradient->color)) ? $options->button_background_gradient->color : '';

            $gradientColor2 = (isset($options->button_background_gradient->color2) && !empty($options->button_background_gradient->color2)) ? $options->button_background_gradient->color2 : '';

            $gradientDeg = (isset($options->button_background_gradient->deg) && !empty($options->button_background_gradient->deg)) ? $options->button_background_gradient->deg : '0';

            $gradientPos = (isset($options->button_background_gradient->pos) && !empty($options->button_background_gradient->pos)) ? $options->button_background_gradient->pos : '0';

            $gradientPos2 = (isset($options->button_background_gradient->pos2) && !empty($options->button_background_gradient->pos2)) ? $options->button_background_gradient->pos2 : '100';

            if (isset($options->button_background_gradient->type) && $options->button_background_gradient->type == 'radial') {
                $custom_style .= "\tbackground-image: radial-gradient(at " . $radialPos . ", " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
            } else {
                $custom_style .= "\tbackground-image: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
            }
            $custom_style .= "\tborder: none;\n";
        } else {
            $custom_style .= (isset($options->button_background_color) && $options->button_background_color) ? ' background-color: ' . $options->button_background_color . ';' : '';
        }
        $custom_style .= (isset($options->button_color) && $options->button_color) ? ' color: ' . $options->button_color . ';' : '';

        $custom_style .= (isset($options->button_padding) && trim($options->button_padding)) ? ' padding: ' . $options->button_padding . ';' : '';
        $custom_style_sm .= (isset($options->button_padding_sm) && trim($options->button_padding_sm)) ? ' padding: ' . $options->button_padding_sm . ';' : '';
        $custom_style_xs .= (isset($options->button_padding_xs) && trim($options->button_padding_xs)) ? ' padding: ' . $options->button_padding_xs . ';' : '';

        $custom_style .= (isset($options->fontsize) && $options->fontsize) ? ' font-size: ' . $options->fontsize . 'px;' : '';
        $custom_style_sm .= (isset($options->fontsize_sm) && $options->fontsize_sm) ? ' font-size: ' . $options->fontsize_sm . 'px;' : '';
        $custom_style_xs .= (isset($options->fontsize_xs) && $options->fontsize_xs) ? ' font-size: ' . $options->fontsize_xs . 'px;' : '';

        if (isset($options->button_margin_top) && is_object($options->button_margin_top)) {
            $custom_style .= (isset($options->button_margin_top->md) && $options->button_margin_top->md) ? ' margin-top: ' . $options->button_margin_top->md . ';' : '';
            $custom_style_sm .= (isset($options->button_margin_top->sm) && $options->button_margin_top->sm) ? ' margin-top: ' . $options->button_margin_top->sm . ';' : '';
            $custom_style_xs .= (isset($options->button_margin_top->xs) && $options->button_margin_top->xs) ? ' margin-top: ' . $options->button_margin_top->xs . ';' : '';
        }

        $hover_style = ($appearance == 'outline') ? ((isset($options->button_background_color_hover) && $options->button_background_color_hover) ? ' border-color: ' . $options->button_background_color_hover . ';' : '') : '';
        $hover_style .= (isset($options->button_background_color_hover) && $options->button_background_color_hover) ? ' background-color: ' . $options->button_background_color_hover . ';' : '';
        $hover_style .= (isset($options->button_color_hover) && $options->button_color_hover) ? ' color: ' . $options->button_color_hover . ';' : '';

        if ($appearance == 'gradient') {
            $radialPos = (isset($options->button_background_gradient_hover->radialPos) && !empty($options->button_background_gradient_hover->radialPos)) ? $options->button_background_gradient_hover->radialPos : 'center center';

            $gradientColor = (isset($options->button_background_gradient_hover->color) && !empty($options->button_background_gradient_hover->color)) ? $options->button_background_gradient_hover->color : '';

            $gradientColor2 = (isset($options->button_background_gradient_hover->color2) && !empty($options->button_background_gradient_hover->color2)) ? $options->button_background_gradient_hover->color2 : '';

            $gradientDeg = (isset($options->button_background_gradient_hover->deg) && !empty($options->button_background_gradient_hover->deg)) ? $options->button_background_gradient_hover->deg : '0';

            $gradientPos = (isset($options->button_background_gradient_hover->pos) && !empty($options->button_background_gradient_hover->pos)) ? $options->button_background_gradient_hover->pos : '0';

            $gradientPos2 = (isset($options->button_background_gradient_hover->pos2) && !empty($options->button_background_gradient_hover->pos2)) ? $options->button_background_gradient_hover->pos2 : '100';

            if (isset($options->button_background_gradient_hover->type) && $options->button_background_gradient_hover->type == 'radial') {
                $hover_style .= "\tbackground-image: radial-gradient(at " . $radialPos . ", " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
            } else {
                $hover_style .= "\tbackground-image: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
            }
            $hover_style .= "\tborder: none;\n";
        }


        $style = (isset($options->button_letterspace) && $options->button_letterspace) ? 'letter-spacing: ' . $options->button_letterspace . ';' : '';

// Font Style
        $modern_font_style = false;
        if (isset($options->button_font_style->underline) && $options->button_font_style->underline) {
            $style .= 'text-decoration: underline;';
            $modern_font_style = true;
        }

        if (isset($options->button_font_style->italic) && $options->button_font_style->italic) {
            $style .= 'font-style: italic;';
            $modern_font_style = true;
        }

        if (isset($options->button_font_style->uppercase) && $options->button_font_style->uppercase) {
            $style .= 'text-transform: uppercase;';
            $modern_font_style = true;
        }

        if (isset($options->button_font_style->weight) && $options->button_font_style->weight) {
            $style .= 'font-weight: ' . $options->button_font_style->weight . ';';
            $modern_font_style = true;
        }

        if (!$modern_font_style) {
            $font_style = (isset($options->button_fontstyle) && $options->button_fontstyle) ? $options->button_fontstyle : '';
            if (is_array($font_style) && count($font_style)) {
                if (in_array('underline', $font_style)) {
                    $style .= 'text-decoration: underline;';
                }

                if (in_array('uppercase', $font_style)) {
                    $style .= 'text-transform: uppercase;';
                }

                if (in_array('italic', $font_style)) {
                    $style .= 'font-style: italic;';
                }

                if (in_array('lighter', $font_style)) {
                    $style .= 'font-weight: lighter;';
                } else if (in_array('normal', $font_style)) {
                    $style .= 'font-weight: normal;';
                } else if (in_array('bold', $font_style)) {
                    $style .= 'font-weight: bold;';
                } else if (in_array('bolder', $font_style)) {
                    $style .= 'font-weight: bolder;';
                }
            }
        }
        if($btn_style=='link'){
            $link_style ='';
            $link_style .= (isset($options->link_button_color) && $options->link_button_color) ? ' color: ' . $options->link_button_color . ';' : '';
            $link_style .= (isset($options->link_border_color) && $options->link_border_color) ? ' border-color: ' . $options->link_border_color . ';' : '';
            $link_style .= (isset($options->link_button_border_width) && $options->link_button_border_width) ? ' border-width: 0 0 ' . $options->link_button_border_width . 'px 0;' : '';
            $link_style .= (isset($options->link_button_padding_bottom) && gettype($options->link_button_padding_bottom) == 'string') ? ' padding: 0 0 ' . $options->link_button_padding_bottom . 'px 0;' : '';
            $css .= $addon_id . ' .sppb-btn-link {';
            $css .= $link_style;
            $css .= 'text-decoration:none;';
            $css .= 'border-radius:0;';
            $css .= '}';

            $link_hover_style ='';
            $link_hover_style .= (isset($options->link_button_hover_color) && $options->link_button_hover_color) ? ' color: ' . $options->link_button_hover_color . ';' : '';
            $link_hover_style .= (isset($options->link_button_border_hover_color) && $options->link_button_border_hover_color) ? ' border-color: ' . $options->link_button_border_hover_color . ';' : '';
            $css .= $addon_id . ' .sppb-btn-link:hover,';
            $css .= $addon_id . ' .sppb-btn-link:focus {';
            $css .= $link_hover_style;
            $css .= '}';

        }
        if ($style) {
            $css .= $addon_id . ' .sppb-btn-' . $btn_style . '{' . $style . '}';
        }

        if ($btn_style == 'custom') {
            if ($custom_style) {
                $css .= $addon_id . ' .sppb-btn-custom {' . $custom_style . '}';
            }

            if ($hover_style) {
                $css .= $addon_id . ' .sppb-btn-custom:hover {' . $hover_style . '}';
            }

            // Responsive Tablet
            if (!empty($custom_style_sm)) {
                $css .= "@media (min-width: 768px) and (max-width: 991px) {";
                $css .= $addon_id  . " .sppb-btn-custom {\n" . $custom_style_sm . "}\n";
                $css .= "}";
            }

            // Responsive Phone
            if (!empty($custom_style_xs)) {
                $css .= "@media (max-width: 767px) {";
                $css .= $addon_id . " .sppb-btn-custom {\n" . $custom_style_xs . "}\n";
                $css .= "}";
            }
        }

        return $css;
    }
}
