<?php
/**
 *
 * RS Toggle
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_toggle( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'title'         => '',
    'icon'          => '',
    'no_icon'       => '',
    'mix_class'     => '',
    'icon_color'    => '',
    'title_color'   => '',
    'border_color'  => '',
    'open'          => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output  =  '<ul '.$id.' class="accordions toggles'.$class.'">';
  $output .=  '<li class="accordion">';
  $output .=  '<div class="accordion-header">';
  $output .=  '<div class="accordion-icon"></div>';
  $output .=  '<h6>'.esc_html($title).'</h6>';
  $output .=  '</div>';
  $output .=  '<div class="accordion-content">';
  $output .=  rs_set_wpautop( $content );
  $output .=  '</div>';
  $output .=  '</li>';
  $output .=  '</ul>';

  return $output;
}
add_shortcode('rs_toggle', 'rs_toggle');
add_shortcode('vc_toggle', 'rs_toggle');
