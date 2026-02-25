<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonAudio_Playlist  extends SppagebuilderAddons{

	public function render() {
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
        $player_id = 'sppb-addon-player' . $this->addon->id;
        $container_id = 'sppb-addon-container' . $this->addon->id;
		$output  = '<div class="sppb-addon sppb-addon-audio-playlist ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';
		$output .= '<div id="'.$player_id.'" class="jp-jplayer"></div>';
		$output .= '<div id="'.$container_id.'" class="jp-audio" role="application" aria-label="media player">';
		$output .= '<div class="jp-type-playlist">
		<div class="jp-gui jp-interface">
			<div class="jp-controls">
				<button class="jp-previous" role="button" tabindex="0"></button>
				<button class="jp-play" role="button" tabindex="0"></button>
				<button class="jp-next" role="button" tabindex="0"></button>
				<button class="jp-stop" role="button" tabindex="0"></button>
			</div>
			<div class="jp-progress">
				<div class="jp-seek-bar">
					<div class="jp-play-bar"></div>
				</div>
			</div>
			<div class="jp-volume-controls">
				<button class="jp-mute" role="button" tabindex="0"></button>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
				<button class="jp-volume-max" role="button" tabindex="0"></button>
			</div>
		</div>
		<div class="jp-playlist">
			<ul class="uk-list uk-list-decimal">
				<!-- The method Playlist.displayPlaylist() uses this unordered list -->
				<li>&nbsp;</li>
			</ul>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>';
		$output	.= '</div>';
		$output	.= '</div>';
		$output .= '</div>';
		return $output;
	}

    public function js() {
        $settings = $this->addon->settings;
        $player_id = '#sppb-addon-player' . $this->addon->id;
        $container_id = '#sppb-addon-container' . $this->addon->id;
        $autoplay = (isset($settings->autoplay) && $settings->autoplay) ? $settings->autoplay : 0;
        $autoplay = ($autoplay) ? 'true' : 'false';
        $js       = '';
        if(isset($this->addon->settings->sp_audio_item) && count((array) $this->addon->settings->sp_audio_item)) {
            $list   =   (array) $this->addon->settings->sp_audio_item;
            $js ="jQuery(document).ready(function($){'use strict';
                var myPlaylist = new jPlayerPlaylist({
                        jPlayer: \"$player_id\",
						cssSelectorAncestor: \"$container_id\"
                    }, [
            ";
            $url = JURI::base();
            $songs  =   array();
            foreach ($list as $key => $value) {
                $value->title       =   (isset($value->title) && $value->title) ? $value->title : '';
                $value->artist      =   (isset($value->artist) && $value->artist) ? $value->artist : '';
                $value->mp3_link    =   (isset($value->mp3_link) && $value->mp3_link) ? $value->mp3_link : '';
                $value->ogg_link    =   (isset($value->ogg_link) && $value->ogg_link) ? $value->ogg_link : '';
                $song    =   '{
                    title:"'.$value->title.'",
                    artist:"'.$value->artist.'",';
                $audio_link =   array();
                if($value->mp3_link) {
                    $audio_link[]   = 'mp3:"'.$url.$value->mp3_link.'"';
                }
                if($value->ogg_link) {
                    $audio_link[]   = 'oga:"' . $url . $value->ogg_link . '"';
                }
                $song   .=  implode(',', $audio_link);
                $song   .=  '}';
                $songs[]    =   $song;
            }

            $js     .=  implode(',', $songs);
            $js     .=  '], {
                swfPath: "'.$url.'media/jollyany/assets/jPlayer",
                supplied: "oga, mp3",
                wmode: "window",
				useStateClassSkin: true,
				autoBlur: false,
				smoothPlayBar: true,
				keyEnabled: true,
				remainingDuration: true,
				toggleDuration: true
            });
            });';
        }

        return $js;
    }

    public function stylesheets() {
        $styles     =   array();
        $styles[]   =   'media/jollyany/assets/jPlayer/css/jplayer.blue.monday.min.css';
        return $styles;
    }

    public function scripts() {
        $scripts     =   array();
        $scripts[]   =   'media/jollyany/assets/jPlayer/jquery.jplayer.min.js';
        $scripts[]   =   'media/jollyany/assets/jPlayer/jplayer.playlist.min.js';
        return $scripts;
    }

    public function css() {
        $settings           = $this->addon->settings;
        $addon_id           = '#sppb-addon-container' . $this->addon->id;
        $css = '';
        if(isset($this->addon->settings->sp_audio_item) && count((array) $this->addon->settings->sp_audio_item)) {
            $list   =   (array) $this->addon->settings->sp_audio_item;
            $playlist_item      =   array();
            foreach ($list as $key => $value) {
                $media_item         =       (isset($value->media_item) && $value->media_item) ? $value->media_item : '';
                $image_src          =       isset( $media_item->src ) ? $media_item->src : $media_item;

                if ( strpos( $image_src, 'http://' ) !== false || strpos( $image_src, 'https://' ) !== false ) {
                    $image_src = $image_src;
                } elseif ( $image_src ) {
                    $image_src = JURI::base( true ) . '/' . $image_src;
                }
                $playlist_item[]    =       $addon_id . ' .jp-playlist > ul > li:nth-child('.($key + 1).') > div:before {background: url("' . $image_src . '"); width: 50px; height: 50px; background-size: cover; background-position: center;}';
            }
        }
        $css    .=  implode('', $playlist_item);

        return $css;
    }
}
