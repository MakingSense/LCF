<?php
/**
 *
 * Divider
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_link_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'style'         => '',
    'big_heading'   => '',
    'small_heading' => '',
    'border_width'  => 'br-light',
    'btn_text'      => '',
    'btn_style'     => 'flat',
    'btn_color'     => '',
    'btn_link'      => '',

    //color
    'big_heading_color'      => '',
    'small_heading_color'    => '',
    'heading_border_color'   => '',
    'content_color'          => '',
    'border_color'           => '',
    'background_color'       => '',
    'text_color'             => '',
    'border_color_hover'     => '',
    'background_color_hover' => '',
    'text_color_hover'       => '',
  ), $atts ) );

  $id                   = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class                = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $small_heading_color  = ( $small_heading_color ) ? ' style="color:'.esc_attr($small_heading_color).';"':'';
  $content_color        = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';
  $big_heading_color    = ( $big_heading_color ) ? ' color:'.esc_attr($big_heading_color).';':'';
  $heading_border_color = ( $heading_border_color ) ? 'border-color:'.esc_attr($heading_border_color).';':'';
  $el_big_heading       = ( $heading_border_color || $big_heading_color ) ? ' style="'.$big_heading_color.$heading_border_color.'"':'';

  $output  =  '<div class="link-box col-lg-6 col-md-6 col-sm-6'.$class.'" '.$id.'>';
  $output .=  '<h6 class="spaced"'.$small_heading_color.'>'.esc_html($small_heading).'</h6>';
  $output .=  '<h3 class="title"'.$el_big_heading.'>'.esc_html($big_heading).'</h3>';
  $output .=  '<p'.$content_color.'>'.do_shortcode($content).'</p>';
  if(!empty($btn_text) && !empty($btn_link)) {
    $output .=  rs_buttons(array(
      'btn_style'              => $btn_style,
      'btn_link'               => $btn_link,
      'btn_text'               => $btn_text,
      'btn_color'              => $btn_color,
      'border_width'           => $border_width,
      'border_color'           => $border_color,
      'text_color'             => $text_color,
      'background_color'       => $background_color,
      'border_color_hover'     => $border_color_hover,
      'background_color_hover' => $background_color_hover,
      'text_color_hover'       => $text_color_hover
    ));
  }
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_link_box', 'rs_link_box' );
