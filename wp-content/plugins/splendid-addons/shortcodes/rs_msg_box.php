<?php
/**
 *
 * RS Message Box
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_msg_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'               => '',
    'class'            => '',
    'box_type'         => 'alert',
    'icon'             => '',
    'border_style'     => '',
    'border_color'     => '',
    'background_color' => '',
    'text_color'       => '',

  ), $atts ) );


  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $background_color = ( $background_color ) ? 'background-color:'.$background_color.';':'';
  $border_color     = ( $border_color ) ? 'border-color:'.$border_color.';':'';
  $text_color       = ( $text_color ) ? 'color:'.$text_color.';':'';
  $border_style     = ( $border_style ) ? ' '.sanitize_html_classes($border_style):'';

  $el_style         = ($background_color || $border_color || $text_color ) ? 'style="'.esc_attr($background_color.$text_color.$border_color).'"':'';


  $output  =  '<div class="alert-box '.sanitize_html_classes($box_type).''.$class.$border_style.'" '.$el_style.''.$id.'>';
  $output .=  '<i class="fa-lg '.sanitize_html_classes($icon).'"></i> <p>'.do_shortcode(wp_kses_data($content)).'</p>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_msg_box', 'rs_msg_box');
