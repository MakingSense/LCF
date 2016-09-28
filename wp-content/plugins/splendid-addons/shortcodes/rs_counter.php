<?php
/**
 *
 * Counter Box
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_counter( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'              => '',
    'class'           => '',
    'style'           => 'style1',
    'count_no'        => '',
    'align'           => 'align-left',
    'icon'            => '',
    'counter_content' => '',
    'count_no_color'  => '',
    'content_color'   => '',
    'icon_color'      => '',
    'sep_color'       => ''

  ), $atts ) );

  $id                = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class             = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $el_count_no_color = ( $count_no_color ) ? ' style="color:'.esc_attr($count_no_color).';"':'';
  $el_content_color  = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';
  $el_sep_color      = ( $sep_color ) ? ' style="border-color:'.esc_attr($sep_color).';"':'';
  $el_icon_color     = ( $icon_color ) ? ' style="color:'.esc_attr($icon_color).';"':'';

  $output = '';
  switch ($style) {
    case 'style1':
      $output .=  '<div '.$id.' class="counter-box style1'.$class.'">';
      $output .=  '<span class="sc-counter"'.$el_count_no_color.'>'.esc_html($count_no).'</span>';
      $output .=  '<span class="counter-separator"></span>';
      $output .=  '<h6'.$el_content_color.'>'.esc_html($counter_content).'</h6>';
      $output .=  '</div>';
      break;

    case 'style3':
      $output .=  '<div '.$id.' class="counter-box style4 '.$align.' color-light'.$class.'">';
      $output .=  '<span class="sc-counter" data-value="'.esc_attr($count_no).'"'.$el_count_no_color.'>'.esc_html($count_no).'</span>';
      $output .=  '<span class="counter-sufix"'.$el_count_no_color.'>'.esc_html__('+', 'splendid-addons').'</span>';
      $output .=  rs_set_wpautop($content);
      $output .=  '</div>';
      break;

    case 'style4':
      $output  = '<div '.$id.' class="counter-box bold'.$class.'">';
      $output .=  '<span class="sc-counter'.$el_count_no_color.'">'.esc_html($count_no).'</span>';
      $output .=  '<h6'.$el_content_color.'>'.esc_html($counter_content).'</h6>';
      $output .=  '</div>';
      break;

    case 'style2':
    default:
      $output .=  '<div '.$id.' class="counter-box style3'.$class.'">';
      $output .=  '<i class="'.esc_attr($icon).'"'.$el_icon_color.'></i>';
      $output .=  '<span class="sc-counter"'.$el_count_no_color.'>'.esc_html($count_no).'</span>';
      $output .=  '<span class="counter-separator"'.$el_sep_color.'></span>';
      $output .=  '<h6'.$el_content_color.'>'.esc_html($counter_content).'</h6>';
      $output .=  '</div>';
      break;
  }

  return $output;

}
add_shortcode( 'rs_counter', 'rs_counter' );
