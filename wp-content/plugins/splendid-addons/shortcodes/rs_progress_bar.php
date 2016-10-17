<?php
/**
 *
 * Progress Bar
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_progress_bar( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'               => '',
    'class'            => '',
    'percent'          => '',
    'title'            => '',
    'bar_color'        => '',
    'bar_custom_color' => '',
    'title_color'      => ''

  ), $atts ) );

  $id                   = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class                = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $el_title_color       = ( $title_color ) ? ' style="color:'.esc_attr($title_color).';"':'';
  $el_custom_bar_color  = ( $bar_color == 'bg-custom-color' && $bar_custom_color) ? ' background:'.esc_attr($bar_custom_color).';':'';

  $output  = '<div '.$id.' class="progressbar"'.$class.'>';
  $output .=  '<h6'.$el_title_color.'>'.esc_html($title).'</h6>';
  $output .=  '<div class="progressbar-container" data-percent="'.esc_attr($percent).'">';
  $output .=  '<div class="progress-width '.sanitize_html_class($bar_color).'" style="width:'.esc_attr($percent).'%;'.$el_custom_bar_color.'">';
  $output .=  '<span class="progress-percent"></span>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  return $output;

}
add_shortcode( 'rs_progress_bar', 'rs_progress_bar' );
