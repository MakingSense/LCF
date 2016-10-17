<?php
/**
 *
 * RS Highlights
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_highlights( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'icon_bg_color' => '',
    'icon_style'    => '',
    'list_content'  => ''
  ), $atts ) );

  $id         = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class      = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $text_color = str_replace('bg-', 'color-', $text_color);

  return '<mark class="'.sanitize_html_class($bg_color).' '.sanitize_html_class($text_color).'">'.do_shortcode(wp_kses_post($content)).'</mark>';
}

add_shortcode('rs_highlights', 'rs_highlights');
