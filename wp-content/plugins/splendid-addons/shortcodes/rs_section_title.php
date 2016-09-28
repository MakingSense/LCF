<?php
/**
 *
 * RS Section Title
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_section_title( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                  => '',
    'class'               => '',
    'title'               => '',
    'title_color'         => '',
    'content_color'       => '',
    'title_size'          => '',
    'content_size'        => '',
    'top'                 => '',
    'bottom'              => '',
    'content_top'         => '',
    'content_bottom'      => '',
    'title_font_weight'   => '',
    'content_font_weight' => ''

  ), $atts ) );

  $id                  = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class               = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $title_font_weight   = ( $title_font_weight ) ? ' '.sanitize_html_classes($title_font_weight):'';
  $content_font_weight = ( $content_font_weight ) ? ' '.sanitize_html_classes($content_font_weight):'';

  $title_color    = ( $title_color ) ? 'color:'.$title_color.';':'';
  $title_size     = ( $title_size ) ? 'font-size:'.$title_size.';':'';
  $top            = ( $top ) ? 'margin-top:'.$top.';':'';
  $bottom         = ( $bottom ) ? 'margin-bottom:'.$bottom.';':'';
  $content_color  = ( $content_color ) ? 'color:'.$content_color.';':'';
  $content_size   = ( $content_size ) ? 'font-size:'.$content_size.';':'';
  $content_top    = ( $content_top ) ? 'margin-top:'.$content_top.';':'';
  $content_bottom = ( $content_bottom ) ? 'margin-bottom:'.$content_bottom.';':'';

  $el_title_style = ( $title_size || $title_color || $top || $bottom ) ? 'style="'.esc_attr($title_color.$title_size.$top.$bottom).'"':'';
  $el_content_style = ( $content_size || $content_color || $content_top || $content_bottom ) ? 'style="'.esc_attr($content_color.$content_size.$content_top.$content_bottom).'"':'';

  $output  = '<div '.$id.' class="align-center'.$class.'">';
  $output .= '<h2 class="margin_b_0'.$title_font_weight.'"'.$el_title_style.'>'.esc_html($title).'</h2>';
  //$output .= ($content) ? '<h5 class="margin_t_10 margin_b_80'.$content_font_weight.'"'.$el_content_style.'>'.wp_kses_data($content).'</h5>':'';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_section_title', 'rs_section_title');
