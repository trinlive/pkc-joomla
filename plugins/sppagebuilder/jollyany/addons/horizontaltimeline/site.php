<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2020 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonHorizontalTimeline extends SppagebuilderAddons {

    public function render() {
        $class              = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $heading_selector   = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
        $arrow_controls     = (isset($this->addon->settings->enable_arrow) && $this->addon->settings->enable_arrow) ? $this->addon->settings->enable_arrow : 0;
        $controls           = (isset($this->addon->settings->enable_bullets) && $this->addon->settings->enable_bullets) ? $this->addon->settings->enable_bullets : 0;

        $addon_id = '#sppb-addon-' . $this->addon->id;

        $output = '<div class="sppb-addon sppb-addon-horizontal-timeline ' . $class . '">';

        $top    =   '';
        $down   =   '';
        $points =   '';
        foreach ($this->addon->settings->sp_timeline_items as $key => $timeline) {
            $oddeven = (round($key % 2) == 0) ? 'even' : 'odd';
            $points .= '<div class="timeline-point"><div class="timeline-point-content"></div></div>';
            if ($oddeven == 'even') {
                $top    .=  '<div class="timeline-movement ' . $oddeven . '">';
                $top    .= '<div class="timeline-item">';
                $top    .= '<div class="timeline-panel text-center">';
                if(isset($timeline->title) && $timeline->title){
                    $top .= '<' . $heading_selector . ' class="title">' . $timeline->title . '</' . $heading_selector . '>';
                }
                if(isset($timeline->content) && $timeline->content){
                    $top .= '<div class="details">' . $timeline->content . '</div>';
                }
                $top .= '</div>';
                $top .= '</div>';
                $top   .= '<div class="timeline-badge-top"></div>';
                // end timeline-block
                $top    .=  '</div>'; //.timeline-movement

                $down   .=  '<div class="timeline-movement ' . $oddeven . '">';
                $down   .= '<div class="timeline-item">';
                if(isset($timeline->date) && $timeline->date){
                    $down .= '<div class="timeline-date text-center">' . $timeline->date . '</div>';
                }
                $down   .= '</div>';
                $down   .=  '</div>'; //.timeline-movement
            } else {
                $down    .=  '<div class="timeline-movement ' . $oddeven . '">';

                $down   .= '<div class="uk-visible@s">';
                $down   .= '<div class="timeline-badge-bottom"></div>';
                $down    .= '<div class="timeline-item">';
                $down    .= '<div class="timeline-panel text-center">';
                if(isset($timeline->title) && $timeline->title){
                    $down .= '<' . $heading_selector . ' class="title">' . $timeline->title . '</' . $heading_selector . '>';
                }
                if(isset($timeline->content) && $timeline->content){
                    $down .= '<div class="details">' . $timeline->content . '</div>';
                }
                $down .= '</div>';
                $down .= '</div>';
                $down .= '</div>';

                $down .= '<div class="uk-hidden@s">';
                $down   .= '<div class="timeline-item">';
                if(isset($timeline->date) && $timeline->date){
                    $down .= '<div class="timeline-date text-center">' . $timeline->date . '</div>';
                }
                $down   .= '</div>';
                $down .= '</div>';

                // end timeline-block
                $down    .=  '</div>'; //.timeline-movement

                $top   .=  '<div class="timeline-movement ' . $oddeven . '">';

                $top   .= '<div class="uk-visible@s">';
                $top   .= '<div class="timeline-item">';
                if(isset($timeline->date) && $timeline->date){
                    $top .= '<div class="timeline-date text-center">' . $timeline->date . '</div>';
                }
                $top   .= '</div>';
                $top   .= '</div>';

                $top .= '<div class="uk-hidden@s">';
                $top    .= '<div class="timeline-item">';
                $top    .= '<div class="timeline-panel text-center">';
                if(isset($timeline->title) && $timeline->title){
                    $top .= '<' . $heading_selector . ' class="title">' . $timeline->title . '</' . $heading_selector . '>';
                }
                if(isset($timeline->content) && $timeline->content){
                    $top .= '<div class="details">' . $timeline->content . '</div>';
                }
                $top .= '</div>';
                $top .= '</div>';
                $top   .= '<div class="timeline-badge-top"></div>';
                $top   .= '</div>';

                $top   .=  '</div>'; //.timeline-movement
            }
        } // foreach timelines

        $output .= '<div class="sppb-addon-horizontal-timeline-top-wrapper">'.$top.'</div>';
        $output .= '<div class="sppb-addon-horizontal-timeline-line">'.$points.'</div>';
        $output .= '<div class="sppb-addon-horizontal-timeline-down-wrapper">'.$down.'</div>';
        $jstext =   '';
        if ($arrow_controls) {
            $output .= '<div class="controls uk-visible@s">
            <a class="uk-position-center-left-out uk-position-small" uk-slidenav-previous></a>
            <a class="uk-position-center-right-out uk-position-small" uk-slidenav-next></a>
        </div>';
            $jstext     .=      '"controlsContainer": "'.$addon_id.' .controls","controls": true,';
        } else {
            $jstext     .=   '"controls": false,';
        }
        $output .= '</div>';
        if ($controls) {
            $jstext     .=      '"nav": true,';
        } else {
            $jstext     .=      '"nav": false,';
        }
        $output .= '<script type="text/javascript">
    var timeline_top_'.$this->addon->id.' = tns({
    "container": "'.$addon_id.' .sppb-addon-horizontal-timeline-top-wrapper",
  "loop": false,
  "slideBy": "page",
  "responsive": {
    "350": {
      "items": 1
    },
    "992": {
      "items": 3
    }
  },
  "swipeAngle": false,
  "speed": 400,
  "gutter": 30,
  "nav": false,
  "controls": false,
  "mouseDrag": true
  });
  var timeline_point_'.$this->addon->id.' = tns({
    "container": "'.$addon_id.' .sppb-addon-horizontal-timeline-line",
  "loop": false,
  "slideBy": "page",
  "responsive": {
    "350": {
      "items": 1
    },
    "992": {
      "items": 3
    }
  },
  "swipeAngle": false,
  "speed": 400,
  "gutter": 30,
  "nav": false,
  "controls": false,
  "mouseDrag": true
  });
  var timeline_down_'.$this->addon->id.' = tns({
    "container": "'.$addon_id.' .sppb-addon-horizontal-timeline-down-wrapper",
    '.$jstext.'
  "loop": false,
  "slideBy": "page",
  "responsive": {
    "350": {
      "items": 1
    },
    "992": {
      "items": 3
    }
  },
  "swipeAngle": false,
  "speed": 400,
  "gutter": 30,
  "mouseDrag": true
  });
    timeline_top_'.$this->addon->id.'.events.on("indexChanged", function (info,eventName){
        if (timeline_down_'.$this->addon->id.'.getInfo().index !== info.index) {timeline_down_'.$this->addon->id.'.goTo(info.index);}
        if (timeline_point_'.$this->addon->id.'.getInfo().index !== info.index) {timeline_point_'.$this->addon->id.'.goTo(info.index);}
    });
    timeline_point_'.$this->addon->id.'.events.on("indexChanged", function (info,eventName){
        if (timeline_top_'.$this->addon->id.'.getInfo().index !== info.index) {timeline_top_'.$this->addon->id.'.goTo(info.index);}
        if (timeline_down_'.$this->addon->id.'.getInfo().index !== info.index) {timeline_down_'.$this->addon->id.'.goTo(info.index);}
    });
    timeline_down_'.$this->addon->id.'.events.on("indexChanged", function (info,eventName){
        if (timeline_top_'.$this->addon->id.'.getInfo().index !== info.index) {timeline_top_'.$this->addon->id.'.goTo(info.index);}
        if (timeline_point_'.$this->addon->id.'.getInfo().index !== info.index) {timeline_point_'.$this->addon->id.'.goTo(info.index);}
    });
</script>';
        return $output;
    }

    public function scripts() {
        return array(JURI::base(true) . '/media/jollyany/assets/js/vendor/tiny-slider.min.js');
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $settings = $this->addon->settings;
        $bar_color = (isset($this->addon->settings->bar_color) && $this->addon->settings->bar_color) ? $this->addon->settings->bar_color : '#ccc';
        $point_color = (isset($this->addon->settings->point_color) && $this->addon->settings->point_color) ? $this->addon->settings->point_color : '#fff';
        $timeline_badge_color = (isset($this->addon->settings->timeline_badge_color) && $this->addon->settings->timeline_badge_color) ? $this->addon->settings->timeline_badge_color : '#fff';
        $arrow_color = (isset($this->addon->settings->arrow_color) && $this->addon->settings->arrow_color) ? $this->addon->settings->arrow_color : '#ccc';
        $arrow_color_hover = (isset($this->addon->settings->arrow_color_hover) && $this->addon->settings->arrow_color_hover) ? $this->addon->settings->arrow_color_hover : '#ddd';
        $bullet_color = (isset($this->addon->settings->bullet_color) && $this->addon->settings->bullet_color) ? $this->addon->settings->bullet_color : '#ccc';
        $bullet_border_color = (isset($this->addon->settings->bullet_border_color) && $this->addon->settings->bullet_border_color) ? $this->addon->settings->bullet_border_color : '#ccc';
        $bullet_color_hover = (isset($this->addon->settings->bullet_color_hover) && $this->addon->settings->bullet_color_hover) ? $this->addon->settings->bullet_color_hover : '#aaa';
        $bullet_border_color_hover = (isset($this->addon->settings->bullet_border_color_hover) && $this->addon->settings->bullet_border_color_hover) ? $this->addon->settings->bullet_border_color_hover : '#aaa';

        $css = '';
        if ($bar_color) {
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .sppb-addon-horizontal-timeline-line:before, ' . $addon_id . ' .sppb-addon-horizontal-timeline .even > .timeline-badge:before{';
            $css .= 'background-color: ' . $bar_color . ';';
            $css .= '}';

            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-point .timeline-point-content:before{';
            $css .= 'border-color: ' . $bar_color . ';';
            $css .= '}';
        }
        if ($point_color) {
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-point .timeline-point-content:before{';
            $css .= 'background-color: ' . $point_color . ';';
            $css .= '}';
        }
        if ($timeline_badge_color) {
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-badge-top:before, '.$addon_id.' .sppb-addon-horizontal-timeline .timeline-badge-bottom:before{';
            $css .= 'background-color: ' . $timeline_badge_color . ';';
            $css .= '}';
        }
        if ($arrow_color) {
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .controls a{';
            $css .= 'color: ' . $arrow_color . ';';
            $css .= '}';
        }
        if ($arrow_color_hover) {
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .controls a:hover{';
            $css .= 'color: ' . $arrow_color_hover . ';';
            $css .= '}';
        }
        if ($bullet_color || $bullet_border_color) {
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .tns-nav button{';
            $css .= 'background-color: ' . $bullet_color . ';';
            $css .= 'border-color: ' . $bullet_border_color . ';';
            $css .= '}';
        }
        if ($bullet_color_hover || $bullet_border_color_hover) {
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .tns-nav button.tns-nav-active, '.$addon_id.' .sppb-addon-horizontal-timeline .tns-nav button:hover, '.$addon_id.' .sppb-addon-horizontal-timeline .tns-nav button:focus{';
            $css .= 'background-color: ' . $bullet_color_hover . ';';
            $css .= 'border-color: ' . $bullet_border_color_hover . ';';
            $css .= '}';
        }

        //Title style
        $title_style = '';
        $title_style .= (isset($settings->title_color) && $settings->title_color) ? 'color:'.$settings->title_color . ';' : '';
        if (isset($settings->title_font_size->md)) $settings->title_font_size = $settings->title_font_size->md;
        $title_style .= (isset($settings->title_font_size) && $settings->title_font_size) ? 'font-size:'.$settings->title_font_size . 'px;' : '';
        if (isset($settings->title_line_height->md)) $settings->title_line_height = $settings->title_line_height->md;
        $title_style .= (isset($settings->title_line_height) && $settings->title_line_height) ? 'line-height:'.$settings->title_line_height . 'px;' : '';
        $title_style .= (isset($settings->title_letterspace) && $settings->title_letterspace) ? 'letter-spacing:'.$settings->title_letterspace . ';' : '';
        $title_style .= (isset($settings->title_margin_top) && $settings->title_margin_top) ? 'margin-top:'.$settings->title_margin_top . 'px;' : '';
        $title_style .= (isset($settings->title_margin_bottom) && $settings->title_margin_bottom) ? 'margin-bottom:'.$settings->title_margin_bottom . 'px;' : '';
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
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .title {';
            $css .= $title_style;
            $css .= '}';
        }

        //Content style
        $content_style ='';
        $content_style .= (isset($settings->content_color) && $settings->content_color) ? 'color:' . $settings->content_color . ';' : '';
        if (isset($settings->content_lineheight->md)) $settings->content_lineheight = $settings->content_lineheight->md;
        $content_style .= (isset($settings->content_lineheight) && $settings->content_lineheight) ? 'line-height:' . $settings->content_lineheight . 'px;' : '';
        if (isset($settings->content_fontsize->md)) $settings->content_fontsize = $settings->content_fontsize->md;
        $content_style .= (isset($settings->content_fontsize) && $settings->content_fontsize) ? 'font-size:' . $settings->content_fontsize . 'px;' : '';
        if (isset($settings->content_padding->md)) $settings->content_padding = $settings->content_padding->md;
        $content_style .= (isset($settings->content_padding) && trim($settings->content_padding)) ? 'padding:' . $settings->content_padding . ';' : '';
        if (isset($settings->content_margin->md)) $settings->content_margin = $settings->content_margin->md;
        $content_style .= (isset($settings->content_margin) && trim($settings->content_margin)) ? 'margin:' . $settings->content_margin . ';' : '';
        $content_font_style = (isset($settings->content_font_style) && $settings->content_font_style) ? $settings->content_font_style : '';

        if(isset($content_font_style->underline) && $content_font_style->underline){
            $content_style .= 'text-decoration:underline;';
        }
        if(isset($content_font_style->italic) && $content_font_style->italic){
            $content_style .= 'font-style:italic;';
        }
        if(isset($content_font_style->uppercase) && $content_font_style->uppercase){
            $content_style .= 'text-transform:uppercase;';
        }
        if(!isset($content_font_style->weight)){
            $content_style .= 'font-weight:400;';
        }
        if(isset($content_font_style->weight) && $content_font_style->weight){
            $content_style .= 'font-weight:'.$content_font_style->weight.';';
        }
        if($content_style){
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .details {';
            $css .= $content_style;
            $css .= '}';
        }

        //Title style
        $date_style = '';
        $date_style .= (isset($settings->date_color) && $settings->date_color) ? 'color:'.$settings->date_color . ';' : '';
        if (isset($settings->date_font_size->md)) $settings->date_font_size = $settings->date_font_size->md;
        $date_style .= (isset($settings->date_font_size) && $settings->date_font_size) ? 'font-size:'.$settings->date_font_size . 'px;' : '';
        if (isset($settings->date_line_height->md)) $settings->date_line_height = $settings->date_line_height->md;
        $date_style .= (isset($settings->date_line_height) && $settings->date_line_height) ? 'line-height:'.$settings->date_line_height . 'px;' : '';
        $date_style .= (isset($settings->date_letterspace) && $settings->date_letterspace) ? 'letter-spacing:'.$settings->date_letterspace . ';' : '';
        $date_style .= (isset($settings->date_margin_top) && $settings->date_margin_top) ? 'margin-top:'.$settings->date_margin_top . 'px;' : '';
        $date_style .= (isset($settings->date_margin_bottom) && $settings->date_margin_bottom) ? 'margin-bottom:'.$settings->date_margin_bottom . 'px;' : '';
        $date_font_style = (isset($settings->date_font_style) && $settings->date_font_style) ? $settings->date_font_style : '';
        if(isset($date_font_style->underline) && $date_font_style->underline){
            $date_style .= 'text-decoration:underline;';
        }
        if(isset($date_font_style->italic) && $date_font_style->italic){
            $date_style .= 'font-style:italic;';
        }
        if(isset($date_font_style->uppercase) && $date_font_style->uppercase){
            $date_style .= 'text-transform:uppercase;';
        }
        if(isset($date_font_style->weight) && $date_font_style->weight){
            $date_style .= 'font-weight:'.$date_font_style->weight.';';
        }
        if($date_style){
            $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .timeline-date {';
            $css .= $date_style;
            $css .= '}';
        }

        //Tablet style
        $title_font_size_sm = (isset($settings->title_font_size_sm) && $settings->title_font_size_sm) ? 'font-size:' . $settings->title_font_size_sm . 'px;' : '';
        $title_line_height_sm = (isset($settings->title_line_height_sm) && $settings->title_line_height_sm) ? 'line-height:' . $settings->title_line_height_sm . 'px;' : '';
        $title_margin_top_sm = (isset($settings->title_margin_top_sm) && $settings->title_margin_top_sm) ? 'margin-top:' . $settings->title_margin_top_sm . 'px;' : '';
        $title_margin_bottom_sm = (isset($settings->title_margin_bottom_sm) && $settings->title_margin_bottom_sm) ? 'margin-bottom:' . $settings->title_margin_bottom_sm . 'px;' : '';
        $content_fontsize_sm = (isset($settings->content_fontsize_sm) && $settings->content_fontsize_sm) ? 'font-size:' . $settings->content_fontsize_sm . 'px;' : '';
        $content_lineheight_sm = (isset($settings->content_lineheight_sm) && $settings->content_lineheight_sm) ? 'line-height:' . $settings->content_lineheight_sm . 'px;' : '';
        $content_margin_sm = (isset($settings->content_margin_sm) && trim($settings->content_margin_sm)) ? 'margin:' . $settings->content_margin_sm . ';' : '';
        $content_padding_sm = (isset($settings->content_padding_sm) && trim($settings->content_padding_sm)) ? 'padding:' . $settings->content_padding_sm . ';' : '';
        $date_font_size_sm = (isset($settings->date_font_size_sm) && $settings->date_font_size_sm) ? 'font-size:' . $settings->date_font_size_sm . 'px;' : '';
        $date_line_height_sm = (isset($settings->date_line_height_sm) && $settings->date_line_height_sm) ? 'line-height:' . $settings->date_line_height_sm . 'px;' : '';
        $date_margin_top_sm = (isset($settings->date_margin_top_sm) && $settings->date_margin_top_sm) ? 'margin-top:' . $settings->date_margin_top_sm . 'px;' : '';
        $date_margin_bottom_sm = (isset($settings->date_margin_bottom_sm) && $settings->date_margin_bottom_sm) ? 'margin-bottom:' . $settings->date_margin_bottom_sm . 'px;' : '';

        if( $content_fontsize_sm || $content_margin_sm || $content_padding_sm || $title_font_size_sm || $title_line_height_sm || $title_margin_top_sm || $title_margin_bottom_sm || $content_lineheight_sm || $date_font_size_sm || $date_line_height_sm || $date_margin_top_sm || $date_margin_bottom_sm){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if ($content_fontsize_sm || $content_lineheight_sm) {
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .details {';
                $css .= $content_fontsize_sm;
                $css .= $content_lineheight_sm;
                $css .= '}';
            }

            if ($content_margin_sm || $content_padding_sm) {
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .details {';
                $css .= $content_margin_sm;
                $css .= $content_padding_sm;
                $css .= '}';
            }

            if($title_font_size_sm || $title_line_height_sm || $title_margin_top_sm || $title_margin_bottom_sm){
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .title {';
                $css .= $title_font_size_sm;
                $css .= $title_line_height_sm;
                $css .= $title_margin_top_sm;
                $css .= $title_margin_bottom_sm;
                $css .= '}';
            }

            if($date_font_size_sm || $date_line_height_sm || $date_margin_top_sm || $date_margin_bottom_sm){
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .timeline-date {';
                $css .= $date_font_size_sm;
                $css .= $date_line_height_sm;
                $css .= $date_margin_top_sm;
                $css .= $date_margin_bottom_sm;
                $css .= '}';
            }

            $css .= '}';
        }

        //Phone style
        $title_font_size_xs = (isset($settings->title_font_size_xs) && $settings->title_font_size_xs) ? 'font-size:' . $settings->title_font_size_xs . 'px;' : '';
        $title_line_height_xs = (isset($settings->title_line_height_xs) && $settings->title_line_height_xs) ? 'line-height:' . $settings->title_line_height_xs . 'px;' : '';
        $title_margin_top_xs = (isset($settings->title_margin_top_xs) && $settings->title_margin_top_xs) ? 'margin-top:' . $settings->title_margin_top_xs . 'px;' : '';
        $title_margin_bottom_xs = (isset($settings->title_margin_bottom_xs) && $settings->title_margin_bottom_xs) ? 'margin-bottom:' . $settings->title_margin_bottom_xs . 'px;' : '';
        $content_fontsize_xs = (isset($settings->content_fontsize_xs) && $settings->content_fontsize_xs) ? 'font-size:' . $settings->content_fontsize_xs . 'px;' : '';
        $content_lineheight_xs = (isset($settings->content_lineheight_xs) && $settings->content_lineheight_xs) ? 'line-height:' . $settings->content_lineheight_xs . 'px;' : '';
        $content_margin_xs = (isset($settings->content_margin_xs) && trim($settings->content_margin_xs)) ? 'margin:' . $settings->content_margin_xs . ';' : '';
        $content_padding_xs = (isset($settings->content_padding_xs) && trim($settings->content_padding_xs)) ? 'padding:' . $settings->content_padding_xs . ';' : '';
        $date_font_size_xs = (isset($settings->date_font_size_xs) && $settings->date_font_size_xs) ? 'font-size:' . $settings->date_font_size_xs . 'px;' : '';
        $date_line_height_xs = (isset($settings->date_line_height_xs) && $settings->date_line_height_xs) ? 'line-height:' . $settings->date_line_height_xs . 'px;' : '';
        $date_margin_top_xs = (isset($settings->date_margin_top_xs) && $settings->date_margin_top_xs) ? 'margin-top:' . $settings->date_margin_top_xs . 'px;' : '';
        $date_margin_bottom_xs = (isset($settings->date_margin_bottom_xs) && $settings->date_margin_bottom_xs) ? 'margin-bottom:' . $settings->date_margin_bottom_xs . 'px;' : '';

        if($content_fontsize_xs || $content_margin_xs || $content_padding_xs || $title_font_size_xs || $title_line_height_xs || $title_margin_top_xs || $title_margin_bottom_xs || $content_lineheight_xs || $date_font_size_xs || $date_line_height_xs || $date_margin_top_xs || $date_margin_bottom_xs){
            $css .= '@media (max-width: 767px) {';
            if ($content_fontsize_xs || $content_lineheight_xs) {
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .details {';
                $css .= $content_fontsize_xs;
                $css .= $content_lineheight_xs;
                $css .= '}';
            }

            if ($content_margin_xs || $content_padding_xs) {
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .details {';
                $css .= $content_margin_xs;
                $css .= $content_padding_xs;
                $css .= '}';
            }

            if($title_font_size_xs || $title_line_height_xs || $title_margin_top_xs || $title_margin_bottom_xs){
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .title {';
                $css .= $title_font_size_xs;
                $css .= $title_line_height_xs;
                $css .= $title_margin_top_xs;
                $css .= $title_margin_bottom_xs;
                $css .= '}';
            }

            if($date_font_size_xs || $date_line_height_xs || $date_margin_top_xs || $date_margin_bottom_xs){
                $css .= $addon_id . ' .sppb-addon-horizontal-timeline .timeline-item .timeline-date {';
                $css .= $date_font_size_xs;
                $css .= $date_line_height_xs;
                $css .= $date_margin_top_xs;
                $css .= $date_margin_bottom_xs;
                $css .= '}';
            }
            $css .= '}';
        }

        return $css;
    }
}
