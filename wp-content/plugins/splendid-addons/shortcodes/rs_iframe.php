<?php
/**
 *
 * Iframe
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_iframe( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',
  ), $atts ) );

  $id       = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class    = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  return '<div '.$id.' class="ts-iframe'.$class.'">'. rawurldecode( base64_decode( strip_tags( $content ) ) ) .'</div>';

}
add_shortcode( 'rs_iframe', 'rs_iframe' );
