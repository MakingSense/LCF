<?php
/**
 *
 * Dropcap
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_dropcap( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',
    'color' => '',
    'cap'   => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? 'class="'. sanitize_html_classes($class).'"' : '';
  $color =  str_replace('bg', 'color', $color);

  return '<p'.$class.$id.'><span class="dropcap '.sanitize_html_classes($color).'">'.esc_html($cap).'</span>'.do_shortcode(wp_kses_data($content)).'</p>';

}
add_shortcode( 'rs_dropcap', 'rs_dropcap' );
