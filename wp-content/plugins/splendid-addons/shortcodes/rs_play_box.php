<?php
/**
 *
 * Play Box
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_play_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'        => '',
    'class'     => '',
    'title'     => '',
    'video_url' => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output  =  '<div '.$id.' class="play-box'.$class.' color-light">';
  $output .=  '<header>';
  $output .=  '<span><span class="line"></span></span>';
  $output .=  '<span class="button-cell"><a href="'.esc_url($video_url).'" data-gal="prettyPhoto" class="button-play">Play</a></span>';
  $output .=  '<span><span class="line"></span></span>';
  $output .=  '</header>';
  $output .=  '<div class="play-box-content">';
  $output .=  '<h2>'.esc_html($title).'</h2>';
  $output .=  '<p>'.wp_kses_post($content).'</p>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_play_box', 'rs_play_box' );
