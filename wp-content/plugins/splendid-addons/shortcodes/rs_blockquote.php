<?php
/**
 *
 * Blockquote
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_blockquote( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'              => '',
    'class'           => '',
    'bg_color'        => '',
    'cite'            => '',
    'custom_bg_color' => '',
    'text_color'      => '',
    'cite_color'      => ''
  ), $atts ) );

  $id              = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class           = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $custom_bg_color = ( $custom_bg_color ) ? 'background:'.$custom_bg_color.' !important;':'';
  $text_color      = ( $text_color ) ? 'color:'.$text_color.' !important;':'';
  $el_merge_color  = ( $custom_bg_color || $text_color ) ? ' style="'.esc_attr($custom_bg_color.$text_color).'"':'';
  $cite_color      = ( $cite_color ) ? ' style="color:'.esc_attr($cite_color).';"':'';

  $output  = '<blockquote '.$id.' class="'.sanitize_html_class($bg_color).' color-white'.$class.'"'.$el_merge_color.'>';
  $output .=  '<span class="quote-content">“'.wp_kses_data($content).'”</span>';
  $output .=  (!empty($cite)) ? '<span class="quote-author"'.$cite_color.'>- '.esc_html($cite).'</span>':'';
  $output .=  '</blockquote>';

  return $output;

}
add_shortcode( 'rs_blockquote', 'rs_blockquote' );
