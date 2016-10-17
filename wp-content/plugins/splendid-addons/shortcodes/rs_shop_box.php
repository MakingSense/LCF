<?php
/**
 *
 * Shop Box
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_shop_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'              => '',
    'class'           => '',
    'style'           => 'style1',
    'image'           => '',
    'small_heading'   => '',
    'big_heading'     => '',
    'additional_text' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $image_style = '';
  if(!empty($image) && is_numeric($image)) {
    $image_url = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_url[0])) {
      $image_style = '<img src="'.esc_url($image_url[0]).'" alt="">';
    }
  }

  switch ($style) {
    case 'style1':
      $output  = '<div '.$id.' class="shop-box color-light'.$class.'">';
      $output .=  $image_style;
      $output .=  '<div class="shop-box-inner">';
      $output .=  '<div class="shop-box-inner-box align-center">';
      $output .=  '<div class="divider unique light margin_t_10 margin_b_0"></div>';
      $output .=  '<h2 class="extra-bold big uppercase margin_t_30 margin_b_30">'.esc_html($small_heading).'</h2>';
      $output .=  '<div class="wings-title">';
      $output .=  '<div>';
      $output .=  '<div><div class="wing"></div></div>';
      $output .=  '<div class="title"><h5 class="uppercase">'.esc_html($additional_text).'</h5></div>';
      $output .=  '<div><div class="wing"></div></div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '<h1 class="extra-bold big uppercase">'.esc_html($big_heading).'</h1>';
      $output .=  '<div class="divider unique light margin_t_0 margin_b_10"></div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style2':
      $output  =  '<div '.$id.' class="shop-box color-light'.$class.'">';
      $output .=  $image_style;
      $output .=  '<div class="shop-box-inner align-center">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-lg-10 col-md-10 col-sm-12 col-lg-push-1 col-md-push-1">';
      $output .=  '<h2 class="extra-bold big uppercase margin_t_0">'.esc_html($small_heading).'</h2>';
      $output .=  '<div class="wings-title style2">';
      $output .=  '<div>';
      $output .=  '<div><div class="wing"></div></div>';
      $output .=  '<div class="title"><h5 class="uppercase">'.esc_html($additional_text).'</h5></div>';
      $output .=  '<div><div class="wing"></div></div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '<div class="divider unique light no_margin"></div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style3':
    default:
      $output  =  '<div '.$id.' class="shop-box color-light'.$class.'">';
      $output .=  $image_style;
      $output .=  '<div class="shop-box-inner align-center">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-lg-6 col-md-6 col-sm-8">';
      $output .=  '<h2 class="extra-bold big uppercase margin_t_0">'.esc_html($small_heading).'</h2>';
      $output .=  '<h5 class="uppercase no_margin">'.esc_html($additional_text).'</h5>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;
  }

  return $output;

}
add_shortcode( 'rs_shop_box', 'rs_shop_box' );