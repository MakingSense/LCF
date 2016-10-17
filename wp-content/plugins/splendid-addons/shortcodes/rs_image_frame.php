<?php
/**
 *
 * Image Frame
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_image_frame( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'         => '',
    'class'      => '',
    'style'      => 'style1',
    'image'      => '',
    'image_link' => 'no',
    'link'       => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $style = ( $style ) ? ' '.sanitize_html_classes($style):'';

  $href = $title = $target = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) && $image_link == 'yes' ) {
    $parse_args = vc_parse_multi_attribute( $link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? ' title="'.esc_attr($parse_args['title']).'"' : '';
    $target     = ( isset( $parse_args['target'] ) ) ? ' target="'.esc_attr(trim( $parse_args['target'] )).'"' : '';
  }

  if ( is_numeric( $image ) && !empty( $image ) ) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {
      $output  = '<div '.$id.' class="img-frame '.sanitize_html_classes($style).$class.'">';
      $output .=  ( $image_link == 'yes' && !empty($image_link) ) ? '<a href="'.esc_url($href).'"'.$title.$target.'>':'';
      $output .=  '<img src="'.esc_url($image_src[0]).'" alt="">';
      $output .=  ( $image_link == 'yes' && !empty($image_link) ) ? '</a>':'';
      $output .=  '</div>';
    }
  }

  return $output;

}
add_shortcode( 'rs_image_frame', 'rs_image_frame' );
