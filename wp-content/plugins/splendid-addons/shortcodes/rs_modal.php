<?php
/**
 *
 * Modal
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_modal( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'class'         => '',
    'modal_id'      => '',
    'title'         => '',
    'cf7_shortcode' => ''
  ), $atts ) );

  $class = ( $class ) ? 'class="'. sanitize_html_classes($class).'"' : '';

  $output  =  '<div class="modal fade'.$class.'" id="'.esc_attr($modal_id).'" tabindex="-1" role="dialog" aria-labelledby="'.esc_attr($modal_id).'" aria-hidden="true">';
  $output .=  '<div class="modal-dialog">';
  $output .=  '<div class="modal-content">';
  $output .=  '<div class="modal-header">';
  $output .=  '<h4 class="modal-title">'.esc_html($title).'</h4>';
  $output .=  '</div>';
  $output .=  '<div class="modal-body">';
  $output .=  rs_set_wpautop($content);
  $output .=  '</div>';
  $output .=  '<div class="modal-footer">';
  $output .=  do_shortcode( wp_kses_post($cf7_shortcode));
  $output .=  '</div>';
  $output .= '</div>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_modal', 'rs_modal' );
