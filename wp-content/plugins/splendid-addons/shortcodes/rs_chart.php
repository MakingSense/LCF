<?php
/**
 *
 * Chart
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_chart( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'              => '',
    'class'           => '',
    'size'            => 'small',
    'percent'         => '',
    'percent_color'   => '',
    'chart_content'   => '',
    'content_color'   => '',
    'track_color'     => '',
    'bar_color'       => '',
    'animation'       => '',
    'animation_delay' => ''

  ), $atts ) );

  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $size             = ( $size ) ? ' '.sanitize_html_classes($size):'';
  $el_percent_color = ( $percent_color ) ? ' style="color:'.esc_attr($percent_color).';"':'';
  $el_content_color = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';
  $animation        = ( $animation ) ? ' wow '.$animation:'';
  $animation_delay  = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';

  $output  = '<div '.$id.' class="circular-progressbar'.$class.$size.$animation.'"'.$el_percent_color.$animation_delay.'>';
  $output .= '<input type="text" value="'.esc_attr($percent).'" data-fgColor="'.esc_attr($bar_color).'" data-bgColor="'.esc_attr($track_color).'">';
  $output .=  '<h6'.$el_content_color.'>'.esc_html($chart_content).'</h6>';
  $output .=  '</div>';
  return $output;

}
add_shortcode( 'rs_chart', 'rs_chart' );
