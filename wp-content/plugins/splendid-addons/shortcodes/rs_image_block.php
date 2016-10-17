<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_image_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                 => '',
    'class'              => '',
    'image'              => '',
    'link'               => '',
    'align'              => '',
    'width'              => '',
    'height'             => '',
    'image_link'         => 'no',
    'margin_top'         => '',
    'margin_bottom'      => '',
  ), $atts ) );

  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $top                = ( $margin_top ) ? 'margin-top:'.$margin_top.';':'';
  $bottom             = ( $margin_bottom ) ? 'margin-bottom:'.$margin_bottom.';':'';
  $width              = ( $width ) ? ' width="'.esc_attr($width).'"':'';
  $height             = ( $height ) ? ' height="'.esc_attr($height).'"':'';

  $style = '';
  if (!empty($top) || !empty($bottom)) {
	  $style = 'style="'.$top.$bottom.'"';
  }

  $href = $title = $target = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) && $image_link == 'yes' ) {
    $parse_args = vc_parse_multi_attribute( $link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? ' title="'.esc_attr($parse_args['title']).'"' : '';
    $target     = ( isset( $parse_args['target'] ) ) ? ' target="'.esc_attr(trim( $parse_args['target'] )).'"' : '';
  }

  $output = '';
  if ( is_numeric( $image ) && !empty( $image ) ) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {
      $output .=  ( $image_link == 'yes' && !empty($image_link) ) ? '<a href="'.esc_url($href).'"'.$title.$target.'>':'';
      $output .=  '<img '.$id.' class="'.sanitize_html_class($align).$class.'" '.$style.' src="'.esc_url($image_src[0]).'" '.$width.$height.' alt="">';
      $output .=  ( $image_link == 'yes' && !empty($image_link) ) ? '</a>':'';
    }
  }

  return $output;
}

add_shortcode('rs_image_block', 'rs_image_block');
