<?php
/**
 *
 * RS Parallax Container
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_parallax_container( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                          => '',
    'class'                       => '',
    'parallax_stellar_ratio'      => 0.5,
    'parallax_stellar_hor_offset' => 0,
    'parallax_stellar_ver_offset' => 0,
    'css'                         => '',
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $data_stellar_ratio = ( $parallax_stellar_ratio ) ? ' data-stellar-ratio="'.esc_attr($parallax_stellar_ratio).'"':'';
  $data_hor_offset    = ( $parallax_stellar_hor_offset ) ? ' data-stellar-horizontal-offset="'.esc_attr($parallax_stellar_hor_offset).'"':'';
  $data_ver_offset    = ( $parallax_stellar_ver_offset ) ? ' data-stellar-vertical-offset="'.esc_attr($parallax_stellar_ver_offset).'"':'';
  $css_class          = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
  $css_class          = ( $css_class ) ? ' '.sanitize_html_classes($css_class):'';


  $output = '<div '.$id.' class="parallax-conatiner parallax'.$css_class.$class.'"'.$data_stellar_ratio.$data_hor_offset.$data_ver_offset.'>';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .= '</div>';

  return $output;
}

add_shortcode('rs_parallax_container', 'rs_parallax_container');

function rs_parallax_container_item($atts, $content = '') {
  $output =  do_shortcode($content);
  return $output;
}
add_shortcode('rs_parallax_container_item', 'rs_parallax_container_item');
