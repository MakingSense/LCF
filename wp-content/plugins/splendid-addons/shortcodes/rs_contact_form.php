<?php
/**
 *
 * Contact Form
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_contact_form( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'      => '',
    'class'   => '',
    'form_id' => '',
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output  =  '<div '.$id.' class="rs-contact-form'.$class.'">';
  $output .=  do_shortcode(wp_kses_post('[contact-form-7 id="'.$form_id.'"]'));
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_contact_form', 'rs_contact_form' );

