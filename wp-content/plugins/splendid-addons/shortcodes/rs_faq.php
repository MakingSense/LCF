<?php
/**
 *
 * FAQ
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_faq( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',
    'title' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output  = '<div '.$id.' class="faq-item'.$class.'">';
  $output .=  '<h5><strong>'.esc_html($title).'</strong></h5>';
  $output .=  rs_set_wpautop($content);
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_faq', 'rs_faq' );
