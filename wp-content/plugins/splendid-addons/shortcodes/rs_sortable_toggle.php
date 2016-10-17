<?php
/**
 *
 * CS Sortable Toggle
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function cs_faq( $atts, $content = '', $id = '' ) {

  global $cs_faqs;
  $cs_faqs = array();

  extract( shortcode_atts( array(
    'id'        => '',
    'class'     => '',
  ), $atts ) );

  do_shortcode( $content );

  // is not empty clients
  if( empty( $cs_faqs ) ) { return; }

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_classes($class) : '';

  $output  =  '<div class="sortable-accordion">';
  $output .=  '<ul class="accordion-filters">';
  $output .=  '<li class="filter" data-filter="all">All</li>';
  foreach ( $cs_faqs as $key => $faq ) {
    $output  .= '<li class="filter" data-filter=".'. sanitize_title( $faq['atts']['title'] ) .'">'. esc_html($faq['atts']['title']) .'</li>';
  }
  $output .=  '</ul>';

  $output  .= '<div class="ts-sortable-isotope">';
  foreach ( $cs_faqs as $key => $faq ) {
    $output  .= '<div class="ts-toggle-item mix '. sanitize_title( $faq['atts']['title'] ) .'">';
    $output  .= do_shortcode( $faq['content'] );
    $output  .= '</div>';
  }
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;

}
add_shortcode('cs_faq', 'cs_faq');


/**
 *
 * CS Tab
 * @version 1.0.0
 * @since 1.0.0
 *
 */
function cs_faq_block( $atts, $content = '', $id = '' ) {
  global $cs_faqs;
  $cs_faqs[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}
add_shortcode('cs_faq_block', 'cs_faq_block');
