<?php
/**
 *
 * RS Newsletter
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_newsletter( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'title'        => '',
    'note'         => '',
    'button_color' => 'btn-blue',
    'align'        => 'newsletter-text text-center'
  ), $atts ) );


  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $button_color = ( $button_color ) ? ' '. sanitize_html_classes($button_color) : '';

  $output  =  '<div '.$id.' class="promo-box-inner'.$class.'">';
  $output .=  '<div class="newsletter-wrapper promo-box-content '.$align.$button_color.'">';
  $output .=  '<h2>'.esc_html($title).'</h2>';
  $output .=  '<h5 class="big">'.esc_html($note).'</h5>';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .=  '</div>';
  $output .=  '</div>';
  return $output;
}
add_shortcode('rs_newsletter', 'rs_newsletter');
