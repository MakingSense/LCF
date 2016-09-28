<?php
/**
 *
 * RS Google Map
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_google_map( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'latidude'      => '',
    'longitude'     => '',
    'zoom_size'     => '',
    'custom_marker' => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $data_marker = '';
  if(is_numeric($custom_marker) && !empty($custom_marker)) {
    $marker_src = wp_get_attachment_image_src( $custom_marker, 'full' );
    $data_marker = (isset($marker_src[0])) ? ' data-custom-marker="'.esc_attr($marker_src[0]).'"':'';
  }

  $output = '<div '.$id.' class="sc-google-map'.$class.'" data-address="Something" data-latitude="'.esc_attr($latidude).'" data-longitude="'.esc_attr($longitude).'" data-zoom="'.esc_attr($zoom_size).'"'.$data_marker.'></div>';

  wp_enqueue_script( 'gmapsensor' );

  return $output;
}
add_shortcode('rs_google_map', 'rs_google_map');
