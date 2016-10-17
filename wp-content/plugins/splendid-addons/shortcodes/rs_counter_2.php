<?php

/**
 *
 * RS Counter Box 2
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_counter_2($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'id'    => '',
    'class' => '',
  ), $atts));

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

  $output  =  '<div '.$id.' class="counter-row row'.$class.'">';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .= '</div>';

  return $output;
}

add_shortcode('rs_counter_2', 'rs_counter_2');

function rs_counter_2_item($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'count_no'       => '',
    'count_no_color' => '',
    'bg_color'       => '',
    'content_color'  => '',
  ), $atts));

  $count_no_color    = ( $count_no_color ) ? 'color:'.$count_no_color.';':'';
  $bg_color          = ( $bg_color ) ? 'background:'.$bg_color.';':'';
  $el_bg_count_style = ( $count_no_color || $bg_color ) ? ' style="'.esc_attr($count_no_color.$bg_color).'"':'';
  $content_color     = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';

  $output  = '';
  $output .=  '<div class="col-lg-one-fifth col-md-3 col-sm-3">';
  $output .=  '<div class="counter-box style2"'.$el_bg_count_style.'>';
  $output .=  '<span class="sc-counter">'.esc_html($count_no).'</span>';
  $output .=  '<span class="counter-separator"></span>';
  $output .=  '<h6'.$content_color.'>'.wp_kses_data($content).'</h6>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_counter_2_item', 'rs_counter_2_item');
