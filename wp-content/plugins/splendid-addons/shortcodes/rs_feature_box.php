<?php

/**
 *
 * RS Pricing Table
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_feature_box($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'id'    => '',
    'class' => '',
  ), $atts));

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

  $output  =  '<div '.$id.' class="features'.$class.'">';
  $output .=  '<div class="features-row scrollme">';
  $output .=  do_shortcode(wp_kses_post($content));
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}

add_shortcode('rs_feature_box', 'rs_feature_box');

function rs_feature_box_item($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'image'           => '',
    // image
    'data_sb'         => 'enter',
    'data_from'       => '0',
    'data_to'         => '0',
    'data_opacity'    => '0',
    'data_scale'      => '',
    'data_translatey' => '',

    // content
    'c_data_sb'         => 'enter',
    'c_data_from'       => '0',
    'c_data_to'         => '0',
    'c_data_opacity'    => '0',
    'c_data_scale'      => '',
    'c_data_translatey' => '',
  ), $atts));

  // properties
  $data_sb         = ( $data_sb ) ? ' data-when="'.esc_attr($data_sb).'"':'';
  $data_from       = ' data-from="'.esc_attr($data_from).'"';
  $data_to         = ' data-to="'.esc_attr($data_to).'"';
  $data_opacity    = ' data-opacity="'.esc_attr($data_opacity).'"';
  $data_scale      = ( $data_scale ) ? ' data-scale="'.esc_attr($data_scale).'"':'';
  $data_translatey = ( $data_translatey ) ? ' data-translatey="'.esc_attr($data_translatey).'"':'';

  // content
  $c_data_sb         = ( $c_data_sb ) ? ' data-when="'.esc_attr($c_data_sb).'"':'';
  $c_data_from       = ' data-from="'.esc_attr($c_data_from).'"';
  $c_data_to         = ' data-to="'.esc_attr($c_data_to).'"';
  $c_data_opacity    = ' data-opacity="'.esc_attr($c_data_opacity).'"';
  $c_data_scale      = ( $c_data_scale ) ? ' data-scale="'.esc_attr($c_data_scale).'"':'';
  $c_data_translatey = ( $c_data_translatey ) ? ' data-translatey="'.esc_attr($c_data_translatey).'"':'';

  $img_style = $img_html = '';
  if(!empty($image) && is_numeric($image)) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {
      $img_style = ' style="background-image:url('.esc_url($image_src[0]).');"';
      $img_html  = '<img src="'.esc_url($image_src[0]).'" alt="">';
    }
  }

  $output  = '<div class="feature animateme" '.$data_sb.$data_from.$data_to.$data_opacity.$data_translatey.' data-easing="linear">';
  $output .=  '<figure'.$img_style.'>';
  $output .=  $img_html;
  $output .=  '</figure>';
  $output .=  '</div><!-- /feature -->';
  $output .=  '<div class="feature animateme" '.$c_data_sb.$c_data_from.$c_data_to.$c_data_opacity.$c_data_translatey.' data-easing="linear">';
  $output .=  '<div class="text-block">';
  $output .=  rs_set_wpautop($content);
  $output .=  '</div><!-- /text-block -->';
  $output .=  '</div><!-- /feature -->';

  return $output;
}

add_shortcode('rs_feature_box_item', 'rs_feature_box_item');


