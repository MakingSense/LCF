<?php
/**
 *
 * Audio Player
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_audio_player( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'style'         => 'style1',
    'image'         => '',
    'audio_mp3_url' => '',
    'audio_ogg_url' => '',
    'track_name'    => '',
    'track_author'  => '',
    'bar_bg_color'  => ''
  ), $atts ) );

  wp_enqueue_script( 'audio' );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $custom_bg_color  = ( $bar_bg_color ) ? ' style="background:'.esc_attr($bar_bg_color).' !important;"':'';
  $image_html = '';
  if(!empty($image) && is_numeric($image)) {
    $image_url = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_url[0])) {
      $image_html = '<img src="'.esc_url($image_url[0]).'" alt="">';
    }
  }

  switch ($style) {
    case 'style1':
      $output  = '<div '.$id.' class="audio-player-box style1'.$class.'"'.$custom_bg_color.'>';
      $output .=  '<div class="featured-image">';
      $output .=  $image_html;
      $output .=  '</div>';
      $output .=  '<audio class="sc-audio-player">';
      $output .=  (!empty($audio_ogg_url)) ? '<source src="'.esc_url($audio_ogg_url).'">':'';
      $output .=  (!empty($audio_mp3_url)) ? '<source src="'.esc_url($audio_mp3_url).'">':'';
      $output .=  '</audio>';
      $output .=  '</div>';
      break;

    case 'style2':
      $output  = '<div '.$id.' class="audio-player-box style2 margin_t_0'.$class.'"'.$custom_bg_color.'>';
      $output .=  '<div class="featured-image">';
      $output .=  $image_html;
      $output .=  '</div>';
      $output .=  '<div class="track-info">';
      $output .=  '<h3 class="track-name">'.esc_html($track_name).'</h3>';
      $output .=  '<span class="track-author">by <strong>'.esc_html($track_author).'</strong></span>';
      $output .=  '</div>';
      $output .=  '<audio class="sc-audio-player">';
      $output .=  (!empty($audio_ogg_url)) ? '<source src="'.esc_url($audio_ogg_url).'">':'';
      $output .=  (!empty($audio_mp3_url)) ? '<source src="'.esc_url($audio_mp3_url).'">':'';
      $output .=  '</audio>';
      $output .=  '</div>';
      break;

    case 'style3':
      $output  = '<div '.$id.' class="audio-player-box style3 margin_t_0'.$class.'"'.$custom_bg_color.'>';
      $output .=  '<div class="featured-image">';
      $output .=  $image_html;
      $output .=  '</div>';
      $output .=  '<div>';
      $output .=  '<div class="track-info">';
      $output .=  '<h3 class="track-name">'.esc_html($track_name).'</h3>';
      $output .=  '<span class="track-author">by <strong>'.esc_html($track_author).'</strong></span>';
      $output .=  '</div>';
      $output .=  '<audio class="sc-audio-player">';
      $output .=  (!empty($audio_ogg_url)) ? '<source src="'.esc_url($audio_ogg_url).'">':'';
      $output .=  (!empty($audio_mp3_url)) ? '<source src="'.esc_url($audio_mp3_url).'">':'';
      $output .=  '</audio>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style4':
    default:
      $output  = '<div '.$id.' class="audio-player-box style4'.$class.'"'.$custom_bg_color.'>';
      $output .=  '<div class="track-info">';
      $output .=  '<h3 class="track-name">'.esc_html($track_name).'</h3>';
      $output .=  '<span class="track-author">by <strong>'.esc_html($track_author).'</strong></span>';
      $output .=  '</div>';
      $output .=  '<audio class="sc-audio-player">';
      $output .=  (!empty($audio_ogg_url)) ? '<source src="'.esc_url($audio_ogg_url).'">':'';
      $output .=  (!empty($audio_mp3_url)) ? '<source src="'.esc_url($audio_mp3_url).'">':'';
      $output .=  '</audio>';
      $output .=  '</div>';
      break;
  }

  return $output;

}
add_shortcode( 'rs_audio_player', 'rs_audio_player' );
