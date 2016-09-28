<?php
/**
 *
 * Promo Box With Border
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_promo_box_border( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                           => '',
    'class'                        => '',
    'heading'                      => '',
    'btn_text_one'                 => '',
    'btn_text_two'                 => '',
    'btn_link_one'                 => '',
    'btn_link_two'                 => '',
    'heading_color'                => '',
    'content_color'                => '',
    'border_color'                 => '',
    'btn_style'                    => '',
    'small_heading'                => '',
    'btn_color'                    => '',
    'border_width'                 => 'br-light',
    'btn_two_style'                => '',
    'btn_two_hover_effect'         => '',
    'btn_hover_effect'             => '',
    'overlay_one_background_color' => '',
    'overlay_two_background_color' => '',
    'btn_two_color'                => '',
    'border_two_width'             => 'br-light',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $border_color = ( $border_color ) ? ' style="border-color:'.esc_attr($border_color).';"':'';
  $heading_color = ( $heading_color ) ? ' style="color:'.esc_attr($heading_color).';"':'';
  $content_color = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';

  $output  = '<div '.$id.' class="content-box style10'.$class.'"'.$border_color.'>';
  $output .=  '<h1 class="extra-bold margin_b_15"'.$heading_color.'>'.esc_html($heading).'</h1>';
  $output .=  '<h3 class="margin_t_10 margin_b_35"'.$content_color.'>'.esc_html($small_heading).'</h3>';
  if(function_exists('rs_buttons')) {
    $output .=  rs_buttons(array(
      'btn_style'                => $btn_style,
      'btn_link'                 => $btn_link_one,
      'btn_text'                 => $btn_text_one,
      'btn_color'                => $btn_color,
      'border_width'             => $border_width,
      'btn_hover_effect'         => $btn_hover_effect,
      'overlay_background_color' => $overlay_one_background_color
    ));
    $output .=  rs_buttons(array(
      'btn_style'                => $btn_two_style,
      'btn_link'                 => $btn_link_two,
      'btn_text'                 => $btn_text_two,
      'btn_color'                => $btn_two_color,
      'border_width'             => $border_two_width,
      'btn_hover_effect'         => $btn_two_hover_effect,
      'overlay_background_color' => $overlay_two_background_color
    ));
  }
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_promo_box_border', 'rs_promo_box_border' );
