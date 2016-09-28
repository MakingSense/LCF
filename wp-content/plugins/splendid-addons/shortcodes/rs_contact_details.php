<?php
/**
 *
 * RS Contact Details
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_contact_details( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                => '',
    'class'             => '',
    'icon'              => '',
    'icon_color'        => '',
    'icon_border_color' => '',
    'content_color'     => '',
  ), $atts ) );

  $id                = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class             = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $icon_color        = ( $icon_color ) ? 'color:'.$icon_color.' !important;':'';
  $icon_border_color = ( $icon_border_color ) ? 'border-color:'.$icon_border_color.';':'';
  $content_color     = ( $content_color ) ? 'color:'.$content_color.';':'';
  $el_content_style  = ( $content_color ) ? ' style="'.esc_attr($content_color).'"':'';
  $el_icon_style     = ( $icon_color ) ? ' style="'.esc_attr($icon_color.$icon_border_color).'"':'';

  $output  = '<ul '.$id.' class="iconic-list style2'.$class.'">';
  $output .=  '<li'.$el_content_style.'>';
  $output .=  '<i class="'.esc_attr($icon).' color-blue"'.$el_icon_style.'></i>';
  $output .=  wp_kses_post($content);
  $output .=  '</li>';
  $output .=  '</ul>';

  return $output;
}

add_shortcode('rs_contact_details', 'rs_contact_details');
