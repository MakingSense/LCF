<?php
/**
 *
 * Chart
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_coming_soon_counter( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
    'year'   => '',
    'month'  => '',
    'day'    => '',
    'hour'   => '',
    'minute' => '',
    'second' => ''

  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $data_count_date = '';

  if($year && $month && $day && $hour && $minute && $second) {
    $data_count_date = ' data-countdate="'.esc_attr($year).'-'.esc_attr($month).'-'.esc_attr($day).'T'.esc_attr($hour).':'.esc_attr($minute).':'.esc_attr($second).'"';
  }


  $output  = '<div '.$id.' class="coming-soon-counter'.$class.'"'.$data_count_date.'>';
  $output .=  '<div>';
  $output .=  '<div class="counter-item">';
  $output .=  '<span class="c-days"></span>';
  $output .=  '<div class="divider unique light"></div>';
  $output .=  '<span class="label">Days</span>';
  $output .=  '</div>';
  $output .=  '<div class="counter-item">';
  $output .=  '<span class="c-hours"></span>';
  $output .=  '<div class="divider unique light"></div>';
  $output .=  '<span class="label">Hours</span>';
  $output .=  '</div>';
  $output .=  '<div class="counter-item">';
  $output .=  '<span class="c-minutes"></span>';
  $output .=  '<div class="divider unique light"></div>';
  $output .=  '<span class="label">Minutes</span>';
  $output .=  '</div>';
  $output .=  '<div class="counter-item">';
  $output .=  '<span class="c-seconds"></span>';
  $output .=  '<div class="divider unique light"></div>';
  $output .=  '<span class="label">Seconds</span>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  return $output;

}
add_shortcode( 'rs_coming_soon_counter', 'rs_coming_soon_counter' );
