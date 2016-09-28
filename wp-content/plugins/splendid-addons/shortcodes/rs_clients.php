<?php
/**
 *
 * Clients
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_client( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  if(empty($content)) { return; }

  $output  =  '<div '.$id.' class="client-logo align-center'.$class.'">';
  $output .=  do_shortcode($content);
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_client', 'rs_client' );

function rs_client_item($atts, $content = '', $id = '') {
  extract( shortcode_atts( array(
    'images'          => '',
    'tooltip_text'    => '',
    'hover_effect'    => 'hvr-off',
    'animation'       => '',
    'animation_delay' => ''
  ), $atts ) );

  $animation       = ( $animation ) ? ' wow '.$animation:'';
  $animation_delay = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';

  $output = '';
  if(!empty($images) && is_numeric($images)) {
    $image_src = wp_get_attachment_image_src( $images, 'full' );
    if(isset($image_src[0])) {
      $output .=  '<div class="image-client-block '.$hover_effect.$animation.'"'.$animation_delay.'>';
      $output .=  ( $tooltip_text ) ? '<h6 class="image-tooltip">'.esc_html($tooltip_text).'</h6>':'';
      $output .=  '<img src="'.esc_url($image_src[0]).'" alt="">';
      $output .=  '</div>';
    }
  }
  return $output;
}

add_shortcode('rs_client_item', 'rs_client_item');