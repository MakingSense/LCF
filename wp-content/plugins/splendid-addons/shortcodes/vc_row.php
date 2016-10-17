<?php
/**
 *
 * VC Row
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_row( $atts, $content = '', $key = '' ) {
  $defaults = array(
    'id'                          => '',
    'class'                       => '',
    'padding_top'                 => '',
    'padding_bottom'              => '',
    'margin_top'                  => '',
    'margin_bottom'               => '',
    'fluid'                       => 'no',
    'attributes'                  => '',
    'bg_position'                 => '',
    'custom_position'             => '',
    'bg_size'                     => '',
    'custom_size'                 => '',
    'css'                         => '',
    'parallax'                    => 'no',
    'parallax_stellar_ratio'      => 0.5,
    'parallax_stellar_hor_offset' => 0,
    'parallax_stellar_ver_offset' => 0,
  );

  extract( shortcode_atts( $defaults, $atts ) );

  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $padding_top        = ( $padding_top ) ? ' '.sanitize_html_classes($padding_top) : '';
  $padding_bottom     = ( $padding_bottom ) ? ' '.sanitize_html_classes($padding_bottom) : '';
  $margin_top         = ( $margin_top ) ? ' '.sanitize_html_classes($margin_top) : '';
  $margin_bottom      = ( $margin_bottom ) ? ' '.sanitize_html_classes($margin_bottom) : '';
  $parallax_class     = ( $parallax == 'yes' ) ? ' parallax-bg':'';
  $data_stellar_ratio = ( $parallax_stellar_ratio && $parallax == 'yes' ) ? ' data-stellar-ratio="'.esc_attr($parallax_stellar_ratio).'"':'';
  $data_hor_offset    = ( $parallax_stellar_hor_offset && $parallax == 'yes' ) ? ' data-stellar-horizontal-offset="'.esc_attr($parallax_stellar_hor_offset).'"':'';
  $data_ver_offset    = ( $parallax_stellar_ver_offset && $parallax == 'yes' ) ? ' data-stellar-vertical-offset="'.esc_attr($parallax_stellar_ver_offset).'"':'';
  $is_fluid           = ( $fluid == 'stretch_row_only' || $fluid == 'stretch_row_content') ? ' full-width':'';
  if( $bg_position == 'custom-position' && $custom_position ) {
    $bg_position  = 'background-position:'.$custom_position.' !important;';
  } elseif( $bg_position ) {
    $bg_position  = 'background-position:'.$bg_position.' !important;';
  } else {
    $bg_position = '';
  }

  if( $bg_size == 'custom-size' && $custom_size ) {
    $bg_size  = 'background-size:'.$custom_size.' !important;';
  } elseif( $bg_size ) {
    $bg_size  = 'background-size:'.$bg_size.' !important;';
  } else {
    $bg_size = '';
  }
  $bg_attr_style  = ( $bg_position || $bg_size ) ? ' style="'.$bg_position.$bg_size.'"':'';
  $attributes     = ( $attributes ) ? ' '.sanitize_html_classes(str_replace(',',' ',$attributes)) : '';

  $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
  $css_class = ( $css_class ) ? ' '.sanitize_html_classes($css_class):'';

  $output  =  '<section '.$id.' class="section'.$parallax_class.$is_fluid.$class.$padding_top.$padding_bottom.$margin_top.$margin_bottom.$attributes.''.$css_class.'"'.$data_stellar_ratio.$data_hor_offset.$data_ver_offset.$bg_attr_style.'>';
  $output .=  ( $fluid == 'stretch_row_only' ) ? '<div class="container">':'';
  $output .=  '<div class="row vc_row-fluid">';
  $output .=  do_shortcode(wp_kses_post($content));
  $output .=  ( $fluid == 'stretch_row_only' ) ? '</div>':'';
  $output .=  '</div>';
  $output .=  '</section>';

  return $output;
}
add_shortcode( 'vc_row', 'rs_row' );
add_shortcode( 'vc_row_inner', 'rs_row' );
add_shortcode( 'vc_section', 'rs_row' );
